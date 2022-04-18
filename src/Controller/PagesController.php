<?php

namespace App\Controller;

use App\Repository\FichiersRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PagesController extends AbstractController
{
    #[Route('/', name: 'app_accueil')]
    public function index(FichiersRepository $fichiersRepository): Response
    {

       $fichier = $fichiersRepository->findBy([], ['id' => 'DESC'], 1);
       if($fichier === []) {
           throw $this->createNotFoundException('Menu indisponible');
       }
       $path = $fichier[0]->getFilename();




        return $this->render('pages/index.html.twig',[
            'lienMenu' => $path
        ]);
    }

    #[Route('/livraison-de-repas-herault', name: 'app_menu')]
    public function menu(FichiersRepository $fichiersRepository): Response
    {

        $fichier = $fichiersRepository->findBy([], ['id' => 'DESC'], 1);
        if($fichier === []) {
            throw $this->createNotFoundException('Menu indisponible');
        }
        $path = $fichier[0]->getFilename();

        return $this->render('pages/menu.html.twig',[
            'lienMenu' => $path
        ]);
    }

    #[Route('/entretien-jardin-herault', name: 'app_jardin')]
    public function jardin(): Response
    {

        return $this->render('pages/jardin.html.twig');
    }


}
