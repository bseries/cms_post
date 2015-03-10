<?php

use base_core\extensions\cms\Settings;

$t = function($id) use ($t) {
	return $t($id, ['scope' => 'cms_post']);
};

$this->set([
	'page' => [
		'type' => 'multiple',
		'object' => $t('posts')
	]
]);

?>
<article
	class="use-index-table"
	data-endpoint-sort="<?= $this->url([
		'action' => 'index',
		'page' => $paginator->getPages()->current,
		'orderField' => '__ORDER_FIELD__',
		'orderDirection' => '__ORDER_DIRECTION__'
	]) ?>"
>

	<div class="top-actions">
		<?= $this->html->link($t('new post'), ['action' => 'add'], ['class' => 'button add']) ?>
	</div>

	<?php if ($data->count()): ?>
		<table>
			<thead>
				<tr>
					<td data-sort="is-published" class="flag is-published table-sort"><?= $t('publ.?') ?>
					<?php if (Settings::read('post.usePromotion')): ?>
						<td data-sort="is-promoted" class="flag is-promoted table-sort"><?= $t('prom.?') ?>
					<?php endif ?>
					<td class="media">
					<td data-sort="title" class="emphasize title table-sort"><?= $t('Title') ?>
					<td data-sort="published" class="date published table-sort"><?= $t('Pubdate') ?>
					<td data-sort="modified" class="date modified table-sort desc"><?= $t('Modified') ?>
					<td class="actions">
			</thead>
			<tbody class="list">
				<?php foreach ($data as $item): ?>
				<tr>
					<td class="flag is-published"><?= ($item->is_published ? '✓' : '×') ?>

					<?php if (Settings::read('post.usePromotion')): ?>
						<td class="flag is-promoted"><?= ($item->is_promoted ? '✓' : '×') ?>
					<?php endif ?>

					<td class="media">
						<?php if ($cover = $item->cover()): ?>
							<?= $this->media->image($cover->version('fix3admin'), [
								'data-media-id' => $cover->id, 'alt' => 'preview'
							]) ?>
						<?php endif ?>
					<td class="emphasize title"><?= $item->title ?>
					<td class="date published">
						<time datetime="<?= $this->date->format($item->published, 'w3c') ?>">
							<?= $this->date->format($item->published, 'date') ?>
						</time>
					<td class="date modified">
						<time datetime="<?= $this->date->format($item->modified, 'w3c') ?>">
							<?= $this->date->format($item->modified, 'date') ?>
						</time>
					<td class="actions">
						<?= $this->html->link($t('delete'), ['id' => $item->id, 'action' => 'delete', 'library' => 'cms_post'], ['class' => 'button delete']) ?>
						<?php if (Settings::read('post.usePromotion')): ?>
							<?= $this->html->link($item->is_promoted ? $t('unpromote') : $t('promote'), ['id' => $item->id, 'action' => $item->is_promoted ? 'unpromote': 'promote', 'library' => 'cms_post'], ['class' => 'button']) ?>
						<?php endif ?>
						<?= $this->html->link($item->is_published ? $t('unpublish') : $t('publish'), ['id' => $item->id, 'action' => $item->is_published ? 'unpublish': 'publish', 'library' => 'cms_post'], ['class' => 'button']) ?>
						<?= $this->html->link($t('open'), ['id' => $item->id, 'action' => 'edit', 'library' => 'cms_post'], ['class' => 'button']) ?>
				<?php endforeach ?>
			</tbody>
		</table>
	<?php else: ?>
		<div class="none-available"><?= $t('No items available, yet.') ?></div>
	<?php endif ?>

	<?=$this->view()->render(['element' => 'paging'], compact('paginator'), ['library' => 'base_core']) ?>
</article>