<?php

namespace App\Controller;

use App\Form\RegistrationFormType;
use App\Repository\ParticipantRepository;
use App\Security\AppAuthenticator;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\UserAuthenticatorInterface;

class RegistrationController extends AbstractController
{
    #[Route('/register/update/{id}', name: 'register_update')]
    public function register(int $id,ParticipantRepository $participantRepository,Request $request, UserPasswordHasherInterface $userPasswordHasher, UserAuthenticatorInterface $userAuthenticator, AppAuthenticator $authenticator, EntityManagerInterface $entityManager): Response
    {
        $user = $participantRepository->find($id);

        $modifForm  = $this->createForm(RegistrationFormType::class, $user);
        $modifForm->handleRequest($request);

        if ($modifForm->isSubmitted() && $modifForm->isValid()) {
            $user->setPassword(
                $userPasswordHasher->hashPassword(
                    $user,
                    $modifForm->get('password')->getData()
                )
            );

            $entityManager->flush();

            return $userAuthenticator->authenticateUser(
                $user,
                $authenticator,
                $request
            );
        }

        return $this->render('registration/register.html.twig', [
            'modifForm' => $modifForm->createView(),
        ]);
    }
}

 /*   #[Route('/register/update/{id}', name: 'register_update')]
    public function update(int                         $id, Request $request, EntityManagerInterface $entityManager, ParticipantRepository $participantRepository,
                           UserPasswordHasherInterface $userPasswordHasher, UserAuthenticatorInterface $userAuthenticator): Response
    {

       -------------- $participant = $participantRepository->find($id);


       ------------- $modifForm = $this->createForm(RegistrationFormType::class, $participant);
      ---------------  $modifForm->handleRequest($request);

       -------------- if ($modifForm->isSubmitted() && $modifForm->isValid()) {
         ------------   $participant->setPassword(
               --------- $userPasswordHasher->hashPassword(
              -----------      $participant,
               -----------     $modifForm->get('password')->getData()
             ------------   ));
          -----------  $entityManager->flush();
            ---------return $userAuthenticator->authenticateUser(
           ----------     $participant,
           -----------     $userAuthenticator,
            -----------    $request
           ---------- );
        }
        return $this->render('registration/register.html.twig', [
            'participant' => $participant,
            'modifForm' => $modifForm->createView(),
            'id' => $participant->getId()
        ]);
    }
}*/
