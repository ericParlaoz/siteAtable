<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class JardinController extends AbstractController
{
    #[Route('/entretien-jardin-herault', name: 'app_jardin')]
    public function index(): Response
    {
        return $this->render('jardin/index.html.twig', [
            'controller_name' => 'JardinController',
        ]);
    }
}
