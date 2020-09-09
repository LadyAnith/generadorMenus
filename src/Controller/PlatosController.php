<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Plato;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class PlatosController extends AbstractController
{
    /**
     * @Route("/listado", name="listado")
     */
    public function index()
    {
        //Aqui irá el select de platos
        //aqui irá el select de tipos de platos

        return $this->render('platos/index.html.twig', [
            'controller_name' => 'PlatosController',
            //Añadir aqui ambas variables de los listados
        ]);
    }

    /**
     * @Route("/altaPlato", name="altaPlato", methods={"POST"})
     */
    public function altaPlato(Request $request): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $plato = new Plato();

        //Convertimos las calorías en float 
        $caloriasString = $request->request->get('calorias');
        $calorias = floatval(str_replace(',', '.', str_replace('.', '', $caloriasString)));

        $plato->setNombre($request->request->get('nombre'))
            ->setCalorias($calorias)
            ->setCalorias($request->request->get('tipoPlatos'));

        $entityManager->persist($plato);
        $entityManager->flush();
        return $this->redirectToRoute('listado');
    }
}
