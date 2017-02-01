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

use DateTime;
use base_core\extensions\cms\Settings;
use lithium\g11n\Message;

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
				],
				'bodyMedia' => [
					'type' => 'inline',
					'to' => 'body'
				]
			]
		],
		'base_core\extensions\data\behavior\Timestamp',
		'base_core\extensions\data\behavior\Neighbors',
		'li3_taggable\extensions\data\behavior\Taggable' => [
			'field' => 'tags',
			'tagsModel' => 'base_tag\models\Tags',
			'filters' => ['strtolower']
		],
		'base_core\extensions\data\behavior\Serializable' => [
			'fields' => [
				'authors' => ','
			]
		],
		'base_core\extensions\data\behavior\Searchable' => [
			'fields' => [
				'Owner.name',
				'Owner.number',
				'authors',
				'title',
				'tags',
				'source',
				'site'
			]
		]
	];

	public static function init() {
		extract(Message::aliases());
		$model = static::_object();

		$model->validates['published'] = [
			[
				'notEmpty',
				'on' => ['create', 'update'],
				'message' => $t('This field cannot be left blank.', ['scope' => 'cms_post'])
			]
		];
		$model->validates['tags'] = [
			[
				'noSpacesInTags',
				'on' => ['create', 'update'],
				'message' => $t('Tags cannot contain spaces.', ['scope' => 'cms_post'])
			]
		];

		if (PROJECT_LOCALE !== PROJECT_LOCALES) {
			static::bindBehavior('li3_translate\extensions\data\behavior\Translatable', [
				'fields' => ['title', 'teaser', 'body'],
				'locale' => PROJECT_LOCALE,
				'locales' => explode(' ', PROJECT_LOCALES),
				'strategy' => 'inline'
			]);
		}
		if (Settings::read('post.useAutoTagging')) {
			static::behavior('Taggable')->config('autoMatch', ['title']);
		}
	}

	public function date($entity) {
		if ($entity->published) {
			return DateTime::createFromFormat('Y-m-d', $entity->published);
		}
		return DateTime::createFromFormat('Y-m-d H:i:s', $entity->created);
	}
}

Posts::init();

?>