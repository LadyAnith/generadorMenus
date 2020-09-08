<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class NuevoMenuController extends AbstractController
{
    /**
     * @Route("/nuevoMenu", name="nuevo_menu")
     */
    public function index()
    {
        return $this->render('nuevo_menu/index.html.twig', [
            'controller_name' => 'NuevoMenuController',
        ]);
    }
}
