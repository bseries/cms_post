<?php

use base_core\extensions\cms\Settings;

$this->set([
	'page' => [
		'type' => 'multiple',
		'object' => $t('posts')
	]
]);

?>
<article class="view-<?= $this->_config['controller'] . '-' . $this->_config['template'] ?> use-list">

	<div class="top-actions">
		<?= $this->html->link($t('new post'), ['action' => 'add', 'library' => 'cms_post'], ['class' => 'button add']) ?>
	</div>

	<?php if ($data->count()): ?>
		<table>
			<thead>
				<tr>
					<td data-sort="is-published" class="flag is-published list-sort"><?= $t('publ.?') ?>
					<?php if (Settings::read('post.usePromotion')): ?>
						<td data-sort="is-promoted" class="flag is-promoted list-sort"><?= $t('prom.?') ?>
					<?php endif ?>
					<td>
					<td data-sort="title" class="emphasize title list-sort"><?= $t('Title') ?>
					<td data-sort="published" class="date published list-sort desc"><?= $t('Pubdate') ?>
					<td data-sort="created" class="date created list-sort"><?= $t('Created') ?>
					<td class="actions">
						<?= $this->form->field('search', [
							'type' => 'search',
							'label' => false,
							'placeholder' => $t('Filter'),
							'class' => 'list-search'
						]) ?>
			</thead>
			<tbody class="list">
				<?php foreach ($data as $item): ?>
				<tr>
					<td class="flag is-published"><?= ($item->is_published ? '✓' : '×') ?>

					<?php if (Settings::read('post.usePromotion')): ?>
						<td class="flag is-promoted"><?= ($item->is_promoted ? '✓' : '×') ?>
					<?php endif ?>

					<td>
						<?php if ($cover = $item->cover()): ?>
							<?= $this->media->image($cover->version('fix3admin')->url('http'), ['class' => 'media']) ?>
						<?php endif ?>
					<td class="emphasize title"><?= $item->title ?>
					<td class="date published">
						<time datetime="<?= $this->date->format($item->published, 'w3c') ?>">
							<?= $this->date->format($item->published, 'date') ?>
						</time>
					<td class="date created">
						<time datetime="<?= $this->date->format($item->created, 'w3c') ?>">
							<?= $this->date->format($item->created, 'date') ?>
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
</article>