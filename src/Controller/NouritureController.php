<?php

namespace App\Controller;

use App\Entity\Nouriture;
use App\Form\NouritureType;
use App\Repository\NouritureRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class NouritureController extends AbstractController
{
    #[Route('/nouriture/liste', name: 'nouriture_liste')]
    public function liste(NouritureRepository $nouritureRepository): Response
    {
        $nouritures = $nouritureRepository->findAll();

        return $this->render('nouriture/table_nouriture.html.twig', [
            'nouritures' => $nouritures,
        ]);
    }

    #[Route('/nouriture/ajouter', name: 'nouriture_ajouter')]
    public function ajouter(Request $request, EntityManagerInterface $em): Response
    {
        $nouriture = new Nouriture();
        $form = $this->createForm(NouritureType::class, $nouriture);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($nouriture);
            $em->flush();

            $this->addFlash('success', 'Nourriture ajoutée avec succès.');
            return $this->redirectToRoute('nouriture_liste');
        }

        return $this->render('nouriture/ajj_nouriture.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/nouriture/modifier/{id}', name: 'nouriture_modifier')]
    public function modifier(int $id, Request $request, EntityManagerInterface $em, NouritureRepository $nouritureRepository): Response
    {
        $nouriture = $nouritureRepository->find($id);
        if (!$nouriture) {
            throw $this->createNotFoundException("Nourriture non trouvée !");
        }

        $form = $this->createForm(NouritureType::class, $nouriture);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->flush();
            $this->addFlash('success', 'Nourriture modifiée avec succès !');
            return $this->redirectToRoute('nouriture_liste');
        }

        return $this->render('nouriture/modif_nouriture.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/nouriture/supprimer/{id}', name: 'nouriture_supprimer')]
    public function supprimer(int $id, EntityManagerInterface $em, NouritureRepository $nouritureRepository): Response
    {
        $nouriture = $nouritureRepository->find($id);
        if (!$nouriture) {
            throw $this->createNotFoundException("Nourriture non trouvée !");
        }

        $em->remove($nouriture);
        $em->flush();
        $this->addFlash('success', 'Nourriture supprimée avec succès !');

        return $this->redirectToRoute('nouriture_liste');
    }
}
