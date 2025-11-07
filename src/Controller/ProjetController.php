<?php

namespace App\Controller;

use App\Entity\Projet;
use App\Form\ProjetType;
use App\Entity\AppelDeFond;
use App\Form\AppelDeFondType;
use App\Repository\ProjetRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/projets', name: 'projets_')]
class ProjetController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(ProjetRepository $projetRepository): Response
    {
        $projets = $projetRepository->findAll();

        return $this->render('projet/index.html.twig', [
            'projets' => $projets,
        ]);
    }

    #[Route('/new', name: 'new')]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $projet = new Projet();
        $form = $this->createForm(ProjetType::class, $projet);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($projet);
            $entityManager->flush();

            return $this->redirectToRoute('projets_index');
        }

        return $this->render('projet/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/edit/{id}', name: 'edit')]
    public function edit(Projet $projet, Request $request, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ProjetType::class, $projet);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('projets_index');
        }

        return $this->render('projet/edit.html.twig', [
            'form' => $form->createView(),
            'projet' => $projet,
        ]);
    }

    #[Route('/delete/{id}', name: 'delete')]
    public function delete(Projet $projet, EntityManagerInterface $entityManager): Response
    {
        $entityManager->remove($projet);
        $entityManager->flush();

        return $this->redirectToRoute('projets_index');
    }

    #[Route('/fonds/{id}', name: 'fonds')]
    public function fonds(Projet $projet, Request $request, EntityManagerInterface $entityManager): Response
    {
        $appelDeFond = new AppelDeFond();
        $appelDeFond->setProjet($projet);

        $form = $this->createForm(AppelDeFondType::class, $appelDeFond);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($appelDeFond);
            $entityManager->flush();

            return $this->redirectToRoute('projets_fonds', ['id' => $projet->getId()]);
        }

        return $this->render('projet/fonds.html.twig', [
            'form' => $form->createView(),
            'projet' => $projet,
        ]);
    }

    #[Route('/fonds/edit/{id}', name: 'fonds_edit')]
    public function editFonds(AppelDeFond $appelDeFond, Request $request, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(AppelDeFondType::class, $appelDeFond);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('projets_fonds', [
                'id' => $appelDeFond->getProjet()->getId()
            ]);
        }

        return $this->render('projet/edit_fonds.html.twig', [
            'form' => $form->createView(),
            'appelDeFond' => $appelDeFond,
        ]);
    }

    #[Route('/fonds/delete/{id}', name: 'fonds_delete')]
    public function deleteFonds(AppelDeFond $appelDeFond, EntityManagerInterface $entityManager): Response
    {
        $projetId = $appelDeFond->getProjet()->getId();

        $entityManager->remove($appelDeFond);
        $entityManager->flush();

        return $this->redirectToRoute('projets_fonds', [
            'id' => $projetId
        ]);
    }
}
