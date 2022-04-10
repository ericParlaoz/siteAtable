<?php

namespace App\Controller;

use App\Entity\Fichiers;
use App\Form\UploadsType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{
    #[Route('/commandez-repas-a-domicile-poussan', name: 'app_contact')]
    public function index(): Response
    {

        return $this->render('contact/index.html.twig', [
        ]);
    }
}
