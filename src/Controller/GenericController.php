<?php


namespace App\Controller;

use App\Entity\Document;
use App\Repository\SubventionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\KernelInterface;
use Symfony\Component\Routing\Annotation\Route;

class GenericController extends AbstractController
{
    /**
     * @Route("/download-document/{document}", name="download_document", methods={"GET"})
     * @param Document $document
     * @param KernelInterface $appKernel
     * @return Response
     */
    public function index(Document $document, KernelInterface $appKernel): Response
    {
        $destination = $appKernel->getProjectDir().'/public/'.$document->getPath();
        $content = file_get_contents($destination);
        $response = new Response();
        //set headers
        $response->headers->set('Content-Type', 'mime/type');
        $response->headers->set('Content-Disposition', 'attachment;filename="'.$destination);
        $response->setContent($content);

        return $response;
    }
}
