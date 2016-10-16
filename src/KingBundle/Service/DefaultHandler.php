<?php

/*
 * This file is part of Components of KingLocator project
 * By contributor S@int-Cyr MAPOUKA
 * (c) WONSANO <mapoukacyr@yahoo.fr>
 * For the full copyrght and license information, please view the LICENSE
 * file that was distributed with this source code
 */
namespace KingBundle\Service; 

class DefaultHandler
{
    private $em;
    
    public function __construct($em) 
    {
        $this->em = $em;
    }
    
    /**
     * @return array list of $max sorted Interest that are most closer to $current location
     * @param array $interests
     * @param array $currentLocation eg: array('lat' => 5.5894, 'long' => -0.270);
     * @param K|M $unit Kilometer or Miles
     * @param int $max total number of result
     */
    public function getMostCloser($interests, array $currentLocation, $unit)
    {
        //Set distance for every interest
        foreach ($interests as $int){
            //Get the location of the interst 
            $targetedLocation['lat'] = $int->getLatitude();
            $targetedLocation['long'] = $int->getLongitude();
            $distance = $this->getDistance($currentLocation, $targetedLocation, $unit);
            $int->setDistance($distance);
        }
        //Sorte the list
        $interests = $this->sorteByDistance($interests);
        return $interests;
    }
    
    /**
     * @return array of KingBundle:Interest Sorted list
     * @param array $interests
     */
    public function sorteByDistance(array $objects)
    {
        //Get the total number of the items in the array
        $n = count($objects);
        for($i = 1; $i < $n; $i++){
            for($j = 0; $j < $n - 1; $j++){
                if($objects[$j]->getDistance() > $objects[$j + 1]->getDistance()){
                    $temp = $objects[$j];
                    $objects[$j] = $objects[$j + 1];
                    $objects[$j+1] = $temp;
                }
            }
        }
        
        return $objects;
    }
    
    /**
     * @return float Distance in km or miles based on the third
     * param passed ('K': killometer, 'M': Miles
     * @param array $currentLocation
     * @param array $tagetLocation
     */
    public function getDistance(array $currentLocation, array $targetedLocation, $unit)
    {
        $lat2 = $currentLocation['lat'];
        $long2 = $currentLocation['long'];
        
        $lat1 = $targetedLocation['lat'];
        $long1 = $targetedLocation['long'];
        
        $theta = $long1 - $long2;
        $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
        $dist = acos($dist);
        $dist = rad2deg($dist);
        $miles = $dist * 60 * 1.1515;
        $unit = strtoupper($unit);

        if ($unit == "K") {
          return ($miles * 1.609344);
        } else if ($unit == "N") {
            return ($miles * 0.8684);
          } else {
              return $miles;
            }
    }
    
}