<?php $this->layout('layout', ['title' => 'Admin']) ?>

<?php $this->start('main_content') ?>
<h2>Administration</h2>
<h3>Recherche : "<?= $term ?>"</h3>
<a href="<?= $this->url('admin_index') ?>">Retourner à l'administration des articles</a>
<?php if (count($articles) > 0): ?>
<?php $this->insert('admin/_search') ?>
    <?php foreach ($articles as $article): ?>
    <article>
        <h4>
            <a href="<?= $this->url('admin_article', ['id' => $article['id']]) ?>">
                <?= $this->highlight($article['title'], $term)?>
            </a>
        </h4>
        <aside>Le <?= $this->escape($article['date_add']) ?>, par <?= $this->escape($article['author']) ?></aside>
        <div><?= $this->highlight($article['content'], $term)?></div>
    </article>
    <?php endforeach; ?>
<?php else: ?>
<div class="alert alert-info">
    <ul>
        <li>Aucun article enregistré.</li>
    </ul>
</div>
<?php endif; ?>
<?php $this->stop('main_content') ?>
