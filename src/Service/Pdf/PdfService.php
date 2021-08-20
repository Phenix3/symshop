<?php


namespace App\Service\Pdf;


use Dompdf\Dompdf;

class PdfService
{
    /**
     * @var Dompdf
     */
    private Dompdf $dompdf;

    public function __construct(Dompdf $dompdf)
    {
        $this->dompdf = $dompdf;
    }

    /**
     * @param string $html
     * @param bool $download
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

    /**
     * @return Dompdf
     */
    public function getDompdf(): Dompdf
    {
        return $this->dompdf;
    }
}