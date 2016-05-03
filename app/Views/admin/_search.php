<form action="<?= $this->url('admin_search') ?>" method="post" class="form-inline">
    <input type="hidden" name="csrf" value="<?= $_SESSION['csrf_token'] ?>">
    <label>Mots à chercher : <input type="text" name="term" class="form-control"></label>
    <div class="form-group form-group-sm">
        <button class="btn btn-default">Rechercher</button>
    </div>
</form>