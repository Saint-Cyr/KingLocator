<?php

namespace KingBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

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
     * @ORM\Column(name="latitude", type="float", length=255, unique=true)
     */
    private $latitude;
    
    /**
     * @var string
     *
     * @ORM\Column(name="longitude", type="float", length=255, unique=true)
     */
    private $longitude;
    
    /**
     * @var string
     *
     * @ORM\Column(name="officialAddress", type="string", length=255, unique=true)
     */
    private $officialAddress;
    
    /**
     * @var string
     *
     * @ORM\Column(name="localAddress", type="string", length=255, unique=true)
     */
    private $localAddress;
    
    /**
     * @ORM\ManyToOne(targetEntity="KingBundle\Entity\CategoryInstance")
     * @ORM\JoinColumn(nullable=false)
     */
    private $categoryInstance;
    
    /**
     * @ORM\ManyToOne(targetEntity="KingBundle\Entity\Logo")
     * @ORM\JoinColumn(nullable=false)
     */
    private $logo;

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
     * Set logo
     *
     * @param \KingBundle\Entity\Logo $logo
     *
     * @return Interest
     */
    public function setLogo(\KingBundle\Entity\Logo $logo)
    {
        $this->logo = $logo;

        return $this;
    }

    /**
     * Get logo
     *
     * @return \KingBundle\Entity\Logo
     */
    public function getLogo()
    {
        return $this->logo;
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
}
