<?php

namespace KingBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * Icon
 *
 * @ORM\Table(name="icon")
 * @ORM\Entity(repositoryClass="KingBundle\Repository\IconRepository")
 *  @ORM\HasLifecycleCallbacks
 */
class Icon
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
     * @ORM\Column(name="name", type="string", length=255, unique=false)
     */
    private $name;
    
    /**
     * @ORM\ManyToOne(targetEntity="KingBundle\Entity\CategoryInstance", inversedBy="icons")
     * @ORM\JoinColumn(nullable=false)
     */
    private $categoryInstance;

    /**
     * @var string
     *
     * @ORM\Column(name="nickName", type="string", length=255, unique=true)
     */
    private $nickName;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="createdAt", type="datetime")
     */
    private $createdAt;
    
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
        if (file_exists(getcwd().'/upload/icon/'.$this->getName())){
            //Remove it
            @unlink(getcwd().'/upload/icon/'.$this->getName());
            
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
        $this->getFile()->move(getcwd().'/upload/icon', $this->getId().'.'.$this->getFile()->guessExtension());
        // clean up the file property as you won't need it anymore
        $this->setFile(null);
    }

    public function __construct() {
        $this->setCreatedAt(new \DateTime("now"));
    }
    
    public function __toString() {
        return $this->nickName;
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
     * Set image
     * @ORM\PrePersist()
     * @ORM\PreUpdate()
     * @param string $image
     *
     */
    public function setName($image)
    {
        if($this->getFile() !== null){
            $this->name = $this->getFile()->guessExtension();
        }
        
        return $this;
    }
    
    /**
     * Get image
     *
     * @return string
     */
    public function getName()
    {
        return $this->getId().'.'.$this->name;
    }

    /**
     * Set nickName
     *
     * @param string $nickName
     *
     * @return Icon
     */
    public function setNickName($nickName)
    {
        $this->nickName = $nickName;

        return $this;
    }

    /**
     * Get nickName
     *
     * @return string
     */
    public function getNickName()
    {
        return $this->nickName;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return Icon
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
     * @return Icon
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
     * Set updated
     *
     * @param \DateTime $updated
     *
     * @return Icon
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
}
