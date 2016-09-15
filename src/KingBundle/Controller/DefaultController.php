<?php

namespace KingBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use KingBundle\Form\TypeType;
use KingBundle\Form\InterestType;
use KingBundle\Entity\Interest;

class DefaultController extends Controller
{
    public function indexAction(Request $request)
    {
        //Get the entity manager
        $em = $this->getDoctrine()->getManager();
        //Get all the types
        $interests = $em->getRepository('KingBundle:Interest')->findAll();
        
        return $this->render('KingBundle:Default:index.html.twig', array('interests' => $interests));
    }
    
    public function resultAction()
    {
        $request = $this->container->get('request_stack')->getCurrentRequest();
        
          //$lat = $request->request->get('lat');
          $lat = $request->query->get('lat');
          $long = $request->query->get('long');
            
            //return $this->render('KingBundle:Default:_result.html.twig', array('lat' => $lat, 'long' => $long));
            return $this->render('KingBundle:Default:result.html.twig');
            //return new JsonResponse($lat);
        
        
        //$request = $this->get('request');
        //request your data
        
        //Get the entity manager
        $em = $this->getDoctrine()->getManager();
        //Get all the types
        $interests = $em->getRepository('KingBundle:Interest')->findAll();
        
        return $this->render('KingBundle:Default:result.html.twig', array('interests' => $interests));
    }
    
    public function registerInterestAction(Request $request)
    {
        //Get the entity manager
        $em = $this->getDoctrine()->getManager();
        
        $interest = new Interest();
        
        $form = $this->createForm(InterestType::class, $interest);
        
        $form->handleRequest($request);
        
        if($form->isSubmitted() && $form->isValid()){
            $em->persist($interest);
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
