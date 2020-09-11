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

    
    /**
     * @Route("/generarMenu", name="generar_menu")
     */
    public function generarMenu()
    {
        //Aqui iria lo del generador de PDF que tengo en trello
        
        return $this->render('nuevo_menu/index.html.twig', [
            'controller_name' => 'NuevoMenuController',
        ]);
    }

    /* guia pARA PILLAR PLATOS
        //Pillo los tipos de comidas
        $tipoDesatyuno = repository-finb(1)
        $tipoCena,,, find(2)

        //cONSTRUIR FILTRO
        $filtro = array('tipo' => $tipoDesayuno);
        //bUSCAR PLATOS DEL FILTRO
        $PLAYOSdESAYUNO = $em->getRepository('SomeEntity')->findBy($filtro);


        //cONSTRUIR FILTRO
        $filtro = array('tipo' => $tipocENA);
        //bUSCAR PLATOS DEL FILTRO
        $PLAYOSdESAYUNO = $em->getRepository('SomeEntity')->findBy($filtro);


    */
}
