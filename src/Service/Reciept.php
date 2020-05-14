<?php

namespace App\Service;

use App\Entity\Adherent;
use App\Entity\Don;
use PhpParser\Node\Scalar\String_;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Knp\Snappy\Pdf;
use Symfony\Component\Mime\FileinfoMimeTypeGuesser;
use Symfony\Component\Filesystem\Filesystem;
use WhiteOctober\TCPDFBundle\Controller\TCPDFController;

class Reciept
{

    /**
     * @Var ParameterBagInterface
     */
    protected $parameterBag;

    /**
     * @var Filesystem
     */
    protected $fileSystem;

    /**
     * @var string;
     */
    protected $file;

    /**
     * @var string;
     */
    protected $fileName;

    /**
     * @param ParameterBagInterface $parameterBag
     * @param Filesystem $fileSystem
     */
    public function __construct(ParameterBagInterface $parameterBag, Filesystem $fileSystem)
    {
        $this->parameterBag = $parameterBag;
        $this->fileSystem = $fileSystem;
    }

    /**
     * @param string $receipt
     * @param string|null $path
     */
    public function pdfPreview(string $receipt, ?string $path)
    {
        if ($path) {
            $receipt = $path . '/' . $receipt;
        }
        header('Content-Type: application/pdf');
        header('Content-Disposition: inline; filename=' . $receipt);
        header('Content-Transfer-Encoding: binary');
        header('Accept-Ranges: bytes');

        readfile($receipt);
    }

    /**
     * @param string $receipt
     * @param string|null $path
     */
    public function deleteReceipt(string $receipt, ?string $path): void
    {
        if ($path) {
            $receipt = $path . '/' . $receipt;
        }

        if ($this->fileSystem->exists($receipt)) {
            $this->fileSystem->remove($receipt);
        }
    }

    public static function contentReceipt(Don $don)
    {
        $firstParagraph = '<p>Article 200 du Code Général des Impôts</p>';
        $lastParagraph = '<p>Le bénéficiaire certifie sur l\'honneur que les dons et versements qu\'il reçoit ouvrent droit à la
réduction d\'impôt prévue à l\'article 200 du Code Général des Impôts. Particulier : Vous pouvez
déduire 66% de votre don dans la limite de 20% de votre revenu imposable.</p>';
        if ($don->getIsProfessional()) {
            $firstParagraph = 'Article 238 bis du Code Général des Impôts';
            $lastParagraph = 'Le bénéficiaire certifie sur l\'honneur que les dons et versements qu\'il reçoit ouvrent droit à la
réduction d\'impôt prévue à l\'article 238 bis du Code Général des Impôts.';
        }

        return $firstParagraph .
            '<p style="font-weight: bold;">Matmata Kids</p>
        <p>12 Rue Juillet</p>
        <p>75020 Paris</p>
        <p>Œuvre ou organisme d\'intérêt général</p>
        <p>Objet : Matmata Kids est une association humanitaire à but non lucratif qui a pour but d’aider les enfants les plus démunies, 
        les orphelins, les handicapés et les plus défavorisés dans la région de Matmata dans le sud de la Tunisie. 
        L’association contribue à des actions et des projets de développement durable visant à améliorer les conditions de vie des enfants et 
        leurs familles.
        L’association intervient dans le domaine de l’éducation, la santé et le développement des activités sportives et culturelles.</p>
        <p style="font-weight: bold;">Donateur : </p>
        <p>Nom et Prénom : ' . $don->getDonor() . ' </p>
        <p>Adresse : ' . $don->getDonor()->constructAddress() . '</p>
        <p style="font-weight: bold;">Bénéficiaire : </p>
        <p>Matmata Kids reconnaît avoir reçu, au titre des versements ouvrant droit à une réduction d\'impôt,<br/>
        la somme de : ***' . $don->getAmount() . ' Euros  ***<br/>
        Date du don :  ' . $don->getDate()->format('d-m-Y') . ' 
        <br/> Forme du don : Don manuel  <br/>Nature du don : Numéraire</p>
        <p>Mode de versement : ' . $don->getType() . '</p>
        <p></p>
        ' . $lastParagraph;
    }


    /**
     * @param Don $don
     * @return string
     */
    public function generatePdfReceipt(Don $don)
    {
        $publicResourcesFolderPath = $this->parameterBag->get('kernel.project_dir') . '/public/img/';
        $logo = $publicResourcesFolderPath . 'logo_120.jpg';
        $signature = $publicResourcesFolderPath . 'cachet_mk.png';
        $pdf = new MkTCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        $pdf->SetCreator('Matmata kids');
        $pdf->SetAuthor('Matmata kids');
        $pdf->SetTitle('Receipt for : ' . $don->getDonor() . ' ' . $don->getId() . '/' . $don->getDate()->format('Y'));
        $pdf->SetSubject('Receipt for Don');
        $pdf->SetKeywords('Matmata kids, Receipt, don, RECU FISCAL POUR DON');
        // set default header data
        $pdf->SetHeaderData($logo, 120, 'RECU FISCAL POUR DON', '', [33, 66, 99], [33, 66, 99]);

        // set header and footer fonts
        $pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

        // set default monospaced font
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

        // set margins
        $pdf->SetMargins(PDF_MARGIN_LEFT, 2, PDF_MARGIN_RIGHT);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

        // set auto page breaks
        $pdf->SetAutoPageBreak(true, PDF_MARGIN_BOTTOM);
        // set font
        $pdf->SetFont('dejavusans', '', 8);
        // add a page
        $pdf->AddPage();

        $pdf->setCellPaddings(1, 1, 1, 1);

        // set cell margins
        $pdf->setCellMargins(1, 1, 1, 1);
        $pdf->SetFillColor(255, 255, 255);
        $pdf->MultiCell(40, 15, "N° d'ordre du reçu\n" . $don->getId() . '/' . $don->getDate()->format('Y'), 1, 'C', 1, 1, '160', '15', true);

        $pdf->Ln(4);
        $html = self::contentReceipt($don);
        $pdf->writeHTML($html, true, false, true, false, '');

        $pdf->Image($signature, 50, 230, 50, 30, 'PNG', '', '', true, 150, '', false, false, 0, false, false, false);

        $filename = $don->getDonor()->constructName() . '_' . $don->getDate()->format('Ymdhis') . '.pdf';
        $filePath = $this->parameterBag->get('kernel.project_dir') . '/public/receipt/' . $filename;
        $pdf->Output($filePath, 'F');
        //$pdf->Output($filename, 'D');
        return $filePath;
    }
}
