<?php

namespace App\Controller;

use Psr\Log\LoggerInterface;                        // ← on importe le logger
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

final class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(LoggerInterface $logger): Response
    {
        $logger->info('Page d’accueil chargée', [
            'controller' => 'HomeController',
            'route'      => 'app_home',
        ]);

        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }

    #[Route('/send-pdf', name: 'app_send_pdf')]
    public function sendPdf(MailerInterface $mailer): Response
    {
        $email = new Email();
        $email->from('test@example.com');
        $email->to("arnaudmirocha@gmail.com");
        //$email->cc();
        //$email->bcc();
        $email->subject("récapitulatif de la facturation");
        $email->html("<p>test</p>");
        $email->text("test");
        //$email->attach();

        $mailer->send($email);

        return new Response('Email envoyé');
    }
}
