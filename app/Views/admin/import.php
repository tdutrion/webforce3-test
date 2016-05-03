<?php $this->layout('layout', ['title' => 'Import articles - Admin']) ?>

<?php $this->start('main_content') ?>
<h2>Administration</h2>
<h3>Importer le fichier d'articles</h3>
<a href="<?= $this->url('admin_index') ?>">Retourner à l'administration des articles</a>
<?php $this->insert('admin/_upload') ?>
<?php $this->stop('main_content') ?>
