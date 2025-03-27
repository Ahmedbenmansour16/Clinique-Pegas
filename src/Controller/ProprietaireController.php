<?php

namespace App\Controller;

use App\Entity\Proprietaire;
use App\Form\ProprietaireType;
use App\Repository\ProprietaireRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class ProprietaireController extends AbstractController
{
    #[Route('/proprietaire', name: 'app_proprietaire')]
    public function index(): Response
    {
        return $this->render('proprietaire/index.html.twig', [
            'controller_name' => 'ProprietaireController',
        ]);
    }

    #[Route('/proprietaire/liste', name: 'proprietaire_liste')]
    public function liste(ProprietaireRepository $proprietaireRepository): Response
    {
        $proprietaires = $proprietaireRepository->findAll();

        return $this->render('proprietaire/table_proprietaire.html.twig', [
            'proprietaires' => $proprietaires,
        ]);
    }

    #[Route('/proprietaire/ajouter', name: 'proprietaire_ajouter')]
    public function ajouter(Request $request, EntityManagerInterface $entityManager): Response
    {
        $proprietaire = new Proprietaire();
        $form = $this->createForm(ProprietaireType::class, $proprietaire);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($proprietaire);
            $entityManager->flush();

            $this->addFlash('success', 'Propriétaire ajouté avec succès !');

            return $this->redirectToRoute('proprietaire_liste');
        }

        return $this->render('proprietaire/ajj_proprietaire.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/proprietaire/modifier/{id}', name: 'proprietaire_modifier')]
public function modifier(int $id, Request $request, EntityManagerInterface $entityManager, ProprietaireRepository $proprietaireRepository): Response
{
    $proprietaire = $proprietaireRepository->find($id);

    if (!$proprietaire) {
        throw $this->createNotFoundException("Propriétaire non trouvé !");
    }

    $form = $this->createForm(ProprietaireType::class, $proprietaire);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
        $entityManager->flush();

        $this->addFlash('success', 'Propriétaire modifié avec succès !');
        return $this->redirectToRoute('proprietaire_liste');
    }

    return $this->render('proprietaire/modif_Proprietaire.html.twig', [
        'form' => $form->createView(),
    ]);
}


#[Route('/proprietaire/supprimer/{id}', name: 'proprietaire_supprimer')]
public function supprimer(int $id, EntityManagerInterface $entityManager, ProprietaireRepository $proprietaireRepository): Response
{
    $proprietaire = $proprietaireRepository->find($id);

    if (!$proprietaire) {
        throw $this->createNotFoundException("Propriétaire non trouvé !");
    }

    $entityManager->remove($proprietaire);
    $entityManager->flush();

    $this->addFlash('success', 'Propriétaire supprimé avec succès !');

    return $this->redirectToRoute('proprietaire_liste');
}


}
