<?php

namespace KingBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CategoryInstance
 *
 * @ORM\Table(name="category_instance")
 * @ORM\Entity(repositoryClass="KingBundle\Repository\CategoryInstanceRepository")
 */
class CategoryInstance
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
     * @var \DateTime
     *
     * @ORM\Column(name="createdAt", type="datetime")
     */
    private $createdAt;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="logo", type="string", length=255, nullable=true, unique=true)
     */
    private $logo;

    /**
     * @var string
     *
     * @ORM\Column(name="headOfficeAdress", type="string", length=255, nullable=true, unique=true)
     */
    private $headOfficeAdress;

    /**
     * @var string
     *
     * @ORM\Column(name="headOfficePhone", type="string", length=255, nullable=true, unique=true)
     */
    private $headOfficePhone;

    /**
     * @ORM\ManyToOne(targetEntity="KingBundle\Entity\Category", inversedBy="categoryInstances")
     */
    private $category;
    
    /**
     * @ORM\OneToMany(targetEntity="KingBundle\Entity\Icon", mappedBy="categoryInstance")
     */
    private $icons;
    
    
    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }
    
    public function __toString() {
        return $this->name;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return CategoryInstance
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
     * @return CategoryInstance
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
     * Set description
     *
     * @param string $description
     *
     * @return CategoryInstance
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set headOfficeAdress
     *
     * @param string $headOfficeAdress
     *
     * @return CategoryInstance
     */
    public function setHeadOfficeAdress($headOfficeAdress)
    {
        $this->headOfficeAdress = $headOfficeAdress;

        return $this;
    }

    /**
     * Get headOfficeAdress
     *
     * @return string
     */
    public function getHeadOfficeAdress()
    {
        return $this->headOfficeAdress;
    }

    /**
     * Set headOfficePhone
     *
     * @param string $headOfficePhone
     *
     * @return CategoryInstance
     */
    public function setHeadOfficePhone($headOfficePhone)
    {
        $this->headOfficePhone = $headOfficePhone;

        return $this;
    }

    /**
     * Get headOfficePhone
     *
     * @return string
     */
    public function getHeadOfficePhone()
    {
        return $this->headOfficePhone;
    }
    
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->setCreatedAt(new \DateTime("now"));
    }

    /**
     * Set category
     *
     * @param \KingBundle\Entity\Category $category
     *
     * @return CategoryInstance
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
     * Set logo
     *
     * @param string $logo
     *
     * @return CategoryInstance
     */
    public function setLogo($logo)
    {
        $this->logo = $logo;

        return $this;
    }

    /**
     * Get logo
     *
     * @return string
     */
    public function getLogo()
    {
        return $this->logo;
    }

    /**
     * Add icon
     *
     * @param \KingBundle\Entity\Icon $icon
     *
     * @return CategoryInstance
     */
    public function addIcon(\KingBundle\Entity\Icon $icon)
    {
        $this->icons[] = $icon;

        return $this;
    }

    /**
     * Remove icon
     *
     * @param \KingBundle\Entity\Icon $icon
     */
    public function removeIcon(\KingBundle\Entity\Icon $icon)
    {
        $this->icons->removeElement($icon);
    }

    /**
     * Get icons
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getIcons()
    {
        return $this->icons;
    }
}
