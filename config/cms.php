<?php
/**
 * Copyright 2013 David Persson. All rights reserved.
 * Copyright 2016 Atelier Disko. All rights reserved.
 *
 * Use of this source code is governed by a BSD-style
 * license that can be found in the LICENSE file.
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