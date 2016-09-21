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
    
    public function uploadInterest($staticImage, $animatedImage, $audio, $audioVisual, $id)
    {
        //Upload the Interest files one after another
        $this->uploadInterestStaticImage($staticImage, $id);
        $this->uploadInterestAnimatedImage($animatedImage, $id);
        $this->uploadInterestAudio($audio, $id);
        $this->uploadInterestAudioVisual($audioVisual, $id);
    }
    
    public function uploadInterestStaticImage(UploadedFile $file = null, $id)
    {
        if(!$file){
            return;
        }
        $fileName = $id.'.'.$file->guessExtension();
        $file->move($this->interestStaticImageDirectory, $fileName);
        return $fileName;
    }
    
    public function uploadInterestAnimatedImage(UploadedFile $file = null, $id)
    {
        if(!$file){
            return;
        }
        $fileName = $id.'.'.$file->guessExtension();
        $file->move($this->interestAnimatedImageDirectory,  $fileName);
        return $fileName;
    }
    
    public function uploadInterestAudio(UploadedFile $file = null, $id)
    {
        if(!$file){
            return;
        }
        $fileName = $id.'.'.$file->guessExtension();
        $file->move($this->interestAudioDirectory, $fileName);
        return $fileName;
    }
    
    public function uploadInterestAudioVisual(UploadedFile $file = null, $id)
    {
        if(!$file){
            return;
        }
        $fileName = $id.'.'.$file->guessExtension();
        $file->move($this->interestAudioVisualDirectory, $fileName);
        return $fileName;
    }
}