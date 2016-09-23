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
        
        $response = new JsonResponse($tab);
        $response->headers->set('Access-Control-Allow-Origin', 'http://localhost');
        return $response;
    }
    
    public function stepTwoAction()
    {
        return new Response('welcom to the step two !');
    }
    
    public function stepThreeAction($id, $lat, $long)
    {
        //Get the entity manager
        $em = $this->getDoctrine()->getManager();
        //Get the categoryInstance from the DB
        $categoryInstance = $em->getRepository('KingBundle:CategoryInstance')->find($id);
        //Make sure $category exists in DB
        if(!$categoryInstance){
            throw $this->createNotFoundException('Category Instance of ID "'.$id.'" not found in the DB');
        }
        //Get all the interest related to the categoryInstance
        $interests = $categoryInstance->getInterests();
        //$interests = $em->getRepository('KingBundle:Interest')->findAll();
        return $this->render('KingBundle:Default:result.html.twig', array('interests' => $interests, 'categoryInstanceId' => $id));
    }
}
