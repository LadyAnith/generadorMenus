<?php

namespace App\Controller;

use App\Entity\Alergenos;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Plato;
use App\Entity\TipoPlato;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;


/**
 * @IsGranted("ROLE_USER")
 */
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

        $alergenosRepo = $this->getDoctrine()->getRepository(Alergenos::class);
        $alergenos= $alergenosRepo->findAll();

        return $this->render('platos/index.html.twig', [
            'controller_name' => 'PlatosController',
            //Añadir aqui ambas variables de los listados
            'platos'=>$platos,
            'tipoPlatos'=>$tipoPlatos,
            'alergenos' =>$alergenos,
        ]);
    }

    /**
     * @Route("/altaPlato", name="altaPlato", methods={"POST"})
     */
    public function altaPlato(Request $request): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        //Con esta variable voy a hacer el select de la tabla los tipo de platos
        $tipoplatoRepo = $this->getDoctrine()->getRepository(TipoPlato::class);
        $alergenosRepo = $this->getDoctrine()->getRepository(Alergenos::class);

        //Casteo las calorías a float 
        $calorias = floatval($request->request->get('calorias'));

        //Casteo la id de los tipos a int 
        $idTipo = intval($request->request->get('tipoPlatos'));
        //Obtenemos el tipo que es un objeto que hemos seleccionado
        $tipoPlato = $tipoplatoRepo->find($idTipo);

         //Casteo la id de los alergenos a int 
        $idAlergenos = $request->request->get('alergenos');
        //Obtenemos el alergeno que es un objeto que hemos seleccionado anteriormente
        $alergenos = $alergenosRepo->findBy(
           ['id'=> $idAlergenos]
       );

        $plato = new Plato();

        $plato->setNombre($request->request->get('nombre'))
            ->setCalorias($calorias)
            ->setTipo($tipoPlato)
            ->setListaAlergenos(new ArrayCollection($alergenos));
        $nombrePlato = $plato->getNombre();

        $entityManager->persist($plato);
        $entityManager->flush();

        $this->addFlash('info','Se ha ingresado el plato: '.$nombrePlato. ' correctamente.');
        return $this->redirectToRoute('listado');
    }

     /**
     * @Route("/bajaPlato/{id}", name="bajaPlato")
     */
    public function bajaPlato($id)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $platoRepo = $this->getDoctrine()->getRepository(Plato::class);

        $plato = $platoRepo->find($id);

        $entityManager->remove($plato);
        $entityManager->flush();

        $platos = $platoRepo->findAll();

        $this->addFlash('info','Plato eliminado correctamente!');

        return $this->redirectToRoute('listado');
    }

     /**
     * @Route("/editarPlato/{id}", name="editarPlato", methods={"GET"})
     */

    public function editarPlato($id)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $platoRepo = $this->getDoctrine()->getRepository(Plato::class);
        $plato =  $platoRepo->find($id);

        $tipoPlatosRepo = $this->getDoctrine()->getRepository(TipoPlato::class);
        $tipoPlatos = $tipoPlatosRepo->findAll();

        $tipoAlergenoRepo = $this->getDoctrine()->getRepository(Alergenos::class);
        $tipoAlergenos = $tipoAlergenoRepo->findAll();


        if (!$plato) {
            throw $this->createNotFoundException(
                'No existe Plato con id: '.$id
            );
        }

        $platos = $platoRepo->findAll();

        return $this->render('platos/index.html.twig', [
            'controller_name' => 'PlatosController',
            //ESTO es la variable de la lista de TODOS LOS PLATOS que se muestra por defecto
            'platos'=>$platos,
            //ESTO es la variable de tipos de platos que se muestra EN LOSSSSS SELECTORES de editar y alta
            'tipoPlatos'=>$tipoPlatos,
            //ESTO es la variable de tipos de alergenos que se muestran en los check de editar y alta
            'alergenos'=>$tipoAlergenos,
            //AQUI falta una variable del PLATO a editar que en la plantilla se llama plato 
            'plato'=> $plato,
        ]);
      
    }

    /**
     * @Route("/editarPlato/{id}", name="editarPlato2", methods={"POST"})
     */
    public function editarPlato2(Request $request, $id):Response
    {
        //AQUI los repos para pillar datos
        $entityManager = $this->getDoctrine()->getManager();
        $platoRepo = $entityManager->getRepository(Plato::class);
        $tipoPlatoRepo = $entityManager->getRepository(TipoPlato::class);
        $alergenoRepo = $entityManager->getRepository(Alergenos::class);

        //AQUI pillas los valores de la request para hacer transformaciones
        //Casteo las calorías a float 
        $calorias = floatval($request->request->get('calorias'));
        //Casteo la id de los tipos a int 
        $idTipo = intval($request->request->get('tipoPlatos'));
        //Recojo el tipo de alérgenos del plato
        $idAlergenos = $request->request->get('alergenos');

        //AQUI pillas los objetos de base de datos por ID
        $tipoPlato = $tipoPlatoRepo->find($idTipo);
        $plato = $platoRepo->find($id);


        //Aqui pillamos los objetos de base de datos por id
        $alergeno = $alergenoRepo->findBy(
            ['id'=> $idAlergenos]
        ); 
       
        //AQUI compruebas que existan los objetos en base de datos y no haya habido problemas al recuperarlos
        if (!$platoRepo) {
            throw $this->createNotFoundException( 
                'No existe un plato con id: '.$id
            );
        }
        if (!$plato) {
            throw $this->createNotFoundException( 
                'No existe un tipo de plato con id: '.$idTipo
            );
        }

        if (!$alergeno) {
            throw $this->createNotFoundException( 
                'No existe un alérgeno con id: '.$idAlergenos
            );
        }

        //Aquí reconstruyes el plato a editar con los valores de las request para poder actualizarlo
        $plato->setNombre($request->request->get('nombre'))
        ->setCalorias($calorias)
        ->setTipo($tipoPlato)
        ->setListaAlergenos(new ArrayCollection($alergeno));
        
        //Se encarga de hacer el update
        $entityManager->flush();

        //Añadir mensajes que aparecerán sólo una vez cuando la página se recargue
        $this->addFlash('info','Plato modificado correctamente!');

        return $this->redirectToRoute('listado');
    }

}
