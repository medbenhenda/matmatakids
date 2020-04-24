<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Asset\Package;
use Symfony\Component\Asset\VersionStrategy\StaticVersionStrategy;
use Symfony\Component\Asset\PathPackage;
use Symfony\Component\Asset\UrlPackage;
use Symfony\Component\Asset\Packages;
use Symfony\Component\Cache\Adapter\FilesystemAdapter;
use Symfony\Component\Cache\Adapter\AdapterInterface;
use Symfony\Contracts\Cache\ItemInterface;
use Symfony\Component\Cache\Adapter\RedisAdapter;
use Symfony\Component\HttpFoundation\RedirectResponse;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index()
    {
      //dump($this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY'));exit;
      if($this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY')) {
        return $this->redirectToRoute('app_login');
      }

        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'first' => 'World'
        ]);
    }
}
