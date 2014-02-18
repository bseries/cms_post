<?php
/**
 * Bureau Post
 *
 * Copyright (c) 2013-2014 Atelier Disko - All rights reserved.
 *
 * This software is proprietary and confidential. Redistribution
 * not permitted. Unless required by applicable law or agreed to
 * in writing, software distributed on an "AS IS" BASIS, WITHOUT-
 * WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 */

use cms_core\extensions\cms\Features;
use cms_core\extensions\cms\Panes;
use lithium\g11n\Message;
use cms_media\models\Media;

extract(Message::aliases());

Panes::register('cms_post', 'posts', [
	'title' => $t('Posts'),
	'group' => Panes::GROUP_AUTHORING,
	'url' => $base = ['controller' => 'posts', 'library' => 'cms_post', 'admin' => true],
	'actions' => [
		$t('List Posts') => ['action' => 'index'] + $base,
		$t('New Post') => ['action' => 'add'] + $base
	]
]);
Media::registerDependent('cms_post\models\Posts', ['cover' => 'direct', 'media' => 'joined']);

Features::register('cms_post', 'postPromotion', false);

?>