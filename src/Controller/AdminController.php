<?php

namespace App\Controller;

use App\Entity\Reservation;
use App\Entity\Topdeal;
use App\Repository\ReservationRepository;
use App\Repository\TopdealRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{
    #[Route('/lebonplans', name: 'app_lebonplans')]
    public function index(): Response
    {

        if ($this->isGranted('ROLE_USER') == true && $this->isGranted('ROLE_ADMIN') == false ){
            return $this->redirectToRoute("app_lucky");
        }
        else{
        $this->denyAccessUnlessGranted("ROLE_ADMIN");
        }

        return $this->render('admin/index.html.twig', [
            'controller_name' => 'AdminController',
        ]);
    }
    #[Route('/lebonplans/bonplan', name: 'app_admin_bonplan')]
    public function bonplan(TopdealRepository $topdealRepository): Response
    {


        $this->denyAccessUnlessGranted("ROLE_ADMIN");
        

        $modifdeal = $topdealRepository->findAll();
        return $this->render('admin/bonplans.html.twig', [
            'modifdeal' => $modifdeal,
        ]);
    }

    #[Route('/lebonplans/bonplan/{id}/delete', name: 'app_admin_bonplan_delete')]
    public function bonplandelete(ManagerRegistry $doctrine,Request $request): Response
    {

        if ($this->isGranted('ROLE_USER') == true && $this->isGranted('ROLE_ADMIN') == false ){
            return $this->redirectToRoute("app_lucky");
        }
        else{
        $this->denyAccessUnlessGranted("ROLE_ADMIN");
        }

        $topdeal = $doctrine->getRepository(Topdeal::class)->find($request->get('id'));
        $entityManager = $doctrine->getManager();
        $entityManager->remove($topdeal);
        $entityManager->flush();
        $this->addFlash('success', 'Vous avez bien supprimer le bon plan');
        return $this->redirectToRoute('app_admin_bonplan');

    }
    #[Route('/lebonplans/bonplan/{id}/status', name: 'app_admin_bonplan_status')]
    public function bonplanstatus(ManagerRegistry $doctrine,Request $request): Response
    {
        $user = $this->getUser();

        if ($this->isGranted('ROLE_USER') == true && $this->isGranted('ROLE_ADMIN') == false ){
            return $this->redirectToRoute("app_lucky");
        }
        else{
        $this->denyAccessUnlessGranted("ROLE_ADMIN");
        }

        $topdeal = $doctrine->getRepository(Topdeal::class)->find($request->get('id'));

        if ($topdeal->getstatus() == false) {
            $topdeal->setStatus(true);
            $entityManager = $doctrine->getManager();
            $entityManager->persist($topdeal);
            $entityManager->flush();
        }
        else {
            
            $topdeal->setStatus(false);
            $entityManager = $doctrine->getManager();
            $entityManager->persist($topdeal);
            $entityManager->flush();
        }
        $this->addFlash('success', 'Vous avez bien à jour le status du bon plan');
        return $this->redirectToRoute('app_admin_bonplan');

    }

    #[Route('/lebonplans/reservation', name: 'app_admin_reservation')]
    public function reservation(ReservationRepository $topdealRepository): Response
    {


        $this->denyAccessUnlessGranted("ROLE_ADMIN");
        

        $modifdeal = $topdealRepository->findAll();
        return $this->render('admin/reservation.html.twig', [
            'modifdeal' => $modifdeal,
        ]);
    }

    #[Route('/lebonplans/reservation/{id}/delete', name: 'app_admin_reservation_delete')]
    public function reservationdelete(ManagerRegistry $doctrine,Request $request): Response
    {

        if ($this->isGranted('ROLE_USER') == true && $this->isGranted('ROLE_ADMIN') == false ){
            return $this->redirectToRoute("app_lucky");
        }
        else{
        $this->denyAccessUnlessGranted("ROLE_ADMIN");
        }

        $reserv = $doctrine->getRepository(Reservation::class)->find($request->get('id'));
        $entityManager = $doctrine->getManager();
        $entityManager->remove($reserv);
        $entityManager->flush();
        $this->addFlash('success', 'Vous avez bien supprimer la réservation');
        return $this->redirectToRoute('app_admin_reservation');

    }
    #[Route('/lebonplans/reservation/{id}/status', name: 'app_admin_reservation_status')]
    public function reservationstatus(ManagerRegistry $doctrine,Request $request): Response
    {
        $user = $this->getUser();

        if ($this->isGranted('ROLE_USER') == true && $this->isGranted('ROLE_ADMIN') == false ){
            return $this->redirectToRoute("app_lucky");
        }
        else{
        $this->denyAccessUnlessGranted("ROLE_ADMIN");
        }

        $reserv = $doctrine->getRepository(Reservation::class)->find($request->get('id'));

        if ($reserv->getstatus() == false) {
            $reserv->setStatus(true);
            $entityManager = $doctrine->getManager();
            $entityManager->persist($reserv);
            $entityManager->flush();
        }
        else {
            
            $reserv->setStatus(false);
            $entityManager = $doctrine->getManager();
            $entityManager->persist($reserv);
            $entityManager->flush();
        }
        $this->addFlash('success', 'Vous avez bien à jour le status de la réservation');
        return $this->redirectToRoute('app_admin_reservation');

    }
}
