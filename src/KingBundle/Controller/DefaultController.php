<?php

namespace KingBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\HttpFoundation\Request;
use KingBundle\Form\TypeType;
use KingBundle\Form\InterestType;
use KingBundle\Entity\Interest;

class DefaultController extends Controller
{
    public function interestDetailAction($interestId)
    {
        //Get the entity manager
        $em = $this->getDoctrine()->getManager();
        //Get all the interest
        $interest = $em->getRepository('KingBundle:Interest')->find($interestId);
        
        return $this->render('KingBundle:Default:interest_detail.html.twig', array('interest' => $interest));
    }
    
    public function indexAction(Request $request)
    {
        //Get the entity manager
        $em = $this->getDoctrine()->getManager();
        //Get all the interests
        $interests = $em->getRepository('KingBundle:Interest')->findAll();
        
        return $this->render('KingBundle:Default:index.html.twig', array('interests' => $interests));
    }
    
    public function allResultAction($categoryInstanceId)
    {
        //Get the entity manager
        $em = $this->getDoctrine()->getManager();
        //Get the categoryInstance from the DB
        $categoryInstance = $em->getRepository('KingBundle:CategoryInstance')->find($categoryInstanceId);
        //Make sure $category exists in DB
        if(!$categoryInstance){
            throw $this->createNotFoundException('Category Instance of ID "'.$categoryInstanceId.'" not found in the DB');
        }
        //Get all the interest related to the categoryInstance
        $interests = $categoryInstance->getInterests();
        //$interests = $em->getRepository('KingBundle:Interest')->findAll();
        return $this->render('KingBundle:Default:result.html.twig', array('interests' => $interests, 'categoryInstanceId' => $categoryInstanceId));
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
            
            $response = new Response('<br> <p class="alert-warning">Sorry no result found for '.$keyWord.'. Notice that your interest owner have to subscribe
                to our service first. Refresh the current page to see the list of all registered interest</p>');
            
            $response->headers->set('Access-Control-Allow-Origin', 'http://localhost');
            
            return $response;
        }
        
        $response = new Response($this->renderView('KingBundle:Default:search_content.html.twig', array('categoryInstances' => $categoryInstances)), 200);
                            
        $response->headers->set('Access-Control-Allow-Origin', 'http://localhost');
        return $response;
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
        
        $response = new Response($this->renderView('KingBundle:Default:icon_ajax.html.twig', array('fileName' => $icon->getName())), 200);
                            
        $response->headers->set('Access-Control-Allow-Origin', 'http://localhost');
        return $response;
        
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
        $categoryInstanceId = $request->query->get('ID');
        
        //Set the current location
        $currentLocation['lat'] = $lat;
        $currentLocation['long'] = $long;
        //Get the service defaultHandler
        $defaultHandler = $this->get('king.default_handler');
        //Get the entity manager
        $em = $this->getDoctrine()->getManager();
        //Get the categoryInstance from the which the visitor wants to get the interests
        $categoryInstance = $em->getRepository('KingBundle:CategoryInstance')->find($categoryInstanceId);
        //Get all the interest
        
        $unsortedInterests = $categoryInstance->getInterests();
        //Put the items within a simple array for the service handler to undertand it easely
        foreach ($unsortedInterests as $item){
            $_unsortedInterests[] = $item;
        }
        
        //Sort all the interests
        $sortedInterests = $defaultHandler->getMostCloser($_unsortedInterests, $currentLocation, 'K');
        
        $response = new Response($this->renderView('KingBundle:Default:result_content.html.twig', array('interests' => $sortedInterests)), 200);
                            
        $response->headers->set('Access-Control-Allow-Origin', 'http://localhost');
        return $response;
        
       // return $this->render('KingBundle:Default:result_content.html.twig', array('interests' => $sortedInterests));
    }
    
    public function registerInterestAction(Request $request)
    {
        //Get the entity manager
        $em = $this->getDoctrine()->getManager();
        
        $interest = new Interest();
        //Get the current user
        $user = $this->getUser();
        
        $form = $this->createForm(InterestType::class, $interest, array('user' => $user));
        
        $categoryInstance = $user->getCategoryInstance();
        //Make sure the current user is linked to a categoryInstance
        if(!$categoryInstance){
            throw new AccessDeniedException();
        }
        
        $form->handleRequest($request);
        
        $interest->setCategoryInstance($categoryInstance);
        
        if($form->isSubmitted() && $form->isValid()){
            //Get all the uploaded file (instance of Symfony\Component\HttpFoundation\File\UploadedFile)
            $staticImage = $interest->getStaticImage();
            $animatedImage = $interest->getAnimatedImage();
            $audio = $interest->getAudio();
            $audioVisual = $interest->getAudioVisual();
            //array of names to passe to the service in ordert for it to name the files when moving them to theire location
            $fileNames = array();
            
            
                //hydrate the object with the filename
                $fileName = md5(uniqid()).'.'.$staticImage->guessExtension();
                $fileNames['staticImage'] = $fileName;
                $interest->setStaticImageName($fileName);
                
            
                
                $fileName = md5(uniqid()).'.'.$animatedImage->guessExtension();
                $fileNames['animatedImage'] = $fileName;
                $interest->setAnimatedImageName($fileName);
                
            
                $fileName = md5(uniqid()).'.'.$audioVisual->guessExtension();
                $fileNames['audioVisual'] = $fileName;
                $interest->setAudioVisualName($fileName);
                
           
                $fileName = md5(uniqid()).'.mp3';
                $fileNames['audio'] = $fileName;
                $interest->setAudioName($fileName);
            
           
            //Get the upload service handler
            $uploadHandler = $this->get('king.upload_handler');
            //Upload all the files in theire repective directories
            $uploadHandler->uploadInterest($staticImage, $animatedImage, $audio, $audioVisual, $fileNames);
            
            //Persist in order to be able to get the ID first
            $em->persist($interest);
            $em->flush();
            
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
