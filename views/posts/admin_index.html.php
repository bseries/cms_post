<?php

use cms_core\extensions\cms\Features;

$dateFormatter = new IntlDateFormatter(
	'de_DE',
	IntlDateFormatter::SHORT,
	IntlDateFormatter::SHORT
);

?>
<article class="view-<?= $this->_config['controller'] . '-' . $this->_config['template'] ?>">
	<h1 class="alpha"><?= $t('Posts') ?></h1>

	<nav class="actions">
		<?= $this->html->link($t('new post'), ['action' => 'add', 'library' => 'cms_post'], ['class' => 'button']) ?>
	</nav>

	<?php if ($data->count()): ?>
		<table>
			<thead>
				<tr>
					<td><?= $t('publ.?') ?>
					<?php if (Features::enabled('postPromotion')): ?>
						<td><?= $t('prom.?') ?>
					<?php endif ?>
					<td>
					<td><?= $t('Title') ?>
					<td><?= $t('Pubdate') ?>
					<td><?= $t('Created') ?>
					<td><?= $t('Modified') ?>
					<td>
			</thead>
			<tbody>
				<?php foreach ($data as $item): ?>
				<tr>
					<td><?= ($item->is_published ? '✓' : '╳') ?>

					<?php if (Features::enabled('postPromotion')): ?>
						<td><?= ($item->is_promoted ? '✓' : '╳') ?>
					<?php endif ?>

					<td>
						<?php if ($version = $item->cover()->version('fix3')): ?>
							<?= $this->media->image($version->url('http'), ['class' => 'media']) ?>
						<?php endif ?>
					<td><?= $item->title ?>
					<td>
						<?php $date = DateTime::createFromFormat('Y-m-d', $item->published) ?>
						<time datetime="<?= $date->format(DateTime::W3C) ?>"><?= $dateFormatter->format($date) ?></time>
					<td>
						<?php $date = DateTime::createFromFormat('Y-m-d H:i:s', $item->created) ?>
						<time datetime="<?= $date->format(DateTime::W3C) ?>"><?= $dateFormatter->format($date) ?></time>
					<td>
						<?php $date = DateTime::createFromFormat('Y-m-d H:i:s', $item->modified) ?>
						<time datetime="<?= $date->format(DateTime::W3C) ?>"><?= $dateFormatter->format($date) ?></time>
					<td>
						<nav class="actions">
							<?= $this->html->link($t('delete'), ['id' => $item->id, 'action' => 'delete', 'library' => 'cms_post'], ['class' => 'button']) ?>
							<?php if (Features::enabled('postPromotion')): ?>
								<?= $this->html->link($item->is_promoted ? $t('unpromote') : $t('promote'), ['id' => $item->id, 'action' => $item->is_promoted ? 'unpromote': 'promote', 'library' => 'cms_post'], ['class' => 'button']) ?>
							<?php endif ?>
							<?= $this->html->link($item->is_published ? $t('unpublish') : $t('publish'), ['id' => $item->id, 'action' => $item->is_published ? 'unpublish': 'publish', 'library' => 'cms_post'], ['class' => 'button']) ?>
							<?= $this->html->link($t('edit'), ['id' => $item->id, 'action' => 'edit', 'library' => 'cms_post'], ['class' => 'button']) ?>
						</nav>
				<?php endforeach ?>
			</tbody>
		</table>
	<?php else: ?>
		<div class="none-available"><?= $t('No posts available, yet.') ?></div>
	<?php endif ?>
</article>