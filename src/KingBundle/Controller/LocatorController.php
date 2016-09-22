<?php

namespace KingBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use KingBundle\Form\TypeType;
use KingBundle\Form\InterestType;
use KingBundle\Entity\Interest;

class LocatorController extends Controller
{
    public function stepOneAction()
    {
        //Get the entity manager
        $em = $this->getDoctrine()->getManager();
        //Get all the types
        
        $categoryInstances = $em->getRepository('KingBundle:CategoryInstance')->findAll();
        return $this->render('KingBundle:Locator:step_one.html.twig', array('categoryInstances' => $categoryInstances));
    }
    
    public function categoryInstancesAction()
    {
        //Get the entity manager
        $em = $this->getDoctrine()->getManager();
        //Get all the types
        $categoryInstances = $em->getRepository('KingBundle:CategoryInstance')->findAll();
        
        foreach ($categoryInstances as $c){
            $route = $this->generateUrl('king_step_two', array('id' => $c->getId()));
            $tab[] = array('name' => $c->getName(), 'url' => $route, 'description' => $c->getDescription(), 'logo' => $c->getLogo());
        }
        
        return new JsonResponse($tab);
    }
    
    public function stepTwoAction()
    {
        return new Response('welcom to the step two !');
    }
    
    public function stepThreeAction($id, $lat, $long)
    {
        return new Response('welcome to the step three ! ID: '.$id.' LAT: '.$lat.' LONG: '.$long);
    }
}
