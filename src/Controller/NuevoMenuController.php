<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Plato;
use App\Entity\TipoPlato;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

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

        $entityManager = $this->getDoctrine()->getManager();
        //Hago select de la tabla los tipo de platos
        $tipoPlatoRepo = $this->getDoctrine()->getRepository(TipoPlato::class);

        //guardo en una variable los tipos de comida que hay en mi base de datos    
        $tipoDesayuno = $tipoPlatoRepo->find(1);  
        $tipoComida = $tipoPlatoRepo->find(2);
        $tipoCena = $tipoPlatoRepo->find(3);
        $tipoPostre = $tipoPlatoRepo->find(4);

        //Construyo el filtro para cada elemento
        $filtroDesayuno = array('tipo' =>$tipoDesayuno);
        $filtroComida = array('tipo' =>$tipoComida);
        $filtroCena = array('tipo' =>$tipoCena);
        $filtroPostre = array('tipo' =>$tipoPostre);

        //Busco los elementos que contengan ese campo específico del filtro en la BBDD, y los guardo en una variable
        $platosDesayuno = $this->getDoctrine()->getRepository(Plato::class)->findBy($filtroDesayuno);
        $platosComida = $this->getDoctrine()->getRepository(Plato::class)->findBy($filtroComida);
        $platosCena = $this->getDoctrine()->getRepository(Plato::class)->findBy($filtroCena);
        $platosPostre = $this->getDoctrine()->getRepository(Plato::class)->findBy($filtroPostre);
    }
}
