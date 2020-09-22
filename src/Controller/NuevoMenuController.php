<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Plato;
use App\Entity\TipoPlato;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Mpdf\Mpdf;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

/**
* @IsGranted("ROLE_USER")
*/
class NuevoMenuController extends AbstractController
{
    /**
     * @Route("/nuevoMenu", name="nuevo_menu")
     */
    public function index()
    {
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

        return $this->render('nuevo_menu/index.html.twig', [
            'controller_name' => 'NuevoMenuController',
            'platosDesayuno' => $platosDesayuno,
            'platosComida' => $platosComida,
            'platosCena' => $platosCena,
            'platosPostre' => $platosPostre,
        ]);
    }

    
    /**
     * @Route("/generarMenu", name="generar_menu", methods={"POST"})
     */
    public function generarMenu(Request $request) 
    {
        $des = $request->request->get('desayuno');
        $com = $request->request->get('comida');
        $pCom = $request->request->get('postreComida');
        $cen = $request->request->get('cena');
        $pCen = $request->request->get('postreCena'); 
        

         //AQUI los repos para pillar datos
         $entityManager = $this->getDoctrine()->getManager();
         $platoRepo = $entityManager->getRepository(Plato::class);
        

         //Busco en el repositorio los datos que he seleccionado en el gestor de menú
        $desayuno = $platoRepo->find($des);
        $comida = $platoRepo->find($com);
        $postreComida = $platoRepo->find($pCom);
        $cena = $platoRepo->find($cen);
        $postreCena = $platoRepo->find($pCen);

        //Aqui iria lo del generador de PDF que tengo en trello
        $pdf = $this->render('nuevo_menu/menuDia.html.twig', [
            'desayuno'=>$desayuno,
            'comida'=>$comida, 
            'postreComida'=>$postreComida,
            'cena'=>$cena,
            'postreCena'=>$postreCena,
           
        ]);

        $leyenda = $this->render('nuevo_menu/leyendaAlergenos.html.twig',[

        ]);

        $mpdf = new Mpdf();
        $mpdf->WriteHTML($pdf);
        //Añadir otra página al pdf
        $mpdf->AddPage();
        //Escribir en la página nueva del pdf el siguiente html
        $mpdf->WriteHTML($leyenda);
        $mpdf->Output();
       
    }
}
