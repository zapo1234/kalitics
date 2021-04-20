<?php

namespace App\Controller;
use App\Entity\Pointage;
use App\Entity\User;
use App\Form\PointageType;
use App\Repository\PointageRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;


class PointageController extends AbstractController
{
   // route pointage des utilisateurs et vu sur touts les pointages.
    #[Route('/pointage', name: 'pointage', methods: ['GET', 'POST'])]
    public function index(Request $request, PointageRepository $pointageRepository,UserRepository $userRepository): Response
    {

        $pointage = new Pointage();

        $form = $this->createForm(PointageType::class, $pointage);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            // recupérer la date à partir du matricule du user
            // On recherche si un utilisateur avec ce matricule existe dans la base de données
            // et on récupère les données dont on as besoin
            $matricule = $form->get('user')->getData();
            $chantier = $form->get('chantier')->getData();
            $date = $form->get('date')->getData();

            // vérification  si user ayant ce matricule existe.
            $mats = $userRepository->findOneBy(['matricule' => $matricule]);

            // Somme  des durées pour un user  ayant à partir du matricule du user.
            $imat = $matricule;
            $total = $pointageRepository->SommeTime($imat);

            // convertir les 35h et $total en seconde time
            $time_limite = 35*60*60;
            $total_seconde = $total*60;

            // name utilisateur

            if ($mats != null) {
                // on traite les données si le matricule existe.
                // on check sur le matricule pour récupérer les données dans la table pointage!
                $mat = $pointageRepository->findOneBy(['user' => $matricule]);

                if ($mat != null) {
                    // on recupére la date de ce utilisateur avec le matricule.
                    $user_date = $mat->getDate();
                    // on récupére le chantier correspondant à l'enregistrement
                    $chantier_name = $mat->getChantier();


                    if ($date != $user_date AND $chantier_name != $chantier ) {

                        // verification du temps accordé
                        if($total_seconde < $time_limite){
                        // on autorise le pointage
                        $entityManager = $this->getDoctrine()->getManager();
                        $entityManager->persist($pointage);
                        $entityManager->flush();

                        return $this->redirectToRoute('pointage');
                    }
                      else{
                          // On envoie un message  disant la date devrait etre changer
                          $this->addFlash('alertes', 'le temps de prestation ne peut pas dépassé plus de 35heures');
                      }

                    }

                        else {

                        // On envoie un message  disant la date devrait etre changer
                        $this->addFlash('alerte', 'l\'utilisateur ne peut pas etre pointé 2 fois le meme jour');
                    }

                } else {

                    // on enregistre le pointage du user
                    $entityManager = $this->getDoctrine()->getManager();
                    $entityManager->persist($pointage);
                    $entityManager->flush();
                }

            }

            else{

                // On envoie un message   si le matricule du user n'existe pas.
                $this->addFlash('danger', 'l\'utilisateur n\'existe pas');
            }

        }


        return $this->render('pointage/index.html.twig', [
            'controller_name' => 'PointageController',
             'form' => $form->createView(),
            'liste' => $pointageRepository->findAll(),

        ]);
    }
}
