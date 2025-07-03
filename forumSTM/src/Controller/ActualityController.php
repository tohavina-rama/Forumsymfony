<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class ActualityController extends AbstractController
{
    #[Route('/actualite', name: 'app_actuality_index')]
    public function index(): Response
    {
        return $this->render('member/index.html.twig');
}