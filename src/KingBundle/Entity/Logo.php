<?php

namespace KingBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Logo
 *
 * @ORM\Table(name="logo")
 * @ORM\Entity(repositoryClass="KingBundle\Repository\LogoRepository")
 */
class Logo
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
     * @ORM\ManyToOne(targetEntity="KingBundle\Entity\CategoryInstance", inversedBy="logos")
     * @ORM\JoinColumn(nullable=false)
     */
    private $categoryInstance;
    
    public function __toString() {
        return $this->name;
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
     * @return Logo
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
     * Set categoryInstance
     *
     * @param \KingBundle\Entity\CategoryInstance $categoryInstance
     *
     * @return Logo
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
}
