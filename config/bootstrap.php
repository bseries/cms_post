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

use cms_core\extensions\cms\Modules;
use lithium\g11n\Message;
use cms_media\models\Media;

extract(Message::aliases());

Modules::register('cms_post', 'posts', ['title' => $t('Posts')]);
Media::registerDependent('cms_post\models\Posts', ['cover' => 'direct', 'media' => 'joined']);

?>