<?php
// src/Controller/DiciplineController.php

namespace App\Controller;

use App\Entity\Dicipline;
use App\Form\DiciplineType;
use App\Repository\DiciplineRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class DiciplineController extends AbstractController
{
    #[Route('/dicipline/liste', name: 'dicipline_liste')]
    public function liste(DiciplineRepository $repo): Response
    {
        return $this->render('dicipline/table_dicipline.html.twig', [
            'diciplines' => $repo->findAll(),
        ]);
    }

    #[Route('/dicipline/ajouter', name: 'dicipline_ajouter')]
    public function ajouter(Request $request, EntityManagerInterface $em): Response
    {
        $dicipline = new Dicipline();
        $form = $this->createForm(DiciplineType::class, $dicipline);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($dicipline);
            $em->flush();

            return $this->redirectToRoute('dicipline_liste');
        }

        return $this->render('dicipline/ajj_dicipline.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/dicipline/modifier/{id}', name: 'dicipline_modifier')]
    public function modifier(int $id, Request $request, DiciplineRepository $repo, EntityManagerInterface $em): Response
    {
        $dicipline = $repo->find($id);
        if (!$dicipline) {
            throw $this->createNotFoundException('Discipline non trouvée.');
        }

        $form = $this->createForm(DiciplineType::class, $dicipline);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->flush();
            return $this->redirectToRoute('dicipline_liste');
        }

        return $this->render('dicipline/modif_dicipline.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/dicipline/supprimer/{id}', name: 'dicipline_supprimer')]
    public function supprimer(int $id, DiciplineRepository $repo, EntityManagerInterface $em): Response
    {
        $dicipline = $repo->find($id);
        if (!$dicipline) {
            throw $this->createNotFoundException('Discipline non trouvée.');
        }

        $em->remove($dicipline);
        $em->flush();

        return $this->redirectToRoute('dicipline_liste');
    }
}
