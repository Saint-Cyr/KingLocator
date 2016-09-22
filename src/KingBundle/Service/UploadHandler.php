<?php

/*
 * This file is part of Components of KingLocator project
 * By contributor S@int-Cyr MAPOUKA
 * (c) WONSANO <mapoukacyr@yahoo.fr>
 * For the full copyrght and license information, please view the LICENSE
 * file that was distributed with this source code
 */
namespace KingBundle\Service; 
use Symfony\Component\HttpFoundation\File\UploadedFile;

class UploadHandler
{
    private $interestStaticImageDirectory;
    private $interestAnimatedImageDirectory;
    private $interestAudioDirectory;
    private $interestAudioVisualDirectory;
    private $categoryInstanceDirectory;
    private $categoryDirectory;
    private $iconDirectory;


    public function __construct($interestStaticImage, $interestAnimatedImage, $interestAudio, $interestAudioVisual, $categoryInstanceImage, $categoryImage, $iconImage) 
    {
        $this->interestStaticImageDirectory = $interestStaticImage;
        $this->interestAnimatedImageDirectory = $interestAnimatedImage;
        $this->interestAudioDirectory = $interestAudio;
        $this->interestAudioVisualDirectory = $interestAudioVisual;
        $this->categoryInstanceDirectory = $categoryInstanceImage;
        $this->categoryDirectory = $categoryImage;
        $this->iconDirectory = $iconImage;
    }
    
    public function uploadInterest($staticImage, $animatedImage, $audio, $audioVisual, $fileNames)
    {
        //Upload the Interest files one after another
        $this->uploadInterestStaticImage($staticImage, $fileNames['staticImage']);
        $this->uploadInterestAnimatedImage($animatedImage, $fileNames['animatedImage']);
        $this->uploadInterestAudio($audio, $fileNames['audio']);
        $this->uploadInterestAudioVisual($audioVisual, $fileNames['audioVisual']);
    }
    
    public function uploadInterestStaticImage(UploadedFile $file = null, $fileName)
    {
        if(!$file){
            return;
        }
        
        $file->move($this->interestStaticImageDirectory, $fileName);
        return $fileName;
    }
    
    public function uploadInterestAnimatedImage(UploadedFile $file = null, $fileName)
    {
        if(!$file){
            return;
        }
        
        $file->move($this->interestAnimatedImageDirectory, $fileName);
        return $fileName;
    }
    
    public function uploadInterestAudio(UploadedFile $file = null, $fileName)
    {
        if(!$file){
            return;
        }
        
        $file->move($this->interestAudioDirectory, $fileName);
        return $fileName;
    }
    
    public function uploadInterestAudioVisual(UploadedFile $file = null, $fileName)
    {
        if(!$file){
            return;
        }
        
        $file->move($this->interestAudioVisualDirectory, $fileName);
        return $fileName;
    }
}