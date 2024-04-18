<?php

namespace App\Controller;

use App\Entity\Topdeal;
use App\Form\RegisterDealType;
use App\Repository\TopdealRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TopdealsController extends AbstractController
{
    #[Route('/topdeals', name: 'app_topdeals')]
    public function index(TopdealRepository $topdealRepository): Response
    {

        $topdeal = $topdealRepository->findall();
        $this->denyAccessUnlessGranted("IS_AUTHENTICATED_FULLY");

        return $this->render('topdeals/index.html.twig', [
            'controller_name' => 'TopdealsController',
            'deal' => $topdeal
        ]);
    }

    #[Route('/topdeals/registerdeals', name: 'app_registerdeals')]
    public function Registerdeals(Request $request,EntityManagerInterface $entityManager,ManagerRegistry $doctrine): Response
    {



        $topdeal = new Topdeal();
        $entityManager = $doctrine->getManager();
        $form = $this->createForm(RegisterDealType::class,$topdeal);

        $form->handleRequest($request);
        
        
        if ($form->isSubmitted() && $form->isValid()) {

                    // tell Doctrine you want to (eventually) save the Product (no queries yet)
            
            $entityManager->persist($topdeal);

            // actually executes the queries (i.e. the INSERT query)
            $entityManager->flush();
            $this->addFlash('success', 'Le bon plan a bien été créé faut attendre l\'acceptation de l\'admin maintenant!');
            return $this->redirectToRoute('app_topdeals');

            
        }

        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        return $this->render('topdeals/registerdeals.html.twig', [
            'DealForm' => $form->createView(),
        ]);
    }
}
