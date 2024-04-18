<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\InscriptionType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class InscriptionController extends AbstractController
{
    #[Route('/inscription', name: 'app_inscription')]
    public function inscription(UserPasswordHasherInterface $hasher, Request $request,ManagerRegistry $doctrine): Response
    {
        
        $user = new User($hasher);
        $entityManager = $doctrine->getManager();
        $form = $this->createForm(InscriptionType::class, $user);

        $form->handleRequest($request);
        
        
        if ($form->isSubmitted() && $form->isValid()) {

            dump($user);
                    // tell Doctrine you want to (eventually) save the Product (no queries yet)
            
            $entityManager->persist($user);

            // actually executes the queries (i.e. the INSERT query)
            $entityManager->flush();
            $this->addFlash('success', 'l\'inscription c\'est bien effectué pouvez désormais vous connecter');
            return $this->redirectToRoute('login');

            
        }
        return $this->render('inscription/index.html.twig', [
            "form" => $form->createView(),
        ]);
    }
}
