<?php $this->layout('layout', ['title' => 'Admin']) ?>

<?php $this->start('main_content') ?>
<h2>Administration</h2>
<h3>Article: <?= $this->e($article['title']) ?></h3>
<a href="<?= $this->url('admin_index') ?>?<?= http_build_query($queryStringParameters) ?>">Retour à la liste des articles</a>
<h4>Par <?= $this->e($article['author']) ?>, le <?= $this->e($article['date_add']) ?></h4>
<article>
    <?= $this->e($article['content']) ?>
</article>
<?php $this->stop('main_content') ?>
