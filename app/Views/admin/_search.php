<form action="<?= $this->url('admin_search') ?>" method="post">
    <input type="hidden" name="csrf" value="<?= $_SESSION['csrf_token'] ?>">
    <label>Mots à chercher : <input type="text" name="term"></label>
    <button>Rechercher</button>
</form>