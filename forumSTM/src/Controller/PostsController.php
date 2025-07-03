<?php

namespace App\Controller;

use App\Entity\Posts;
use App\Form\PostsForm;
use App\Repository\PostsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/posts')]
final class PostsController extends AbstractController
{
    #[Route(name: 'app_posts_index', methods: ['GET'])]
    public function index(PostsRepository $postsRepository, PaginatorInterface $paginator, Request $request): Response
    {

        $postsQuery = $postsRepository->findAll();

        $posts = $paginator->paginate(
            $postsQuery, /* query NOT result */
            $request->query->getInt('page', 1), /* page number */
            10 /* limit per page */
        );

        return $this->render('posts/index.html.Twig', [
            'posts' => $posts,
        ]);
    }

    #[Route('/new', name: 'app_posts_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $post = new Posts();
        $form = $this->createForm(PostsForm::class, $post);
        $form->handleRequest($request);
        $user = $this->getUser();

        if ($form->isSubmitted() && $form->isValid()) {
            $post->setAuthor($user);
            $entityManager->persist($post);
            $entityManager->flush();

            return $this->redirectToRoute('app_posts_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('posts/new.html.Twig', [
            'post' => $post,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_posts_show', methods: ['GET'])]
    public function show(Posts $post): Response
    {
        return $this->render('posts/show.html.Twig', [
            'post' => $post,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_posts_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Posts $post, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(PostsForm::class, $post);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_posts_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('posts/edit.html.Twig', [
            'post' => $post,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_posts_delete', methods: ['POST'])]
    public function delete(Request $request, Posts $post, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$post->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($post);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_posts_index', [], Response::HTTP_SEE_OTHER);
    }
}
