<?php

namespace Controller;

use Model\ArticleModel;

class AdminController extends BaseController
{
    private $articleModel;

    public function __construct()
    {
        $this->articleModel = new ArticleModel();
    }
    /**
     * Administration home.
     *
     * Outputs a paginated and sortable list of articles.
     */
    public function index()
    {
        $orderBy = isset($_GET['order']) && in_array($_GET['order'], $this->articleModel->getColumns()) ?
            $_GET['order'] : 'date_add';

        $sort = isset($_GET['sort']) && in_array($_GET['sort'], ['DESC', 'ASC']) ? $_GET['sort'] : 'DESC';

        $page = (isset($_GET['page']) && intval($_GET['page']) > 0) ? intval($_GET['page']) : 1;

        $app = getApp();
        $limit = (isset($_GET['limit']) && intval($_GET['limit']) > 0) ? intval($_GET['limit']) :
            ($app->getConfig('admin_pagination_limit') ? $app->getConfig('admin_pagination_limit') : 10);

        $totalRecords = $this->articleModel->getTotalRecords();

        if ($page > $totalRecords / $limit) {
            $page = ceil($totalRecords / $limit);
        }

        $articles = $this->articleModel->findAll($orderBy, $sort, $limit, ($page - 1) * $limit);

        parse_str(isset($_SERVER['QUERY_STRING']) ? $_SERVER['QUERY_STRING'] : '', $queryStringParameters);

        $this->show('admin/index', [
            'articles' => $articles,
            'totalPages' => $totalRecords / $limit,
            'currentPage' => $page,
            'queryStringParameters' => $queryStringParameters,
        ]);
    }

    /**
     * Import form.
     *
     * Outputs an import form including a csrf token and a file upload field
     */
    public function import()
    {
        // generate a new CSRF token
        $_SESSION['csrf_token'] = md5(uniqid(mt_rand(), true));

        // send to view
        $this->show('admin/import', [
        ]);
    }

    /**
     * Processes the import and outputs errors on the form.
     */
    public function process_import()
    {
        // redirect if not submitted
        if (empty($_POST)) {
            $this->redirectToRoute('admin_import');
        }

        // checking for errors
        $errors = [];
        if ($_SESSION['csrf_token'] != $_POST['csrf']) {
            $errors[] = "L'origine de la requête n'a pas pu être confirmée, merci de soumettre à nouveau.";
        }

        if (!$_FILES['import']['name']) {
            $errors[] = 'Le fichier à importer est manquant.';
        }
        if ($_FILES['import']['error']) {
            $errors[] = 'Une erreur est survenue pendant le chargement du fichier.';
        }
        if (empty($errors)) {
            $mime = mime_content_type($_FILES['import']['tmp_name']);
            if (!in_array($mime, ['text/plain', 'application/json'])) {
                $errors[] = "Le fichier soumis n'est pas du type attendu (application/json ou text/plain)";
            }
            $pathInfos = pathinfo($_FILES['import']['name']);
            if (strtolower($pathInfos['extension']) !== 'json') {
                $errors[] = "Le fichier soumis n'a pas l'extension attendue (.json)";
            }

            $content = file_get_contents($_FILES['import']['tmp_name']);
            unlink($_FILES['import']['tmp_name']);

            if (!$content) {
                $errors[] = "Le fichier soumis n'a pas pu être lu.";
            }

            $articles = json_decode($content, true);
            if (!is_array($articles)) {
                $errors[] = "Aucun article n'a pu être récupéré (problème de format de JSON).";
            }
        }

        if (!empty($errors)) {
            // generate a new CSRF token
            $_SESSION['csrf_token'] = md5(uniqid(mt_rand(), true));
            // send to view
            $this->show('admin/process_import', [
                'errors' => $errors,
            ]);
        }

        foreach ($articles as $key => $article) {
            try {
                $this->articleModel->insert($article);
            } catch (Exception $error) {
                $errors[] = "L'objet {$key} n'a pas pu être importé";
            }
        }

        if (!empty($errors)) {
            // generate a new CSRF token
            $_SESSION['csrf_token'] = md5(uniqid(mt_rand(), true));
            // send to view
            $this->show('admin/process_import', [
                'errors' => $errors,
            ]);
        }

        // process and send to database
        $this->redirectToRoute('admin_import');
    }

    /**
     * Displays a single article found by id.
     *
     * @param $id
     */
    public function article($id)
    {
        $article = $this->articleModel->find($id);
        if (!$article) {
            $this->showNotFound();
        }
        parse_str(isset($_SERVER['QUERY_STRING']) ? $_SERVER['QUERY_STRING'] : '', $queryStringParameters);
        $this->show('admin/article', [
            'article' => $article,
            'queryStringParameters' => $queryStringParameters,
        ]);
    }

    /**
     * Search articles and highlight search term.
     */
    public function search()
    {
        if (empty($_POST) || !isset($_POST['term'])) {
            $this->redirectToRoute('admin_index');
        }
        $articles = $this->articleModel->search([
            'title' => $_POST['term'],
            'content' => $_POST['term'],
        ]);
        $this->show('admin/search', [
            'articles' => $articles,
            'term' => $_POST['term'],
        ]);
    }
}
