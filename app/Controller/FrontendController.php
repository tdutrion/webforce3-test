<?php

namespace Controller;

class FrontendController extends BaseController
{
    /**
     * Page d'accueil par défaut.
     */
    public function index()
    {
        $this->show('frontend/index');
    }
}
