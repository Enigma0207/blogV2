<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserController extends AbstractController
{
    #[Route('/user', name: 'app_user')]
    //1. UserPasswordHasherInterface $passwordHasher depuis security/user class User implements UserInterface, PasswordAuthenticatedUserInterface et
    public function index(Request $request, EntityManagerInterface $entityManager,UserPasswordHasherInterface $passwordHasher): Response
    {
        $user = new User();
        // dd($user)
        $form = $this->createForm(UserFormType::class,$user);
        $form->handleRequest($request);
          // dd($request)
           // dd($user)
         if ($form->isSubmitted() && $form->isValid()){
            //  2. donc 1 et 2 pour hacher
              $plaintextPassword = $user->getPassword();
              $hashedPassword = $passwordHasher->hashPassword($user,$plaintextPassword);
            //   

              $user->setPassword($hashedPassword);
           // dd($hashedPassword)
           // dd($user)

              $entityManager->persist($user);
              $entityManager->flush();
            // Rediriger vers la page home après avoir soumis le formulaire
               return $this->redirectToRoute('app_home');
        }
        return $this->render('user/user.html.twig', [
            'controller_name' => 'UserController',
            'user' => $form->createView()
        ]);
    }
}
