<?php

namespace App\Controller;

use Psr\Log\LoggerInterface;                        // ← on importe le logger
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use App\Service\PdfService;
use App\Service\FileManager;
use Symfony\Component\Security\Core\User\UserInterface;

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
    public function sendPdf(MailerInterface $mailer, PdfService $pdfService): Response
    {
        $items = $this->buildItems();
        $pdfBinary = $pdfService->renderPdf('pdf/note.html.twig', [
            'title' => 'Note PDF',
            'date'  => new \DateTimeImmutable(),
            'items' => $items,
        ]);

        $recipient = $this->resolveRecipientEmail();

        $email = new Email();
        $email->from('noreply@example.com');
        $email->to($recipient);
        $email->subject('Votre note PDF');
        $email->html('<p>Veuillez trouver votre note en pièce jointe.</p>');
        $email->attach($pdfBinary, 'note.pdf', 'application/pdf');

        $mailer->send($email);

        return new Response('PDF généré et envoyé à ' . $recipient);
    }

    #[Route('/pdf', name: 'app_pdf_preview')]
    public function pdfPreview(PdfService $pdfService, FileManager $fileManager): Response
    {
        $items = $this->buildItems();

        $pdfBinary = $pdfService->renderPdf('pdf/note.html.twig', [
            'title' => 'Note PDF',
            'date'  => new \DateTimeImmutable(),
            'items' => $items,
        ]);

        // Sauvegarde facultative sous var/pdf
        $fileManager->save('pdf', 'note-' . date('Ymd-His') . '.pdf', $pdfBinary);

        return new Response($pdfBinary, 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="note.pdf"',
        ]);
    }

    private function buildItems(): array
    {
        return [
            ['label' => 'Ligne 1', 'amount' => 12.5],
            ['label' => 'Ligne 2', 'amount' => 7.99],
            ['label' => 'Ligne 3', 'amount' => 3.4],
        ];
    }

    private function resolveRecipientEmail(): string
    {
        $fallback = 'exemple@gmal.com';
        $user = $this->getUser();
        if ($user instanceof UserInterface) {
            if (method_exists($user, 'getEmail')) {
                $email = $user->getEmail();
                if (is_string($email) && $email !== '') {
                    return $email;
                }
            }
        }
        return $fallback;
    }
}
