<?php

use lithium\g11n\Message;
use base_core\extensions\cms\Settings;

$t = function($message, array $options = []) {
	return Message::translate($message, $options + ['scope' => 'cms_post', 'default' => $message]);
};

$this->set([
	'page' => [
		'type' => 'single',
		'title' => $item->title,
		'empty' => $t('untitled'),
		'object' => $t('post')
	],
	'meta' => [
		'is_published' => $item->is_published ? $t('published') : $t('unpublished'),
		'is_promoted' => $item->is_promoted ? $t('promoted') : $t('unpromoted')
	]
]);

?>
<article class="view-<?= $this->_config['controller'] . '-' . $this->_config['template'] ?>">
	<?=$this->form->create($item) ?>
		<?php if ($useOwner): ?>
			<div class="grid-row">
				<h1><?= $t('Access') ?></h1>

				<div class="grid-column-left"></div>
				<div class="grid-column-right">
					<?= $this->form->field('user_id', [
						'type' => 'select',
						'label' => $t('Owner'),
						'list' => $users
					]) ?>
				</div>
			</div>
		<?php endif ?>
		<div class="grid-row">
			<div class="grid-column-left">
				<?= $this->form->field('title', ['type' => 'text', 'label' => $t('Title'), 'class' => 'use-for-title']) ?>
				<?= $this->form->field('authors', [
					'type' => 'text',
					'label' => $t('Author/s'),
					'value' => $item->authors(['serialized' => true]) ?: $authedUser->name
				]) ?>
				<div class="help"><?= $t('Separate multiple authors with commas.') ?></div>
			</div>
			<div class="grid-column-right">
				<?= $this->form->field('published', [
					'type' => 'date',
					'label' => $t('Publish date'),
					'value' => $item->published ?: date('Y-m-d')
				]) ?>
				<div class="help"><?= $t('Setting a publish date allows to pre- or post-date this item. It is used for public display.') ?></div>

				<?= $this->form->field('tags', ['value' => $item->tags(), 'label' => $t('Tags'), 'placeholder' => 'foo, bar']) ?>
				<div class="help"><?= $t('Separate multiple tags with commas.') ?></div>

				<?= $this->form->field('source', [
					'type' => 'text',
					'label' => $t('Source')
				]) ?>
			</div>
		</div>
		<div class="grid-row">
			<div class="grid-column-left">
				<?= $this->media->field('cover_media_id', [
					'label' => $t('Cover'),
					'attachment' => 'direct',
					'value' => $item->cover()
				]) ?>
			</div>
			<div class="grid-column-right">
				<?= $this->media->field('media', [
					'label' => $t('Media'),
					'attachment' => 'joined',
					'value' => $item->media()
				]) ?>
			</div>
		</div>

		<div class="grid-row">
			<div class="grid-column-left">
				<?= $this->editor->field('teaser', [
					'label' => $t('Teaser'),
					'size' => 'gamma',
					'features' => 'minimal'
				]) ?>
			</div>
			<div class="grid-column-right"></div>
		</div>

		<div class="grid-row">
			<?= $this->editor->field('body', [
				'label' => $t('Content'),
				'size' => 'beta',
				'features' => 'full'
			]) ?>
		</div>

		<div class="bottom-actions">
			<?php if (Settings::read('post.usePromotion')): ?>
				<?= $this->html->link($item->is_promoted ? $t('unpromote') : $t('promote'), ['id' => $item->id, 'action' => $item->is_promoted ? 'unpromote': 'promote', 'library' => 'cms_post'], ['class' => 'button large']) ?>
			<?php endif ?>
			<?php if ($item->exists()): ?>
				<?= $this->html->link($item->is_published ? $t('unpublish') : $t('publish'), ['id' => $item->id, 'action' => $item->is_published ? 'unpublish': 'publish', 'library' => 'cms_post'], ['class' => 'button large']) ?>
			<?php endif ?>
			<?= $this->form->button($t('save'), ['type' => 'submit', 'class' => 'button large save']) ?>
		</div>
	<?=$this->form->end() ?>
</article>