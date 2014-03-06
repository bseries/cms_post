<?php

$title = [
	'action' => ucfirst($this->_request->action === 'add' ? $t('creating') : $t('editing')),
	'title' => $item->title ?: $t('untitled'),
	'object' => [ucfirst($t('post')), ucfirst($t('posts'))]
];
$this->title("{$title['title']} - {$title['object'][1]}");

?>
<article class="view-<?= $this->_config['controller'] . '-' . $this->_config['template'] ?>">
	<h1 class="alpha">
		<span class="action"><?= $title['action'] ?></span>
		<span class="title" data-untitled="<?= $t('Untitled') ?>"><?= $title['title'] ?></span>
	</h1>
	<?=$this->form->create($item) ?>
		<?= $this->form->field('title', ['type' => 'text', 'label' => $t('Title'), 'class' => 'use-for-title']) ?>

		<?= $this->form->field('published', [
			'type' => 'date',
			'label' => $t('Publish date'),
			'value' => $item->published ?: date('Y-m-d')
		]) ?>
		<div class="help"><?= $t('Setting a publish date allows to pre- or post-date this item. It is used for public display.') ?></div>

		<div class="media-attachment use-media-attachment-direct">
			<?= $this->form->label('PostsCoverMediaId', $t('Cover')) ?>
			<?= $this->form->hidden('cover_media_id') ?>
			<div class="selected"></div>
			<?= $this->html->link($t('select'), '#', ['class' => 'button select']) ?>
		</div>
		<div class="media-attachment use-media-attachment-joined">
			<?= $this->form->label('PostsMedia', $t('Media')) ?>
			<?php foreach ($item->media() as $media): ?>
				<?= $this->form->hidden('media.' . $media->id . '.id', ['value' => $media->id]) ?>
			<?php endforeach ?>

			<div class="selected"></div>
			<?= $this->html->link($t('select'), '#', ['class' => 'button select']) ?>
		</div>
		<?= $this->form->field('teaser', [
			'type' => 'textarea',
			'label' => $t('Teaser'),
			'wrap' => ['class' => 'teaser use-editor editor-basic editor-link'],
		]) ?>
		<?= $this->form->field('body', [
			'type' => 'textarea',
			'label' => $t('Content'),
			'wrap' => ['class' => 'body use-editor editor-basic editor-headline editor-size editor-line editor-link editor-list editor-media editor-page-break']
		]) ?>
		<?= $this->form->field('tags', ['value' => $item->tags(), 'label' => $t('Tags')]) ?>
		<div class="help"><?= $t('Separate multiple tags with commas.') ?></div>

		<?= $this->form->button($t('save'), ['type' => 'submit', 'class' => 'button large']) ?>
	<?=$this->form->end() ?>
</article>