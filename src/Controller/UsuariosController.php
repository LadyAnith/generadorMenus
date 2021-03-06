<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Usuario;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;



class UsuariosController extends AbstractController
{
    /**
     * @IsGranted("ROLE_USER")
     * @Route("/usuarios", name="usuarios")
     */
    public function index()
    {
        //vuelco el listado en el render:
        $entityManager = $this->getDoctrine()->getManager();
        $usuarioRepo = $this->getDoctrine()->getRepository(Usuario::class);

        //Guardo en una variable todo el contenido de la variable anterior, que lo interpreta como un array:
        $usuarios = $usuarioRepo->findAll();

        return $this->render('usuarios/index.html.twig', [
            'controller_name' => 'UsuariosController',
            //Aquí indico el nombre de la variable donde guardo todo el listado, y le doy un name
            'usuarios'=>$usuarios,
        ]);
    }   


    /**
     * @Route("/altaUsuario", name="altaUsuario", methods={"POST"})
     */

    public function altaUsuario(Request $request, UserPasswordEncoderInterface $encoder): Response
    {

        
        $entityManager = $this->getDoctrine()->getManager();
        $usuario = new Usuario();
        $pass = $request->request->get('contrasenia');

        $usuario->setNombre($request->request->get('nombre'));
        
        $encoded = $encoder->encodePassword($usuario, $pass);
        $usuario->setContrasenia($encoded);
        
        $entityManager->persist($usuario);
        $nombreUsu = $usuario->getNombre();

        $entityManager->flush();
        $this->addFlash('info','Bienvenido '.$nombreUsu. ' has sido dado de alta satistactoriamente!');

        return $this->redirectToRoute('usuarios');

    }

    /**
     * @Route("/bajaUsuario/{id}", name="bajaUsuario")
     */
    public function bajaUsuario($id)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $usuarioRepo = $this->getDoctrine()->getRepository(Usuario::class);

        $usuario = $usuarioRepo->find($id);

        $entityManager->remove($usuario);
        $entityManager->flush();

        $usuarios = $usuarioRepo->findAll();

        $this->addFlash('info','Usuario dado de baja correctamente!');

        return $this->redirectToRoute('usuarios');

    }

     /**
     * @Route("/editarUsuario/{id}", name="editarUsuario", methods={"GET"})
     */

    public function editarUsuario($id)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $usuarioRepo = $this->getDoctrine()->getRepository(Usuario::class);
        
        $usuario =  $usuarioRepo->find($id);

        if (!$usuario) {
            throw $this->createNotFoundException(
                'No existe usuario con id: '.$id
            );
        }

        $usuarios = $usuarioRepo->findAll();
        return $this->render('usuarios/index.html.twig', [
            'controller_name' => 'UsuariosController',
            //Aquí indico el nombre de la variable donde guardo todo el listado, y le doy un name
            'usuarios'=>$usuarios,
            //Este es el usuario que voy a editar
            'usuario'=>$usuario,
            'actualizado'=> true,
        ]);
      
    }

    /**
     * @Route("/editarUsuario/{id}", name="editarUsuario2", methods={"POST"})
     */
    public function editarUsuario2(Request $request, UserPasswordEncoderInterface $encoder, $id):Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $usuarioRepo = $entityManager->getRepository(Usuario::class);
        $usuario = $usuarioRepo->find($id);

        if (!$usuario) {
            throw $this->createNotFoundException( 
                'No existe un usuario con id: '.$id
            );
        }
        //Codificar la contraseña con la funcion encodedPassword de symfony para que no se queje el login de que no coincide la codificacion
        $pass = $request->request->get('contrasenia');
        $encodedPass = $encoder->encodePassword($usuario, $pass);
        
        //Preparo el usuario para modificar sus valores
        $usuario->setNombre($request->request->get('nombre'))
            ->setContrasenia($encodedPass);

        $entityManager->persist($usuario);     
        $entityManager->flush();

        $this->addFlash('info','Usuario modificado correctamente!');

        return $this->redirectToRoute('usuarios');
    }


}
