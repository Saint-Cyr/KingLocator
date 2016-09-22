<?php

namespace KingBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * CategoryInstance
 *
 * @ORM\Table(name="category_instance")
 * @ORM\Entity(repositoryClass="KingBundle\Repository\CategoryInstanceRepository")
 * @ORM\HasLifecycleCallbacks
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
    
    private $file;
    
    /**
     * @var string
     *
     * @ORM\Column(name="updated", type="datetime", nullable=true)
     */
    private $updated;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, unique=true)
     */
    private $name;
    
    /**
     * @ORM\OneToMany(targetEntity="KingBundle\Entity\Interest", mappedBy="categoryInstance")
     */
    private $interests;

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
     * @ORM\Column(name="logo", type="string", length=255, nullable=true, unique=false)
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
    * Sets file.
    *
    * @param UploadedFile $file
    */
    public function setFile(UploadedFile $file = null)
    {
        $this->file = $file;
    }
    /**
    * Get file.
    *
    * @return UploadedFile
    */
    public function getFile()
    {
        return $this->file;
    }
    
    /**
    * @ORM\PostPersist()
    * @ORM\PostUpdate()
    */
    public function lifecycleFileUpload()
    {
        $this->upload();
    }
    
    /**
     * @ORM\PreUpdate()
     */
    public function refreshUpdated()
    {
        $this->setUpdated(new \DateTime());
    }
    
    /**
     * @ORM\PreRemove()
     */
    public function removeUPdate()
    {
        //Check whether the file exists first
        if (file_exists(getcwd().'/upload/categoryInstance/'.$this->getName())){
            //Remove it
            @unlink(getcwd().'/upload/categoryInstance/'.$this->getName());
            
        }
        
        return;
    }
    
    public function upload()
    {
        // the file property can be empty if the field is not required
        if (null === $this->getFile()) {
            return;
        }
        // move takes the target directory and target filename as params
        $this->getFile()->move(getcwd().'/upload/categoryInstance', $this->getId().'.'.$this->getFile()->guessExtension());
        // clean up the file property as you won't need it anymore
        $this->setFile(null);
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
     * Set image
     * @ORM\PrePersist()
     * @ORM\PreUpdate()
     * @param string $image
     *
     */
    public function setLogo($image)
    {
        if($this->getFile() !== null){
            $this->logo = $this->getFile()->guessExtension();
        }
        
        return $this;
    }
    
    /**
     * Get image
     *
     * @return string
     */
    public function getLogo()
    {
        return $this->getId().'.'.$this->logo;
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

    /**
     * Set updated
     *
     * @param \DateTime $updated
     *
     * @return CategoryInstance
     */
    public function setUpdated($updated)
    {
        $this->updated = $updated;

        return $this;
    }

    /**
     * Get updated
     *
     * @return \DateTime
     */
    public function getUpdated()
    {
        return $this->updated;
    }

    /**
     * Add interest
     *
     * @param \KingBundle\Entity\Interest $interest
     *
     * @return CategoryInstance
     */
    public function addInterest(\KingBundle\Entity\Interest $interest)
    {
        $this->interests[] = $interest;

        return $this;
    }

    /**
     * Remove interest
     *
     * @param \KingBundle\Entity\Interest $interest
     */
    public function removeInterest(\KingBundle\Entity\Interest $interest)
    {
        $this->interests->removeElement($interest);
    }

    /**
     * Get interests
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getInterests()
    {
        return $this->interests;
    }
}
