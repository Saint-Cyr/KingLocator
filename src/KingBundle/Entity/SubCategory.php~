<?php

namespace KingBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * SubCategory
 *
 * @ORM\Table(name="sub_category")
 * @ORM\Entity(repositoryClass="KingBundle\Repository\SubCategoryRepository")
 */
class SubCategory
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
     * @ORM\ManyToOne(targetEntity="KingBundle\Entity\Category", inversedBy="subCategories")
     * @ORM\JoinColumn(nullable=true)
     */
    private $category;
    
    /**
     * @ORM\OneToMany(targetEntity="KingBundle\Entity\Type", mappedBy="subCategory")
     */
    private $types;


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
     * @return SubCategory
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
     * @return SubCategory
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
        $this->types = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set category
     *
     * @param \KingBundle\Entity\Category $category
     *
     * @return SubCategory
     */
    public function setCategory(\KingBundle\Entity\Category $category = null)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return \KingBundle\Entity\Category
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Add type
     *
     * @param \KingBundle\Entity\Type $type
     *
     * @return SubCategory
     */
    public function addType(\KingBundle\Entity\Type $type)
    {
        $this->types[] = $type;

        return $this;
    }

    /**
     * Remove type
     *
     * @param \KingBundle\Entity\Type $type
     */
    public function removeType(\KingBundle\Entity\Type $type)
    {
        $this->types->removeElement($type);
    }

    /**
     * Get types
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTypes()
    {
        return $this->types;
    }
}
