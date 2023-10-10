<?php


namespace App\Service\Pdf;


use Dompdf\Dompdf;

class PdfService
{
    public function __construct(private Dompdf $dompdf)
    {
    }

    /**
     * @return string|null|void
     */
    public function generate(string $html, bool $download = false)
    {
        $this->dompdf->loadHtml($html, 'utf-8');
        $this->dompdf->render();
        if ($download) {
            return $this->dompdf->output();
        }

        $this->dompdf->stream();
    }

    public function getDompdf(): Dompdf
    {
        return $this->dompdf;
    }
}