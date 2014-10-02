<?php

use base_core\extensions\cms\Settings;
use lithium\security\Auth;

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

$user = Auth::check('default');

?>
<article class="view-<?= $this->_config['controller'] . '-' . $this->_config['template'] ?>">
	<?=$this->form->create($item) ?>
		<div class="grid-row">
			<div class="grid-column-left">
				<?= $this->form->field('title', ['type' => 'text', 'label' => $t('Title'), 'class' => 'use-for-title']) ?>
				<?= $this->form->field('authors', [
					'type' => 'text',
					'label' => $t('Author/s'),
					'value' => $item->authors(['serialized' => true]) ?: $user['name']
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
				<div class="media-attachment use-media-attachment-direct">
					<?= $this->form->label('PostsCoverMediaId', $t('Cover')) ?>
					<?= $this->form->hidden('cover_media_id') ?>
					<div class="selected"></div>
					<?= $this->html->link($t('select'), '#', ['class' => 'button select']) ?>
				</div>
			</div>
			<div class="grid-column-right">
				<div class="media-attachment use-media-attachment-joined">
					<?= $this->form->label('PostsMedia', $t('Media')) ?>
					<?php foreach ($item->media() as $media): ?>
						<?= $this->form->hidden('media.' . $media->id . '.id', ['value' => $media->id]) ?>
					<?php endforeach ?>

					<div class="selected"></div>
					<?= $this->html->link($t('select'), '#', ['class' => 'button select']) ?>
				</div>
			</div>
		</div>

		<div class="grid-row">
			<div class="grid-column-left">
				<?= $this->form->field('teaser', [
					'type' => 'textarea',
					'label' => $t('Teaser'),
					'wrap' => ['class' => 'teaser use-editor editor-basic editor-link'],
				]) ?>
			</div>
			<div class="grid-column-right">

			</div>
		</div>

		<div class="grid-row">
			<?= $this->form->field('body', [
				'type' => 'textarea',
				'label' => $t('Content'),
				'wrap' => ['class' => 'body use-editor editor-basic editor-headline editor-size editor-line editor-link editor-list editor-media editor-page-break']
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