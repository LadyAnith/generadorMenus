<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Plato;
use App\Entity\TipoPlato;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class PlatosController extends AbstractController
{
    /**
     * @Route("/listado", name="listado")
     */
    public function index()
    {
        $entityManager = $this->getDoctrine()->getManager();
        //Aqui irá el select de platos
        $platosRepo = $this->getDoctrine()->getRepository(Plato::class);
        $platos = $platosRepo->findAll();
        //aqui irá el select de tipos de platos
        $tipoPlatosRepo = $this->getDoctrine()->getRepository(TipoPlato::class);
        $tipoPlatos = $tipoPlatosRepo->findAll();


        return $this->render('platos/index.html.twig', [
            'controller_name' => 'PlatosController',
            //Añadir aqui ambas variables de los listados
            'platos'=>$platos,
            'tipoPlatos'=>$tipoPlatos,
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

        //Convertimos el value de tipoPlatos en int
        $tipoString = $request->request->get('tipoPlatos');
        $tipo = intval($tipoString );

        $plato->setNombre($request->request->get('nombre'))
            ->setCalorias($calorias)
            ->setTipo($tipo);

        $entityManager->persist($plato);
        $entityManager->flush();
        return $this->redirectToRoute('listado');
    }
}
