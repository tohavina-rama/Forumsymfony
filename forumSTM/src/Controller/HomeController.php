<?php

namespace App\Controller;

use App\Repository\CategoryRepository;
use App\Repository\CommentRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use App\Repository\PostsRepository;

final class HomeController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function index(UserRepository $userRepository, PostsRepository $postsRepository, CategoryRepository $categoryRepository, CommentRepository $commentRepository): Response
    {
        $usersCount = $userRepository->count([]);
        $categoryCount = $categoryRepository->count([]);
        $commentsCount = $commentRepository->count([]);

        $posts = $postsRepository->findBy([], ['createdAt' => 'DESC']);
        $postsCount = $postsRepository->count([]);


        return $this->render('/home/index.html.Twig', [
            'posts' => $posts,
            'postsCount' => $postsCount,
            'usersCount' => $usersCount,
            'categoryCount' => $categoryCount,
            'commentsCount' => $commentsCount
        ]);
    }
}
