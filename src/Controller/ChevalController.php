<?php

namespace App\Controller;

use App\Entity\Cheval;
use App\Form\ChevalType;
use App\Repository\ChevalRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

class ChevalController extends AbstractController
{
    #[Route('/chevaux/liste', name: 'cheval_liste')]
    public function liste(ChevalRepository $repository): Response
    {
        $chevaux = $repository->findAll();

        return $this->render('cheval/table_cheval.html.twig', [
            'chevaux' => $chevaux,
        ]);
    }

    #[Route('/chevaux/ajouter', name: 'cheval_ajouter')]
    public function ajouter(Request $request, EntityManagerInterface $em, SluggerInterface $slugger): Response
    {
        $cheval = new Cheval();
        $form = $this->createForm(ChevalType::class, $cheval);
        $form->handleRequest($request);
    
        if ($form->isSubmitted() && $form->isValid()) {
    
            // ✅ Upload photo
            /** @var UploadedFile $photoFile */
            $photoFile = $form->get('photo')->getData();
            if ($photoFile) {
                $originalFilename = pathinfo($photoFile->getClientOriginalName(), PATHINFO_FILENAME);
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename . '-' . uniqid() . '.' . $photoFile->guessExtension();
    
                $photoFile->move(
                    $this->getParameter('cheval_photos_directory'),
                    $newFilename
                );
    
                $cheval->setPhoto($newFilename);
            }
    
            // ✅ Upload rapport Word
            /** @var UploadedFile $rapportFile */
            $rapportFile = $form->get('rapportCheval')->getData();
            if ($rapportFile) {
                $originalRapportName = pathinfo($rapportFile->getClientOriginalName(), PATHINFO_FILENAME);
                $safeRapportName = $slugger->slug($originalRapportName);
                $newRapportName = $safeRapportName . '-' . uniqid() . '.' . $rapportFile->guessExtension();
    
                $rapportFile->move(
                    $this->getParameter('cheval_rapports_directory'), // 👈 à définir dans services.yaml
                    $newRapportName
                );
    
                $cheval->setRapportCheval($newRapportName);
            }
    
            // ✅ Calcul du reste à payer
            $pension = $cheval->getPension();
            if ($pension && method_exists($pension, 'getPrixPension')) {
                $prixPension = $pension->getPrixPension();
                $montantPaye = $cheval->getPaye();
                $reste = max($prixPension - $montantPaye, 0);
                $cheval->setRestePaye($reste);
            }
    
            $em->persist($cheval);
            $em->flush();
    
            $this->addFlash('success', 'Cheval ajouté avec succès.');
            return $this->redirectToRoute('cheval_liste');
        }
    
        return $this->render('cheval/ajj_cheval.html.twig', [
            'form' => $form->createView(),
        ]);
    }
    
    #[Route('/chevaux/details/{id}', name: 'cheval_details')]
public function details(int $id, ChevalRepository $repository): Response
{
    $cheval = $repository->find($id);
    if (!$cheval) {
        throw $this->createNotFoundException('Cheval non trouvé');
    }

    return $this->render('cheval/details_cheval.html.twig', [
        'cheval' => $cheval,
    ]);
}

    #[Route('/chevaux/modifier/{id}', name: 'cheval_modifier')]
    public function modifier(int $id, Request $request, ChevalRepository $repository, EntityManagerInterface $em): Response
    {
        $cheval = $repository->find($id);
        if (!$cheval) {
            throw $this->createNotFoundException("Cheval non trouvé.");
        }

        $form = $this->createForm(ChevalType::class, $cheval);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->flush();
            $this->addFlash('success', 'Cheval modifié avec succès');
            return $this->redirectToRoute('cheval_liste');
        }

        return $this->render('cheval/modif_cheval.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/chevaux/supprimer/{id}', name: 'cheval_supprimer', methods: ['POST'])]
    public function supprimer(int $id, EntityManagerInterface $em, ChevalRepository $repository): Response
    {
        $cheval = $repository->find($id);
        if (!$cheval) {
            throw $this->createNotFoundException("Cheval non trouvé.");
        }

        $em->remove($cheval);
        $em->flush();

        $this->addFlash('success', 'Cheval supprimé avec succès.');
        return $this->redirectToRoute('cheval_liste');
    }
}
