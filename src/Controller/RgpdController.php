<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RgpdController extends AbstractController
{
    #[Route('/mentions', name: 'mentions')]
    public function mentions(): Response
    {
        return $this->render('rgpd/mentions.html.twig', [
            'controller_name' => 'RgpdController',
        ]);
    }

    #[Route('/confidentialite', name: 'confidentialite')]
    public function confidentialite(): Response
    {
        return $this->render('rgpd/confidentialite.html.twig', [
            'controller_name' => 'RgpdController',
        ]);
    }
}
