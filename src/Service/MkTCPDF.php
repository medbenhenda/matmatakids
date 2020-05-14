<?php


namespace App\Service;

use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

class MkTCPDF extends \TCPDF
{
    public function Header()
    {
        // Logo
        $image_file = dirname(__FILE__).'/../../public/img/logo_80.jpg';
        $this->Image($image_file, 10, 10, 0, 0, 'JPG', '', 'T', true, 600, '', false, false, 0, false, false, false);
        // Set font
        $this->SetFont('helvetica', 'B', 20);
        // Title
        $this->Cell(0, 35, 'Reçu fiscal', 0, false, 'C', 0, '', 0, false, 'M', 'M');
    }

    // Page footer

    /**
     * Footer
     */
    public function Footer()
    {
        // Position at 15 mm from bottom
        $this->SetY(-15);
        // Set font
        $this->SetFont('helvetica', 'I', 8);
        // Page number
        $this->Cell(0, 10, 'Page '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
    }
}
