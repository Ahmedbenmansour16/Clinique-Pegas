<?php

namespace App\Controller;

use App\Entity\Pension;
use App\Form\PensionType;
use App\Repository\PensionRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class PensionController extends AbstractController
{
    #[Route('/pension/liste', name: 'pension_liste')]
    public function liste(PensionRepository $pensionRepository): Response
    {
        $pensions = $pensionRepository->findAll();

        return $this->render('pension/table_pension.html.twig', [
            'pensions' => $pensions,
        ]);
    }

    #[Route('/pension/modifier/{id}', name: 'pension_modifier')]
    public function modifier(int $id, Request $request, EntityManagerInterface $em, PensionRepository $pensionRepository): Response
    {
        $pension = $pensionRepository->find($id);
        if (!$pension) {
            throw $this->createNotFoundException("Pension non trouvée !");
        }

        $form = $this->createForm(PensionType::class, $pension);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->flush();
            $this->addFlash('success', 'Pension modifiée avec succès !');
            return $this->redirectToRoute('pension_liste');
        }

        return $this->render('pension/modif_pension.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/pension/supprimer/{id}', name: 'pension_supprimer')]
    public function supprimer(int $id, EntityManagerInterface $em, PensionRepository $pensionRepository): Response
    {
        $pension = $pensionRepository->find($id);
        if (!$pension) {
            throw $this->createNotFoundException("Pension non trouvée !");
        }

        $em->remove($pension);
        $em->flush();
        $this->addFlash('success', 'Pension supprimée avec succès !');

        return $this->redirectToRoute('pension_liste');
    }

    #[Route('/pension/ajouter', name: 'pension_ajouter')]
public function ajouter(Request $request, EntityManagerInterface $em): Response
{
    $pension = new Pension();
    $form = $this->createForm(PensionType::class, $pension);

    $form->handleRequest($request);
    if ($form->isSubmitted() && $form->isValid()) {
        $em->persist($pension);
        $em->flush();

        $this->addFlash('success', 'Pension ajoutée avec succès.');
        return $this->redirectToRoute('pension_liste'); // La route de la liste
    }

    return $this->render('pension/ajj_pension.html.twig', [
        'form' => $form->createView(),
    ]);
}
}
