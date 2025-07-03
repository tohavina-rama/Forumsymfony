<?php
// forumSTM/src/Controller/ModalController.php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use App\Form\RegistrationForm;
use Symfony\Component\HttpFoundation\Request;

final class ModalController extends AbstractController
{
    #[Route('/modal/login', name: 'modal_login')]
    public function loginModal(Request $request, AuthenticationUtils $authenticationUtils): Response
    {
        $form = $this->createForm(RegistrationForm::class);

        $error = $authenticationUtils->getLastAuthenticationError();
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('partials/modal.html.Twig', [
            'registrationForm' => $form->createView(),
            'lastUsername' => $lastUsername,
            'error' => $error,
        ]);
    }


}



