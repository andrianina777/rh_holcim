<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PremierPageController extends AbstractController
{
    /**
     * @Route("/", name="Accueil")
     */
    public function index(): Response
    {
        return $this->render('premier_page/index.html.twig', [
            'controller_name' => 'PremierPageController',
        ]);
    }
}
