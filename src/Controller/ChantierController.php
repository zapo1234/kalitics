<?php

namespace App\Controller;

use App\Entity\Chantier;
use App\Form\ChantierType;
use App\Repository\ChantierRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/chantier')]
class ChantierController extends AbstractController
{
    // lister tous les chantier existant.
    #[Route('/', name: 'chantier_index', methods: ['GET'])]
    public function index(ChantierRepository $chantierRepository): Response
    {
        return $this->render('chantier/index.html.twig', [
            'chantiers' => $chantierRepository->findAll(),
        ]);
    }

    // ajouter un nouveau chantier à partir du formulaire
    #[Route('/new', name: 'chantier_new', methods: ['GET', 'POST'])]
    public function new(Request $request): Response
    {
        $chantier = new Chantier();
        $form = $this->createForm(ChantierType::class, $chantier);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($chantier);
            $entityManager->flush();

            return $this->redirectToRoute('chantier_index');
        }

        return $this->render('chantier/new.html.twig', [
            'chantier' => $chantier,
            'form' => $form->createView(),
        ]);
    }

    // vue sur  un chantier ayant un id existant
    #[Route('/{id}', name: 'chantier_show', methods: ['GET'])]
    public function show(Chantier $chantier, ChantierRepository $chantierRepository, int $id): Response
    {
        // on recupère les users  ayant pointé sur un chantier
        $idchantier = $chantierRepository->find($id);
        // on recupére la liste users qui ont pointé sur le chantier
        $listes = $idchantier->getUsers();

        return $this->render('chantier/show.html.twig', [
            'chantier' => $chantier,
            'listes' =>$listes,
        ]);
    }

    // Modifier les données d'un chantier existant.
    #[Route('/{id}/edit', name: 'chantier_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Chantier $chantier): Response
    {
        $form = $this->createForm(ChantierType::class, $chantier);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('chantier_index');
        }

        return $this->render('chantier/edit.html.twig', [
            'chantier' => $chantier,
            'form' => $form->createView(),
        ]);
    }
     // suprimer un chantier existant.
    #[Route('/{id}/delete', name: 'chantier_delete', methods: ['POST'])]
    public function delete(Request $request, Chantier $chantier): Response
    {

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($chantier);
            $entityManager->flush();

        return $this->redirectToRoute('chantier_index');
    }
}
