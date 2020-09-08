<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class PlatosController extends AbstractController
{
    /**
     * @Route("/listado", name="listado")
     */
    public function index()
    {
        return $this->render('platos/index.html.twig', [
            'controller_name' => 'PlatosController',
        ]);
    }
}
