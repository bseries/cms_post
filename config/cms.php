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
 * License. If not, see https://atelierdisko.de/licenses.
 */

namespace cms_post\config;

use base_core\extensions\cms\Settings;

// Enables the ability to provide a source of the post.
Settings::register('post.useSource', false);

// Enables the promotion of posts.
Settings::register('post.usePromotion', true);

// Enables automatic tagging of entities, once saved.
Settings::register('post.useAutoTagging', false);

?>