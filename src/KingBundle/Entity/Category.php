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
     * @ORM\OneToMany(targetEntity="KingBundle\Entity\SubCategory", mappedBy="category")
     */
    private $subCategories;


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
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->subCategories = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add subCategory
     *
     * @param \KingBundle\Entity\SubCategory $subCategory
     *
     * @return Category
     */
    public function addSubCategory(\KingBundle\Entity\SubCategory $subCategory)
    {
        $this->subCategories[] = $subCategory;

        return $this;
    }

    /**
     * Remove subCategory
     *
     * @param \KingBundle\Entity\SubCategory $subCategory
     */
    public function removeSubCategory(\KingBundle\Entity\SubCategory $subCategory)
    {
        $this->subCategories->removeElement($subCategory);
    }

    /**
     * Get subCategories
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSubCategories()
    {
        return $this->subCategories;
    }
}
