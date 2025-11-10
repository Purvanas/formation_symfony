<?php

namespace App\Service;

use Dompdf\Dompdf;
use Dompdf\Options;
use Twig\Environment as TwigEnvironment;

final class PdfService
{
    private TwigEnvironment $twig;

    public function __construct(TwigEnvironment $twig)
    {
        $this->twig = $twig;
    }

    /**
     * Render a Twig template into a PDF binary string.
     *
     * @param string $template Twig template path (e.g. 'pdf/note.html.twig')
     * @param array<string,mixed> $parameters Variables passed to the template
     */
    public function renderPdf(string $template, array $parameters = []): string
    {
        $html = $this->twig->render($template, $parameters);

        $options = new Options();
        $options->set('defaultFont', 'DejaVu Sans');
        $options->set('isRemoteEnabled', true);
        $options->set('isHtml5ParserEnabled', true);

        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        return $dompdf->output();
    }
}


