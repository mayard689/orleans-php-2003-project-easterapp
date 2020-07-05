<?php

namespace App\Controller;

use App\Form\UserUpdateType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\User\UserInterface;

class ProfileController extends AbstractController
{
    /**
     * @Route("/profile", name="profile")
     * @param Request $request
     * @param UserInterface $user
     * @return Response
     */
    public function index(Request $request, UserInterface $user): Response
    {
        $form = $this->createForm(UserUpdateType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();

            $this->addFlash('success', 'Votre profil a bien été mis à jour.');

            return $this->redirectToRoute('profile');
        }


        return $this->render('security/profile.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
        ]);
    }
}
