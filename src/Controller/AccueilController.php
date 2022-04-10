<?php

namespace App\Controller;

use App\Repository\FichiersRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AccueilController extends AbstractController
{
    #[Route('/', name: 'app_accueil')]
    public function index(FichiersRepository $fichiersRepository): Response
    {

       $fichier = $fichiersRepository->findBy([], ['id' => 'DESC'], 1);
       $path = $fichier[0]->getFilename();

        return $this->render('accueil/index.html.twig',[
            'lienMenu' => $path
        ]);
    }
}
