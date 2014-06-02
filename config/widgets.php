<?php
/**
 * Bureau Media
 *
 * Copyright (c) 2013-2014 Atelier Disko - All rights reserved.
 *
 * This software is proprietary and confidential. Redistribution
 * not permitted. Unless required by applicable law or agreed to
 * in writing, software distributed on an "AS IS" BASIS, WITHOUT-
 * WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 */

use lithium\g11n\Message;
use cms_core\extensions\cms\Widgets;
use cms_post\models\Posts;

extract(Message::aliases());

Widgets::register('cms_post', 'authoring',  function() use ($t) {
	return [
		'data' => [
			$t('Posts') => Posts::find('count')
		]
	];
}, [
	'type' => Widgets::TYPE_TABLE,
	'group' => Widgets::GROUP_DASHBOARD
]);

?>