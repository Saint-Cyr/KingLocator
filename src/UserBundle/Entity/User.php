<?php

namespace UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\User as BaseUser;

/**
 * User
 *
 * @ORM\Table(name="user")
 * @ORM\Entity(repositoryClass="UserBundle\Repository\UserRepository")
 */
class User extends BaseUser
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    
    private $type;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=true)
     */
    private $name;
    
    /**
     * @ORM\OneToOne(targetEntity="KingBundle\Entity\CategoryInstance", mappedBy="user")
     */
    private $categoryInstance;

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }
    
    public function getType()
    {
        return $this->type;
    }
    
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return User
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
     * @return User
     */
    public function setCategoryInstance(\KingBundle\Entity\CategoryInstance $categoryInstance = null)
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
