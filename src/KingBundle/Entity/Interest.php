<?php

namespace KingBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\File;

/**
 * Interest
 *
 * @ORM\Table(name="interest")
 * @ORM\Entity(repositoryClass="KingBundle\Repository\InterestRepository")
 */
class Interest
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, unique=true)
     */
    private $name;
    
    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255, unique=true, nullable=true)
     */
    private $email;
    
    /**
     * @var string
     *
     * @ORM\Column(name="officePhone", type="string", length=255, unique=true, nullable=true)
     */
    private $officePhone;
    
    /**
     * @var string
     *
     * @ORM\Column(name="whatsApp", type="string", length=255, unique=true, nullable=true)
     */
    private $whatsApp;
    
    /**
     * @var string
     *
     * @ORM\Column(name="staticImageExtension", type="string", length=255, unique=true, nullable=true)
     */
    private $staticImageExtension;
    
    /**
     * @var string
     *
     * @ORM\Column(name="animatedImageExtension", type="string", length=255, unique=false, nullable=true)
     */
    private $animatedImageExtension;
    
    /**
     * @var string
     *
     * @ORM\Column(name="audioExtension", type="string", length=255, unique=false, nullable=true)
     */
    private $audioExtension;
    
    /**
     * @var string
     *
     * @ORM\Column(name="audioVisualExtension", type="string", length=255, unique=false, nullable=true)
     */
    private $audioVisualExtension;
    
    /**
     * @var string
     *
     * Unmapped property
     */
    private $staticImage;
    
    /**
     * @var string
     *
     */
    private $animatedImage;
    
    /**
     * @var string
     *
     */
    private $audio;
    
    /**
     * @var string
     *
     */
    private $audioVisual;
    
    /**
     * @var string
     *
     * @ORM\Column(name="latitude", type="float", length=255, unique=true)
     */
    private $latitude;
    
    /**
     * @var string
     *
     * @ORM\Column(name="longitude", type="float", length=255, unique=true)
     */
    private $longitude;
    
    private $distance;
    
    /**
     * @var string
     *
     * @ORM\Column(name="officialAddress", type="string", length=255, unique=false)
     */
    private $officialAddress;
    
    /**
     * @var string
     *
     * @ORM\Column(name="localAddress", type="string", length=255, unique=true, nullable=true)
     */
    private $localAddress;
    
    /**
     * @ORM\ManyToOne(targetEntity="KingBundle\Entity\CategoryInstance")
     * @ORM\JoinColumn(nullable=false)
     */
    private $categoryInstance;
    
    /**
     * @ORM\ManyToOne(targetEntity="KingBundle\Entity\Icon")
     * @ORM\JoinColumn(nullable=false)
     */
    private $icon;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="createdAt", type="datetime")
     */
    private $createdAt;

    public function __construct() {
        $this->setCreatedAt(new \DateTime("now"));
    }
    
    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Interest
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return Interest
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set categoryInstance
     *
     * @param \KingBundle\Entity\CategoryInstance $categoryInstance
     *
     * @return Interest
     */
    public function setCategoryInstance(\KingBundle\Entity\CategoryInstance $categoryInstance)
    {
        $this->categoryInstance = $categoryInstance;

        return $this;
    }

    /**
     * Get categoryInstance
     *
     * @return \KingBundle\Entity\CategoryInstance
     */
    public function getCategoryInstance()
    {
        return $this->categoryInstance;
    }

    /**
     * Set latitude
     *
     * @param float $latitude
     *
     * @return Interest
     */
    public function setLatitude($latitude)
    {
        $this->latitude = $latitude;

        return $this;
    }

    /**
     * Get latitude
     *
     * @return float
     */
    public function getLatitude()
    {
        return $this->latitude;
    }

    /**
     * Set longitude
     *
     * @param float $longitude
     *
     * @return Interest
     */
    public function setLongitude($longitude)
    {
        $this->longitude = $longitude;

        return $this;
    }

    /**
     * Get longitude
     *
     * @return float
     */
    public function getLongitude()
    {
        return $this->longitude;
    }

    /**
     * Set officialAddress
     *
     * @param string $officialAddress
     *
     * @return Interest
     */
    public function setOfficialAddress($officialAddress)
    {
        $this->officialAddress = $officialAddress;

        return $this;
    }

    /**
     * Get officialAddress
     *
     * @return string
     */
    public function getOfficialAddress()
    {
        return $this->officialAddress;
    }

    /**
     * Set localAddress
     *
     * @param string $localAddress
     *
     * @return Interest
     */
    public function setLocalAddress($localAddress)
    {
        $this->localAddress = $localAddress;

        return $this;
    }

    /**
     * Get localAddress
     *
     * @return string
     */
    public function getLocalAddress()
    {
        return $this->localAddress;
    }

    /**
     * Set distance
     *
     * @param float $distance
     *
     * @return Interest
     */
    public function setDistance($distance)
    {
        $this->distance = $distance;

        return $this;
    }

    /**
     * Get distance
     *
     * @return float
     */
    public function getDistance()
    {
        return $this->distance;
    }

    /**
     * Set icon
     *
     * @param \KingBundle\Entity\Icon $icon
     *
     * @return Interest
     */
    public function setIcon(\KingBundle\Entity\Icon $icon)
    {
        $this->icon = $icon;

        return $this;
    }

    /**
     * Get icon
     *
     * @return \KingBundle\Entity\Icon
     */
    public function getIcon()
    {
        return $this->icon;
    }

    /**
     * Set staticImage
     *
     * @param string $staticImage
     *
     * @return Interest
     */
    public function setStaticImage($staticImage)
    {
        $this->staticImage = $staticImage;

        return $this;
    }

    /**
     * Get staticImage
     *
     * @return string
     */
    public function getStaticImage()
    {
        return $this->staticImage;
    }

    /**
     * Set animatedImage
     *
     * @param string $animatedImage
     *
     * @return Interest
     */
    public function setAnimatedImage($animatedImage)
    {
        $this->animatedImage = $animatedImage;

        return $this;
    }

    /**
     * Get animatedImage
     *
     * @return string
     */
    public function getAnimatedImage()
    {
        return $this->animatedImage;
    }

    /**
     * Set audio
     *
     * @param string $audio
     *
     * @return Interest
     */
    public function setAudio($audio)
    {
        $this->audio = $audio;

        return $this;
    }

    /**
     * Get audio
     *
     * @return string
     */
    public function getAudio()
    {
        return $this->audio;
    }

    /**
     * Set audioVisual
     *
     * @param string $audioVisual
     *
     * @return Interest
     */
    public function setAudioVisual($audioVisual)
    {
        $this->audioVisual = $audioVisual;

        return $this;
    }

    /**
     * Get audioVisual
     *
     * @return string
     */
    public function getAudioVisual()
    {
        return $this->audioVisual;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return Interest
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set officePhone
     *
     * @param string $officePhone
     *
     * @return Interest
     */
    public function setOfficePhone($officePhone)
    {
        $this->officePhone = $officePhone;

        return $this;
    }

    /**
     * Get officePhone
     *
     * @return string
     */
    public function getOfficePhone()
    {
        return $this->officePhone;
    }

    /**
     * Set whatsApp
     *
     * @param string $whatsApp
     *
     * @return Interest
     */
    public function setWhatsApp($whatsApp)
    {
        $this->whatsApp = $whatsApp;

        return $this;
    }

    /**
     * Get whatsApp
     *
     * @return string
     */
    public function getWhatsApp()
    {
        return $this->whatsApp;
    }

    /**
     * Set staticImageExtension
     *
     * @param string $staticImageExtension
     *
     * @return Interest
     */
    public function setStaticImageExtension($staticImageExtension)
    {
        $this->staticImageExtension = $staticImageExtension;

        return $this;
    }

    /**
     * Get staticImageExtension
     *
     * @return string
     */
    public function getStaticImageExtension()
    {
        return $this->staticImageExtension;
    }

    /**
     * Set animatedImageExtension
     *
     * @param string $animatedImageExtension
     *
     * @return Interest
     */
    public function setAnimatedImageExtension($animatedImageExtension)
    {
        $this->animatedImageExtension = $animatedImageExtension;

        return $this;
    }

    /**
     * Get animatedImageExtension
     *
     * @return string
     */
    public function getAnimatedImageExtension()
    {
        return $this->animatedImageExtension;
    }

    /**
     * Set audioExtension
     *
     * @param string $audioExtension
     *
     * @return Interest
     */
    public function setAudioExtension($audioExtension)
    {
        $this->audioExtension = $audioExtension;

        return $this;
    }

    /**
     * Get audioExtension
     *
     * @return string
     */
    public function getAudioExtension()
    {
        return $this->audioExtension;
    }

    /**
     * Set audioVisualExtension
     *
     * @param string $audioVisualExtension
     *
     * @return Interest
     */
    public function setAudioVisualExtension($audioVisualExtension)
    {
        $this->audioVisualExtension = $audioVisualExtension;

        return $this;
    }

    /**
     * Get audioVisualExtension
     *
     * @return string
     */
    public function getAudioVisualExtension()
    {
        return $this->audioVisualExtension;
    }
}
