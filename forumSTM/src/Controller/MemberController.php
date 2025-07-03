<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class MemberController extends AbstractController
{
    #[Route('/membres', name: 'app_members_index')]
    public function index(): Response
    {
        return $this->render('member/index.html.twig');
}