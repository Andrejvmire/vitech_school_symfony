<?php

namespace App\Controller;

use App\DTO\UserDTO;
use App\Entity\User;
use App\Form\RegistrationFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("registration")
 */
class RegistrationController extends AbstractController
{
    /**
     * @Route("/", name="app_registration")
     */
    public function registrationAction(Request $request, UserPasswordHasherInterface $passwordHasher, EntityManagerInterface $entityManager): Response
    {
        $userDTO = new UserDTO();
        $form = $this->createForm(RegistrationFormType::class, $userDTO, [
            'action' => $this->generateUrl('app_registration')
        ]);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $user = new User();
            $user->setEmail($userDTO->getEmail());
            $hashedPassword = $passwordHasher->hashPassword(
                $user,
                $userDTO->getPlainPassword()
            );
            $user->setPassword($hashedPassword);
            $entityManager->persist($user);
            $entityManager->flush();
            return $this->redirectToRoute('request list');
        }
        return $this->renderForm('registration/registration.html.twig', [
            'form' => $form,
        ]);
    }
}
