<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Entity\Fichiers;
use App\Form\ContactType;
use App\Form\UploadsType;
use App\Repository\ContactRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{
    #[Route('/commandez-repas-a-domicile-poussan', name: 'app_contact')]
    public function index(Request $request, EntityManagerInterface $em, MailerInterface $mailer): Response
    {

        $contact = new Contact();
        $form = $this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {

           $emailContact =$contact->getEmail();
           $emailTel = $contact->getTelephone();
           $emailMessage = $contact->getMessage();
           $emailNom = $contact->getNom();

            $email = (new TemplatedEmail())
                ->from('atable34@hotmail.com')
                ->to('atable34@hotmail.com')
                ->subject('Nouveau message de Atable-services.fr')
                ->text('Nouvelle email')
                ->htmlTemplate('mail/template.html.twig')
                ->context([
                    'emailrender' => $emailContact,
                    'telrender' => $emailTel,
                    'messagerender' => $emailMessage,
                    'nomrender' => $emailNom
            ]);

            $mailer->send($email);

            $this->addFlash('success', 'merci de votre message');
            return $this->redirectToRoute('app_contact');

        }

        return $this->render('contact/index.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
