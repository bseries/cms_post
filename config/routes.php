<?php
/**
 * Bureau Post
 *
 * Copyright (c) 2013 Atelier Disko - All rights reserved.
 *
 * This software is proprietary and confidential. Redistribution
 * not permitted. Unless required by applicable law or agreed to
 * in writing, software distributed on an "AS IS" BASIS, WITHOUT-
 * WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 */

use lithium\net\http\Router;

$persist = ['persist' => ['admin', 'controller']];

Router::connect('/admin/posts/{:id:[0-9]+}', array(
	'controller' => 'posts', 'library' => 'cms_post', 'action' => 'view', 'admin' => true
), $persist);
Router::connect('/admin/posts/{:action}', array(
	'controller' => 'posts', 'library' => 'cms_post', 'admin' => true
), $persist);
Router::connect('/admin/posts/{:action}/{:id:[0-9]+}', array(
	'controller' => 'posts', 'library' => 'cms_post', 'admin' => true
), $persist);

?>