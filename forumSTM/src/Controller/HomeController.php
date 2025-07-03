<?php

namespace App\Controller;

use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Form\RegistrationForm;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use App\Entity\Posts;
use App\Repository\PostsRepository;

final class HomeController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function index(Request $request, AuthenticationUtils $authenticationUtils, PostsRepository $postsRepository): Response
    {
        $posts = $postsRepository->findBy([], ['createdAt' => 'DESC']);

        $postsCount = $postsRepository->count([]);


        return $this->render('/home/index.html.Twig', [
            'posts' => $posts,
            'postsCount' => $postsCount,
        ]);
    }
}
