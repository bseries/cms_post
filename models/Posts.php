<?php
/**
 * CMS Post
 *
 * Copyright (c) 2013 Atelier Disko - All rights reserved.
 *
 * Licensed under the AD General Software License v1.
 *
 * This software is proprietary and confidential. Redistribution
 * not permitted. Unless required by applicable law or agreed to
 * in writing, software distributed on an "AS IS" BASIS, WITHOUT-
 * WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 *
 * You should have received a copy of the AD General Software
 * License. If not, see http://atelierdisko.de/licenses.
 */

namespace cms_post\models;

use lithium\util\Validator;
use DateTime;

class Posts extends \base_core\models\Base {

	public $belongsTo = [
		'Owner' => [
			'to' => 'base_core\models\Users',
			'key' => 'owner_id'
		],
		'CoverMedia' => [
			'to' => 'base_media\models\Media',
			'key' => 'cover_media_id'
		]
	];

	protected $_actsAs = [
		'base_core\extensions\data\behavior\Ownable',
		'base_core\extensions\data\behavior\Sluggable',
		'base_media\extensions\data\behavior\Coupler' => [
			'bindings' => [
				'cover' => [
					'type' => 'direct',
					'to' => 'cover_media_id'
				],
				'media' => [
					'type' => 'joined',
					'to' => 'base_media\models\MediaAttachments'
				]
			]
		],
		'base_core\extensions\data\behavior\Timestamp',
		'li3_taggable\extensions\data\behavior\Taggable' => [
			'field' => 'tags',
			'tagsModel' => 'base_tag\models\Tags',
			'filters' => ['strtolower'],
			'autoMatch' => ['title']
		],
		'base_core\extensions\data\behavior\Serializable' => [
			'fields' => [
				'authors' => ','
			]
		],
		'base_core\extensions\data\behavior\Searchable' => [
			'fields' => [
				'Owner.name',
				'authors',
				'title',
				'tags',
				'source'
			]
		]
	];

	public static function init() {
		$model = static::_object();

		$model->validates['published'] = [
			[
				'notEmpty',
				'on' => ['create', 'update'],
				'message' => 'Dieses Feld darf nicht leer sein.'
			]
		];
		$model->validates['tags'] = [
			[
				'noSpacesInTags',
				'on' => ['create', 'update'],
				'message' => 'Es sind keine Leerzeichen innerhalb von Tags erlaubt.'
			]
		];
		Validator::add('noSpacesInTags', function($value, $format, $options) {
			return empty($value) || preg_match('/^([a-z0-9]+)(\s?,\s?[a-z0-9]+)*$/i', $value);
		});
	}

	public function date($entity) {
		return DateTime::createFromFormat('Y-m-d H:i:s', $entity->created);
	}

	// Retrieves the next and previous record, surroundig the current one.
	//
	// An order and direction must be given in query, use DESC direction for
	// date fields, so that next is newer and prev is older.
	//
	// FIXME This is a naive implemetation.
	// http://stackoverflow.com/questions/12293115/how-to-select-rows-surrounding-a-row-not-by-id
	public function neighbors($entity, array $query = array()) {
		$query += [
			'conditions' => [],
			'fields' => [],
			'order' => [],
			// No other constraints can be used.
		];
		$next = $prev = null;

		if (!$query['order']) {
			throw new Exception('Need field/direction in order, none set.');
		}

		$results = static::find('all', [
			'conditions' => $query['conditions'],
			'order' => $query['order'],
			'fields' => ['id']
		])->to('array', ['indexed' => false]);

		foreach ($results as $key => $result) {
			if ($result['id'] != $entity->id) {
				continue;
			}
			if (isset($results[$key + 1])) {
				$prev = $results[$key + 1]['id'];
			}
			if (isset($results[$key - 1])) {
				$next = $results[$key - 1]['id'];
			}
			break;
		}

		return [
			'prev' => $prev ? static::find('first', [
				'conditions' => ['id' => $prev],
				'fields' => $query['fields']
			]) : false,
			'next' => $next ? static::find('first', [
				'conditions' => ['id' => $next],
				'fields' => $query['fields']
			]) : false,
		];
	}
}

Posts::init();

?>