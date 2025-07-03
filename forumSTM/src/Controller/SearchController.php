<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route; 

final class SearchController extends AbstractController
{
    #[Route('/recherche', name: 'app_search_index')]
    public function index(): Response
    {

        return $this->render('search/index.html.twig');
    }
}