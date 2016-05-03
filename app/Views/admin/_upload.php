<form action="<?= $this->url('admin_process_import') ?>" method="post" enctype="multipart/form-data" class="form-inline">
    <input type="hidden" name="csrf" value="<?= $_SESSION['csrf_token'] ?>">
    <label>Fichier à importer: <input type="file" name="import" class="form-control"></label>
    <button class="btn btn-default">Téléverser le fichier</button>
</form>