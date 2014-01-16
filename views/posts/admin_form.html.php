
<?php ob_start() ?>
<script>
require(['editor'], function(Editor) {
	Editor.make('form .teaser textarea', true);
	Editor.make('form .body textarea', true);
});
require(['media-attachment'], function(MediaAttachment) {
	<?php $url = ['controller' => 'files', 'library' => 'cms_media', 'admin' => true] ?>

	var endpoints = {
		index: '<?= $this->url($url + ['action' => 'api_index']) ?>',
		view: '<?= $this->url($url + ['action' => 'api_view', 'id' => '__ID__']) ?>',
		transfer: '<?= $this->url($url + ['action' => 'api_transfer']) ?>'
	};

	MediaAttachment.direct('form .cover.media-attachment', {
		endpoints: endpoints
	});
	MediaAttachment.joined('form .media.media-attachment', {
		endpoints: endpoints
	});
});
</script>
<?php $this->scripts(ob_get_clean()) ?>

<article class="view-<?= $this->_config['controller'] . '-' . $this->_config['template'] ?>">
	<h1 class="alpha"><?= $this->title($t('Post')) ?></h1>

	<?=$this->form->create($item) ?>
		<?= $this->form->field('title', ['type' => 'text', 'label' => $t('Title')]) ?>
		<div class="cover media-attachment">
			<?= $this->form->label('PostsCoverMediaId', $t('Cover')) ?>
			<?= $this->form->hidden('cover_media_id') ?>
			<div class="selected"></div>
			<?= $this->html->link($t('select'), '#', ['class' => 'button select']) ?>
		</div>
		<div class="media media-attachment">
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
			'wrap' => ['class' => 'teaser'],
		]) ?>
		<?= $this->form->field('body', ['type' => 'textarea', 'label' => $t('Content'), 'wrap' => ['class' => 'body']]) ?>
		<?= $this->form->field('tags', ['value' => $item->tags(), 'label' => $t('Tags')]) ?>
		<?= $this->form->button($t('save'), ['type' => 'submit', 'class' => 'button large']) ?>
	<?=$this->form->end() ?>
</article>