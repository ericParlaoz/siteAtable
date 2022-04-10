<?php

namespace App\Controller;

use App\Entity\Fichiers;
use App\Form\UploadsType;
use App\Repository\FichiersRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MenusSemaineController extends AbstractController
{

    #[Route('/menu/semaine', name: 'menu_semaine')]
    public function menu(Request $request, EntityManagerInterface $em): Response
    {
        $fichier = new Fichiers();
        $form = $this->createForm(UploadsType::class, $fichier);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $em->persist($fichier);
            $em->flush();
        }

        return $this->render('menusSemaine/index.html.twig', [
            'form' => $form->createView()
        ]);

    }

    #[Route('/menu/list', name: 'menu_list')]
    public function menuList(FichiersRepository $fichiersRepository): Response
    {

        $fichiers = $fichiersRepository->findAll();

        return $this->render('menusSemaine/list.html.twig', [
            'fichiers' => $fichiers
        ]);
    }

    #[Route('/menu/edit/{id}', name: 'menu_edit', requirements: ['id' => '[0-9]*'])]
    public function menuEdit(Request $request, Fichiers $fichiers, EntityManagerInterface $em): Response
    {

        $form = $this->createForm(UploadsType::class, $fichiers);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $em->persist($fichiers);
            $em->flush();
        }

        return $this->render('menusSemaine/edit.html.twig', [
            'form' => $form->createView()
        ]);
    }


}
