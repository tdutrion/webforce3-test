<?php

namespace Controller;

use Model\ArticleModel;

class ApiController extends BaseController
{

    private $articleModel;

    public function __construct()
    {
        $this->articleModel = new ArticleModel();
    }

    public function collection()
    {
        try {
            $page = (isset($_GET['page']) && intval($_GET['page']) > 0) ? intval($_GET['page']) : 1;

            $app = getApp();
            $limit = (isset($_GET['limit']) && intval($_GET['limit']) > 0) ? intval($_GET['limit']) :
                ($app->getConfig('api_pagination_limit') ? $app->getConfig('api_pagination_limit') : 5);

            $totalRecords = $this->articleModel->getTotalRecords();

            if ($page > $totalRecords / $limit) {
                throw new \InvalidArgumentException("La page {$page} n'existe pas.");
            }

            $articles = $this->articleModel->findAll('date_add', 'DESC', $limit, intval(($page - 1) * $limit));
        } catch (\InvalidArgumentException $error) {
            header('HTTP/1.1 406 Not Acceptable');
            $this->showJson([
                'type' => \InvalidArgumentException::class,
                'title' => 'Une erreur est survenue.',
                'detail' => $error->getMessage(),
            ]);
        }
        $this->showJson($articles);
    }
}
