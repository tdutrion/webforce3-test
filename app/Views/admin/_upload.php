<form action="<?= $this->url('admin_process_import') ?>" method="post" enctype="multipart/form-data">
    <input type="hidden" name="csrf" value="<?= $_SESSION['csrf_token'] ?>">
    <label>Fichier à importer: <input type="file" name="import"></label>
    <button>Téléverser le fichier</button>
</form>