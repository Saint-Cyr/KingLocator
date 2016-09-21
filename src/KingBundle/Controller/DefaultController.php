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
    
    public function searchAction()
    {
        //Get the entity manager
        $em = $this->getDoctrine()->getManager();
        //Get all the types
        $categoryInstances = $em->getRepository('KingBundle:CategoryInstance')->findAll();
        return $this->render('KingBundle:Default:search.html.twig', array('categoryInstances' => $categoryInstances));
    }
    
    public function searchContentAction()
    {
        $request = $this->container->get('request_stack')->getCurrentRequest();
        
        $keyWord = $request->query->get('keyWord');
        
        //Get the entity manager
        $em = $this->getDoctrine()->getManager();
        //Get all the CategoryInstance
        $categoryInstances = $em->getRepository('KingBundle:CategoryInstance')->getForSearch($keyWord);
        
        if(!$categoryInstances){
            return new Response('<br> <p class="alert-warning">Sorry no result found for '.$keyWord.'. Notice that your interest owner have to subscribe
                to our service first. Refresh the current page to see the list of all registered interest</p>');
        }
        
        return $this->render('KingBundle:Default:search_content.html.twig', array('categoryInstances' => $categoryInstances));
    }
    
    public function iconAjaxAction()
    {
        //Get the entity manager
        $em = $this->getDoctrine()->getManager();
        $request = $this->container->get('request_stack')->getCurrentRequest();
        $iconId = $request->query->get('keyWord');
        
        if($iconId){
            //Get the Icon from the DB and concatenate it extension to the ID
            $icon = $em->getRepository('KingBundle:Icon')->find($iconId);
        }else{
            return new Response('no icon found');
        }
        
        return $this->render('KingBundle:Default:icon_ajax.html.twig', array('fileName' => $icon->getName()));
        
    }
    
    public function oneResultAction()
    {
        return $this->render('KingBundle:Default:oneResult.html.twig');
    }
    
    public function videoResultAction()
    {
        return $this->render('KingBundle:Default:videoResult.html.twig');
    }
    
    public function resultAction()
    {
        $request = $this->container->get('request_stack')->getCurrentRequest();
        
        //$lat = $request->request->get('lat');
        $lat = $request->query->get('lat');
        $long = $request->query->get('long');
        //Set the current location
        $currentLocation['lat'] = $lat;
        $currentLocation['long'] = $long;
        //Get the service defaultHandler
        $defaultHandler = $this->get('king.default_handler');
        //Get the entity manager
        $em = $this->getDoctrine()->getManager();
        //Get all the interest
        $unsortedInterests = $em->getRepository('KingBundle:Interest')->findAll();
        //Sort all the interests
        $sortedInterests = $defaultHandler->getMostCloser($unsortedInterests, $currentLocation, 'K');
        
        return $this->render('KingBundle:Default:result.html.twig', array('interests' => $sortedInterests));
    }
    
    public function registerInterestAction(Request $request)
    {
        //Get the entity manager
        $em = $this->getDoctrine()->getManager();
        
        $interest = new Interest();
        
        $form = $this->createForm(InterestType::class, $interest);
        
        $form->handleRequest($request);
        
        if($form->isSubmitted() && $form->isValid()){
            //Get all the uploaded file (instance of Symfony\Component\HttpFoundation\File\UploadedFile)
            $staticImage = $interest->getStaticImage();
            $animatedImage = $interest->getAnimatedImage();
            $audio = $interest->getAudio();
            $audioVisual = $interest->getAudioVisual();
            
            //hydrate the object field "extension"
            $interest->setStaticImageExtension($staticImage->guessClientExtension());
            $interest->setAnimatedImageExtension($animatedImage->guessClientExtension());
            $interest->setAudio($audio->guessClientExtension());
            $interest->setAudioVisual($audioVisual->guessClientExtension());
            //Persist in order to be able to get the ID first
            $em->persist($interest);
            $em->flush();
            
            //Get the upload service handler
            $uploadHandler = $this->get('king.upload_handler');
            //Upload all the files in theire repective directories
            $uploadHandler->uploadInterest($staticImage, $animatedImage, $audio, $audioVisual, $interest->getId());
            //$this->get('king.upload_handler')->uploadInterestStaticImage($file, $interest->getId());
            
            $request->getSession()
                    ->getFlashBag()
                    ->add('success', 'The type as been added successfully !');
                    $url = $this->generateUrl('king_register_interest');

            return $this->redirect($url);
        }
        
        return $this->render('KingBundle:Default:register_interest.html.twig',
                             array('form' => $form->createView()));
    }
}
