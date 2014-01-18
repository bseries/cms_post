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

namespace cms_post\controllers;

use cms_post\models\Posts;
use lithium\g11n\Message;
use li3_flash_message\extensions\storage\FlashMessage;

class PostsController extends \lithium\action\Controller {

	public function admin_index() {
		$data = Posts::find('all', ['with' => 'CoverMedia']);
		return compact('data');
	}

	public function admin_add() {
		extract(Message::aliases());

		$item = Posts::create();

		if ($this->request->data) {
			if ($item->save($this->request->data)) {
				FlashMessage::write($t('Successfully saved.'));
				return $this->redirect(['action' => 'index', 'library' => 'cms_post']);
			} else {
				FlashMessage::write($t('Failed to save.'));
			}
		}
		$this->_render['template'] = 'admin_form';
		return compact('item');
	}

	public function admin_edit() {
		extract(Message::aliases());

		$item = Posts::find($this->request->id);

		if ($this->request->data) {
			if ($item->save($this->request->data)) {
				FlashMessage::write($t('Successfully saved.'));
				return $this->redirect(['action' => 'index', 'library' => 'cms_post']);
			} else {
				FlashMessage::write($t('Failed to save.'));
			}
		}
		$this->_render['template'] = 'admin_form';
		return compact('item');
	}

	public function admin_delete() {
		extract(Message::aliases());

		$item = Posts::find($this->request->id);
		$item->delete();
		FlashMessage::write($t('Successfully deleted.'));

		return $this->redirect(['action' => 'index', 'library' => 'cms_post']);
	}

	public function admin_publish() {
		extract(Message::aliases());

		$item = Posts::find($this->request->id);
		$item->save(['is_published' => true]);
		FlashMessage::write($t('Successfully published.'));

		return $this->redirect(['action' => 'index', 'library' => 'cms_post']);
	}

	public function admin_unpublish() {
		extract(Message::aliases());

		$item = Posts::find($this->request->id);
		$item->save(['is_published' => false]);
		FlashMessage::write($t('Successfully unpublished.'));

		return $this->redirect(['action' => 'index', 'library' => 'cms_post']);
	}
}

?>