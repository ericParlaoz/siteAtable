<?php

namespace App\Controller;

use App\Entity\Fichiers;
use App\Form\FichiersType;
use App\Repository\FichiersRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin')]
class AdminController extends AbstractController
{
    #[Route('/', name: 'app_fichiers_index', methods: ['GET'])]
    public function index(FichiersRepository $fichiersRepository): Response
    {
        return $this->render('admin/index.html.twig', [
            'fichiers' => $fichiersRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_fichiers_new', methods: ['GET', 'POST'])]
    public function new(Request $request, FichiersRepository $fichiersRepository): Response
    {
        $fichier = new Fichiers();
        $form = $this->createForm(FichiersType::class, $fichier);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $fichiersRepository->add($fichier);
            return $this->redirectToRoute('app_fichiers_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/new.html.twig', [
            'fichier' => $fichier,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_fichiers_show', methods: ['GET'])]
    public function show(Fichiers $fichier): Response
    {
        return $this->render('admin/show.html.twig', [
            'fichier' => $fichier,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_fichiers_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Fichiers $fichier, FichiersRepository $fichiersRepository): Response
    {
        $form = $this->createForm(FichiersType::class, $fichier);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $fichiersRepository->add($fichier);
            return $this->redirectToRoute('app_fichiers_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/edit.html.twig', [
            'fichier' => $fichier,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_fichiers_delete', methods: ['POST'])]
    public function delete(Request $request, Fichiers $fichier, FichiersRepository $fichiersRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$fichier->getId(), $request->request->get('_token'))) {
            $fichiersRepository->remove($fichier);
        }

        return $this->redirectToRoute('app_fichiers_index', [], Response::HTTP_SEE_OTHER);
    }
}
