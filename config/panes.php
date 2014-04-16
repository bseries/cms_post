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

use cms_core\extensions\cms\Panes;
use lithium\g11n\Message;

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

?>