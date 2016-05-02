<?php

namespace Controller;

use W\Controller\Controller;

class FrontendController extends Controller
{

	/**
	 * Page d'accueil par défaut
	 */
	public function index()
	{
		$this->show('frontend/index');
	}

}