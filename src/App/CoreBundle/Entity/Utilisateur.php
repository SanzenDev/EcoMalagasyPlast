<?php

namespace App\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\CoreBundle\Utils\Util;
use FOS\UserBundle\Model\User as BaseUser;
use App\CoreBundle\Events;


/**
 * Utilisateur
 */
class Utilisateur extends BaseUser
{
    /**
     * @var integer
     */
    protected $id;

    /**
     * @var string
     */
    private $token;

    /**
     * @var string
     */
    private $lastName;

    /**
     * @var boolean
     */
    private $checked;

    /**
     * @var boolean
     */
    private $active;

    /**
     * @var string
     */
    private $ip;

    /**
     * @var \DateTime
     */
    private $lastLogout;

    /**
     * @var string
     */
    private $slug;

    /**
     * @var \DateTime
     */
    private $createdAt;

    /**
     * @var \DateTime
     */
    private $updatedAt;

    /**
     * @var \App\CoreBundle\Entity\UtilisateurImage
     */
    private $userImage;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $pages;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $newss;

    /**
     * @var \App\CoreBundle\Entity\Partenaire
     */
    private $partenaire;

    /**
     * @var \App\CoreBundle\Entity\Client
     */
    private $client;


    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct();
        $this->pages = new \Doctrine\Common\Collections\ArrayCollection();
        $this->newss = new \Doctrine\Common\Collections\ArrayCollection();
        $this->checked = 0;
        $this->active = 1;
    }
    public function getEnabled()
    {
        return $this->enabled;
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set token
     *
     * @param string $token
     *
     * @return Utilisateur
     */
    public function setToken($token)
    {
        $this->token = $token;

        return $this;
    }

    /**
     * Get token
     *
     * @return string
     */
    public function getToken()
    {
        return $this->token;
    }

    /**
     * Set lastName
     *
     * @param string $lastName
     *
     * @return Utilisateur
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * Get lastName
     *
     * @return string
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * Set checked
     *
     * @param boolean $checked
     *
     * @return Utilisateur
     */
    public function setChecked($checked)
    {
        $this->checked = $checked;

        return $this;
    }

    /**
     * Get checked
     *
     * @return boolean
     */
    public function getChecked()
    {
        return $this->checked;
    }

    /**
     * Set active
     *
     * @param boolean $active
     *
     * @return Utilisateur
     */
    public function setActive($active)
    {
        $this->active = $active;

        return $this;
    }

    /**
     * Get active
     *
     * @return boolean
     */
    public function getActive()
    {
        return $this->active;
    }

    /**
     * Set ip
     *
     * @param string $ip
     *
     * @return Utilisateur
     */
    public function setIp($ip)
    {
        $this->ip = $ip;

        return $this;
    }

    /**
     * Get ip
     *
     * @return string
     */
    public function getIp()
    {
        return $this->ip;
    }

    /**
     * Set lastLogout
     *
     * @param \DateTime $lastLogout
     *
     * @return Utilisateur
     */
    public function setLastLogout($lastLogout)
    {
        $this->lastLogout = $lastLogout;

        return $this;
    }

    /**
     * Get lastLogout
     *
     * @return \DateTime
     */
    public function getLastLogout()
    {
        return $this->lastLogout;
    }

    /**
     * Set slug
     *
     * @param string $slug
     *
     * @return Utilisateur
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get slug
     *
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return Utilisateur
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
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     *
     * @return Utilisateur
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * Set userImage
     *
     * @param \App\CoreBundle\Entity\UtilisateurImage $userImage
     *
     * @return Utilisateur
     */
    public function setUserImage(\App\CoreBundle\Entity\UtilisateurImage $userImage = null)
    {
        $this->userImage = $userImage;

        return $this;
    }

    /**
     * Get userImage
     *
     * @return \App\CoreBundle\Entity\UtilisateurImage
     */
    public function getUserImage()
    {
        return $this->userImage;
    }

    /**
     * Add page
     *
     * @param \App\CoreBundle\Entity\Page $page
     *
     * @return Utilisateur
     */
    public function addPage(\App\CoreBundle\Entity\Page $page)
    {
        $this->pages[] = $page;

        return $this;
    }

    /**
     * Remove page
     *
     * @param \App\CoreBundle\Entity\Page $page
     */
    public function removePage(\App\CoreBundle\Entity\Page $page)
    {
        $this->pages->removeElement($page);
    }

    /**
     * Get pages
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPages()
    {
        return $this->pages;
    }

    /**
     * Add newss
     *
     * @param \App\CoreBundle\Entity\News $newss
     *
     * @return Utilisateur
     */
    public function addNewss(\App\CoreBundle\Entity\News $newss)
    {
        $this->newss[] = $newss;

        return $this;
    }

    /**
     * Remove newss
     *
     * @param \App\CoreBundle\Entity\News $newss
     */
    public function removeNewss(\App\CoreBundle\Entity\News $newss)
    {
        $this->newss->removeElement($newss);
    }

    /**
     * Get newss
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getNewss()
    {
        return $this->newss;
    }

    /**
     * Set client
     *
     * @param \App\CoreBundle\Entity\Client $client
     *
     * @return Utilisateur
     */
    public function setClient(\App\CoreBundle\Entity\Client $client = null)
    {
        $this->client = $client;

        return $this;
    }

    /**
     * Get client
     *
     * @return \App\CoreBundle\Entity\Client
     */
    public function getClient()
    {
        return $this->client;
    }


    /**
     * Set partenaire
     *
     * @param \App\CoreBundle\Entity\Partenaire $partenaire
     *
     * @return Utilisateur
     */
    public function setPartenaire(\App\CoreBundle\Entity\Partenaire $partenaire = null)
    {
        $this->partenaire = $partenaire;

        return $this;
    }

    /**
     * Get partenaire
     *
     * @return \App\CoreBundle\Entity\Partenaire
     */
    public function getPartenaire()
    {
        return $this->partenaire;
    }



   public function __toString()
    {
        return $this->roles;
    }
    /**
     * @ORM\PrePersist
     */
    public function setIpValue()
    {
        $this->setIp(isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : 0);
    }
    /**
     * @ORM\PrePersist
     */
    public function setTokenValue()
    {
        $this->setToken(Util::tokenfy());
    }
    /**
     * @ORM\PrePersist
     */
    public function setLastNameValue()
    {
        if(!$this->getLastName()){
            $this->setLastName(ucfirst(explode('@', $this->getEmail())[0]));
        }
    }
    /**
     * @ORM\PrePersist
     */
    public function setSuperAdminValue()
    {
        if($this->getEmail() === Events::ADMIN_DEFAULT_EMAIL) {
            $this->setSuperAdmin(true);         
        }
    }

    public function setAdmin($boolean)
    {
        if (true === $boolean) {
            $this->addRole('ROLE_ADMIN');
        } else {
            $this->removeRole('ROLE_ADMIN');
        }

        return $this;
    }


}
