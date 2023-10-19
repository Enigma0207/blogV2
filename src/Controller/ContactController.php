<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactType;
use App\Controller\ContactController;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;

class ContactController extends AbstractController
{
    #[Route('/contact', name: 'app_contact')]
    // EntityManagerInterface $entityManage, il permet de recuperer toutes les methodes pour envoie a la bdd telque finAll..
    public function index(Request $request, EntityManagerInterface $entityManager): Response
    {
        $contact = new Contact();
        $form = $this->createForm(ContactType::class,$contact);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $entityManager->persist($contact);
            $entityManager->flush();
            // Rediriger vers la page home après avoir soumis le formulaire
             return $this->redirectToRoute('app_home');
        }
        // dd($contact);
        return $this->render('contact/contact.html.twig', [
            'controller_name' => 'ContactController',
            'contact' => $form->createView()
        ]);
    }
}





