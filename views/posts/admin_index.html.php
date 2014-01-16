<?php

$dateFormatter = new IntlDateFormatter(
	'de_DE',
	IntlDateFormatter::SHORT,
	IntlDateFormatter::SHORT
);

?>
<article class="view-<?= $this->_config['controller'] . '-' . $this->_config['template'] ?>">
	<h1 class="alpha"><?= $t('Posts') ?></h1>

	<nav class="actions">
		<?= $this->html->link($t('add post'), ['action' => 'add', 'library' => 'cms_post'], ['class' => 'button']) ?>
	</nav>

	<?php if ($data->count()): ?>
		<table>
			<thead>
				<tr>
					<td>
					<td><?= $t('Title') ?>
					<td><?= $t('Created') ?>
					<td><?= $t('Modified') ?>
					<td>
			</thead>
			<tbody>
				<?php foreach ($data as $item): ?>
				<tr>
					<td>
						<?php if ($version = $item->cover_medium->version('fix3')): ?>
							<?= $this->media->image($version->url('http'), ['class' => 'media']) ?>
						<?php endif ?>
					<td><?= $item->title ?>
					<td>
						<?php $date = DateTime::createFromFormat('Y-m-d H:i:s', $item->created) ?>
						<time datetime="<?= $date->format(DateTime::W3C) ?>"><?= $dateFormatter->format($date) ?></time>
					<td>
						<?php $date = DateTime::createFromFormat('Y-m-d H:i:s', $item->modified) ?>
						<time datetime="<?= $date->format(DateTime::W3C) ?>"><?= $dateFormatter->format($date) ?></time>
					<td>
						<nav class="actions">
							<?= $this->html->link($t('delete'), ['id' => $item->id, 'action' => 'delete', 'library' => 'cms_post'], ['class' => 'button']) ?>
							<?= $this->html->link($t('edit'), ['id' => $item->id, 'action' => 'edit', 'library' => 'cms_post'], ['class' => 'button']) ?>
						</nav>
				<?php endforeach ?>
			</tbody>
		</table>
	<?php else: ?>
		<div class="none-available"><?= $t('No posts available, yet.') ?></div>
	<?php endif ?>
</article>