<?php
/**
 * CMS Post
 *
 * Copyright (c) 2013 Atelier Disko - All rights reserved.
 *
 * This software is proprietary and confidential. Redistribution
 * not permitted. Unless required by applicable law or agreed to
 * in writing, software distributed on an "AS IS" BASIS, WITHOUT-
 * WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 */

use base_core\extensions\cms\Panes;
use lithium\g11n\Message;

extract(Message::aliases());

Panes::register('authoring.posts', [
	'title' => $t('Posts', ['scope' => 'cms_post']),
	'url' => ['controller' => 'posts', 'action' => 'index', 'library' => 'cms_post', 'admin' => true],
	'weight' => 40
]);

?>