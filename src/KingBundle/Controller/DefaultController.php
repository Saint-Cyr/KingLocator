<?php

namespace KingBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use KingBundle\Form\TypeType;
use KingBundle\Entity\Type;

class DefaultController extends Controller
{
    public function indexAction(Request $request)
    {
        return $this->render('KingBundle:Default:index.html.twig');
    }
    
    public function registerTypeAction(Request $request)
    {
        //Get the entity manager
        $em = $this->getDoctrine()->getManager();
        
        $type = new Type;
        $form = $this->createForm(TypeType::class, $type);
        
        $form->handleRequest($request);
        
        if($form->isSubmitted() && $form->isValid()){
            $em->persist($type);
            $em->flush();
            
            $request->getSession()
                    ->getFlashBag()
                    ->add('success', 'The type as been added successfully !');
                    $url = $this->generateUrl('king_register_type');

            return $this->redirect($url);
        }
        
        return $this->render('KingBundle:Default:register_type.html.twig',
                             array('form' => $form->createView()));
    }
}
