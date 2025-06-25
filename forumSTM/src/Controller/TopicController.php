<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class TopicController extends AbstractController
{
    #[Route('/topic', name: 'topic.index')]
    public function index(): Response
    {
        return $this->render('topic/index.html.twig');
    }
}
