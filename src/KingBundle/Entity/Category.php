<?php

namespace KingBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Category
 *
 * @ORM\Table(name="category")
 * @ORM\Entity(repositoryClass="KingBundle\Repository\CategoryRepository")
 */
class Category
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
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="createdAt", type="datetime")
     */
    private $createdAt;
    
    /**
     * @ORM\OneToMany(targetEntity="KingBundle\Entity\CategoryInstance", mappedBy="category")
     */
    private $categoryInstances;


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
     * @return Category
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
     * @return Category
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
    
    public function __toString() {
        return $this->name;
    }
    
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->setCreatedAt(new \DateTime("now"));
        $this->categoryInstances = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add categoryInstance
     *
     * @param \KingBundle\Entity\CategoryInstance $categoryInstance
     *
     * @return Category
     */
    public function addCategoryInstance(\KingBundle\Entity\CategoryInstance $categoryInstance)
    {
        $this->categoryInstances[] = $categoryInstance;

        return $this;
    }

    /**
     * Remove categoryInstance
     *
     * @param \KingBundle\Entity\CategoryInstance $categoryInstance
     */
    public function removeCategoryInstance(\KingBundle\Entity\CategoryInstance $categoryInstance)
    {
        $this->categoryInstances->removeElement($categoryInstance);
    }

    /**
     * Get categoryInstances
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCategoryInstances()
    {
        return $this->categoryInstances;
    }
}
