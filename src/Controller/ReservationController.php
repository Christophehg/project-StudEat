<?php

namespace App\Controller;

use App\Entity\Reservation;
use App\Entity\User;
use App\Form\ReservationType;
use App\Repository\ReservationRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ReservationController extends AbstractController
{
    #[Route('/reservation', name: 'app_reservation')]
    public function index(ReservationRepository $reservationRepository, UserRepository $userRepository): Response
    {
        $reservation = $reservationRepository->findall();
        $user = $userRepository->findall();
        $this->denyAccessUnlessGranted("IS_AUTHENTICATED_FULLY");

        return $this->render('reservation/index.html.twig', [
            'controller_name' => 'ReservationController',
            'reserv' => $reservation,
            'user' => $user
        ]);
    }

    #[Route('/reservation/register', name: 'app_reservation_register')]
    public function Registerreservation(Request $request,EntityManagerInterface $entityManager,ManagerRegistry $doctrine): Response
    {



        $reservation = new Reservation();
        $entityManager = $doctrine->getManager();
        $form = $this->createForm(ReservationType::class,$reservation);

        $form->handleRequest($request);
        
        
        if ($form->isSubmitted() && $form->isValid()) {

                    // tell Doctrine you want to (eventually) save the Product (no queries yet)
            
            $entityManager->persist($reservation);

            // actually executes the queries (i.e. the INSERT query)
            $entityManager->flush();
            $this->addFlash('success', 'La réservation à bien été créer faut attendre l\'accepation de l\'admin maintenant!');
            return $this->redirectToRoute('app_reservation');

            
        }

        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        return $this->render('reservation/registerreservation.html.twig', [
            'ReservForm' => $form->createView(),
        ]);

    }



    #[Route('/reservation/{id}/reserve', name: 'app_admin_reservation_reserve')]
    public function reservationreserve(ManagerRegistry $doctrine,Request $request): Response
    {
            $user = $this->getUser();
            $reserv = $doctrine->getRepository(Reservation::class)->find($request->get('id'));
            $id_reservation = $reserv->getId();
            $nb_place = $reserv->getSlots();
            $take_place = $reserv->getTakedslots();
        if($take_place == $nb_place && $user->getStatus_reservation() == false){
            $this->addFlash('danger', 'Il ne reste plus de place');
            return $this->redirectToRoute('app_reservation');
        }
        else{
            if ($user->getStatus_reservation() == false) {
                $user->setStatus_reservation(true);
                $reserv->setTakedslots($take_place+1);
                $user->setIdreservasion($id_reservation);
                $entityManager = $doctrine->getManager();
                $entityManager->persist($user);
                $entityManager->persist($reserv);
                $entityManager->flush();
                $this->addFlash('success', 'Votre réservation à bien été pris en compte');

            }
            elseif ($user->getIdreservasion() == $id_reservation) {

                
                $user->setStatus_reservation(false);
                $user->setIdreservasion(0);
                $reserv->setTakedslots($take_place-1);
                $entityManager = $doctrine->getManager();
                $entityManager->persist($user);
                $entityManager->persist($reserv);
                $entityManager->flush();
                $this->addFlash('success', 'Vous avez bien annuler votre réservation');

            }
            else{
                $this->addFlash('danger', 'Vous avez déjà une réservation en cours. Merci d\'annuler votre première réservation pour pouvoir en prendre une autre.');
                return $this->redirectToRoute('app_reservation');

            }
        }
        

        return $this->redirectToRoute('app_reservation');

    }

    
}
