<?php

/*
 * This file is part of Components of KingLocator project
 * By contributor S@int-Cyr MAPOUKA
 * (c) WONSANO <mapoukacyr@yahoo.fr>
 * For the full copyrght and license information, please view the LICENSE
 * file that was distributed with this source code
 */

namespace Tests\KingBundle\Service;

use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;


class StatisticHandlerTest extends WebTestCase
{
    private $em;
    private $application;
    private $defaultHandler;
    
    public function setUp()
    {
        static::$kernel = static::createKernel();
        static::$kernel->boot();
        
        $this->application = new Application(static::$kernel);
        $this->em = $this->application->getKernel()->getContainer()->get('doctrine.orm.entity_manager');
        $this->defaultHandler = $this->application->getKernel()->getContainer()->get('king.default_handler');
    }
    
    public function testGetDistance()
    {
        //Case where the target location is distanted to 2.1469193302976 km (from the office to 18 junction)
        //Prapare the fake input based on the fixtures documentation
        $currentLocation = array('lat' => 5.645, 'long' => -0.0698);
        $_18Junction = array('lat' => 5.628, 'long' => -0.079);
        //lanch the test
        $outPut = $this->defaultHandler->getDistance($currentLocation, $_18Junction, 'K');
        $this->assertEquals($outPut, 2.1469193302976);
        
        //Case where the target location is distanted to 2.1469193302976 km (from the office to Kwashima)
        //Prapare the fake input based on the fixtures documentation
        $currentLocation = array('lat' => 5.645, 'long' => -0.0698);
        $kwashima = array('lat' => 5.5894, 'long' => -0.270);
        //lanch the test
        $outPut = $this->defaultHandler->getDistance($currentLocation, $kwashima, 'K');
        $this->assertEquals($outPut, 22.99969146818);
    }
    
    public function testSorteByDistance()
    {
        /**
         * We consider the test scenario where the current location at the head office of YAME Group Ghana Ltd.
         * and:
         *  1rst : Ecobank Branch of 18 junction (B)
         *  2nd:  Ecobank ATM at Teshie Rd, Accra, Ghana
         *  3rd: Ecobank Branch & ATM East Airport
         * More information can be found in the fixtures file
         */
        //Get the fake list of interest from the fixtures
        $interests = $this->em->getRepository('KingBundle:Interest')->findAll();
        
        //Set the distances (It have to be updated to much fixtures...in next version)
        $this->assertEquals($interests[1]->getName(), 'Branch of 18 Junction');
        $this->assertEquals($interests[0]->getName(), 'Ecobank ATM Teshie Rd. Accra, Ghana');
        $this->assertEquals($interests[2]->getName(), 'Ecobank Branch & ATM East Airport');
        
        //Make sure the order of fixtures doc is right
        foreach ($interests as $key => $int){
            if($key == 0){
                //2nd
                $this->assertEquals('Ecobank ATM Teshie Rd. Accra, Ghana', $int->getName());
                //Set the fake distance here
                $int->setDistance(2.2);
                
            }
            
            if($key == 1){
                //1st
                $this->assertEquals('Branch of 18 Junction', $int->getName());
                //Set the fake distance here
                $int->setDistance(2.1);
            }
            
            if($key == 2){
                //3rd
                $this->assertEquals('Ecobank Branch & ATM East Airport', $int->getName());
                //Set the fake distance here
                $int->setDistance(2.3);
            }
        }
        
        
        $outPut = $this->defaultHandler->sorteByDistance($interests);
        //Prepare the expected result. The criteria to check the classification is name
        $sorted = array('Branch of 18 Junction', 'Ecobank ATM Teshie Rd. Accra, Ghana', 'Ecobank Branch & ATM East Airport');
        
        $this->assertEquals($outPut[0]->getName(), 'Branch of 18 Junction');
        $this->assertEquals($outPut[1]->getName(), 'Ecobank ATM Teshie Rd. Accra, Ghana');
        $this->assertEquals($outPut[2]->getName(), 'Ecobank Branch & ATM East Airport');
        
        //$this->assertEquals($sorted, array($outPut[0]->getName(), $outPut[1]->getName(), $outPut[2]->getName()));
    }
    
    public function testGetMostCloser()
    {
        //Get the list of all the interests
        $interests = $this->em->getRepository('KingBundle:Interest')->findAll();
        //Prapare the fake input based on the fixtures documentation
        $currentLocation = array('lat' => 5.645, 'long' => -0.0698);
        $outPut = $this->defaultHandler->getMostCloser($interests, $currentLocation, 'K');
        
        $this->assertEquals($outPut[0]->getName(), 'Branch of 18 Junction');
        $this->assertEquals($outPut[1]->getName(), 'Ecobank ATM Teshie Rd. Accra, Ghana');
        $this->assertEquals($outPut[2]->getName(), 'Ecobank Branch & ATM East Airport');
    }
    
    
}
