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

namespace cms_post\config;

use base_core\extensions\cms\Settings;

// Enables the ability to provide a source of the post.
Settings::register('post.enableSource', true);

// Enables the promotion of posts.
Settings::register('post.enablePromotion', true);

?>