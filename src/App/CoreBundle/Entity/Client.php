<?php

namespace App\CoreBundle\Entity;

/**
 * Client
 */
class Client
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $tel;

    /**
     * @var string
     */
    private $address;

    /**
     * @var string
     */
    private $slug;

    /**
     * @var string
     */
    private $token;

    /**
     * @var \DateTime
     */
    private $createdAt;

    /**
     * @var \DateTime
     */
    private $updatedAt;

    /**
     * @var boolean
     */
    private $enabled;

    /**
     * @var boolean
     */
    private $checked;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $commandes;

    /**
     * @var boolean
     */
    private $showed;


    /**
     * Constructor
     */
    public function __construct()
    {
        $this->commandes = new \Doctrine\Common\Collections\ArrayCollection();
       $this->enabled = true;
        // if($this->getUser()){
        //     $this->getUser()->addRole('ROLE_CLIENT');           
        // }
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
     * Set name
     *
     * @param string $name
     *
     * @return Client
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
     * Set tel
     *
     * @param string $tel
     *
     * @return Client
     */
    public function setTel($tel)
    {
        $this->tel = $tel;

        return $this;
    }

    /**
     * Get tel
     *
     * @return string
     */
    public function getTel()
    {
        return $this->tel;
    }

    /**
     * Set address
     *
     * @param string $address
     *
     * @return Client
     */
    public function setAddress($address)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * Get address
     *
     * @return string
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Set slug
     *
     * @param string $slug
     *
     * @return Client
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
     * Set token
     *
     * @param string $token
     *
     * @return Client
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
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return Client
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
     * @return Client
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
     * Set enabled
     *
     * @param boolean $enabled
     *
     * @return Client
     */
    public function setEnabled($enabled)
    {
        $this->enabled = $enabled;

        return $this;
    }

    /**
     * Get enabled
     *
     * @return boolean
     */
    public function getEnabled()
    {
        return $this->enabled;
    }

    /**
     * Set checked
     *
     * @param boolean $checked
     *
     * @return Client
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
     * Add commande
     *
     * @param \App\CoreBundle\Entity\Commande $commande
     *
     * @return Client
     */
    public function addCommande(\App\CoreBundle\Entity\Commande $commande)
    {
        $this->commandes[] = $commande;

        return $this;
    }

    /**
     * Remove commande
     *
     * @param \App\CoreBundle\Entity\Commande $commande
     */
    public function removeCommande(\App\CoreBundle\Entity\Commande $commande)
    {
        $this->commandes->removeElement($commande);
    }

    /**
     * Get commandes
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCommandes()
    {
        return $this->commandes;
    }


    /**
     * Set showed
     *
     * @param boolean $showed
     *
     * @return Client
     */
    public function setShowed($showed)
    {
        $this->showed = $showed;

        return $this;
    }

    /**
     * Get showed
     *
     * @return boolean
     */
    public function getShowed()
    {
        return $this->showed;
    }
    /**
     * @var \App\CoreBundle\Entity\User
     */
    private $user;


    /**
     * Set user
     *
     * @param \App\CoreBundle\Entity\User $user
     *
     * @return Client
     */
    public function setUser(\App\CoreBundle\Entity\Utilisateur $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \App\CoreBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }
    /**
     * @var \DateTime
     */
    private $lastSendDate;


    /**
     * Set lastSendDate
     *
     * @param \DateTime $lastSendDate
     *
     * @return Client
     */
    public function setLastSendDate($lastSendDate)
    {
        $this->lastSendDate = $lastSendDate;

        return $this;
    }

    /**
     * Get lastSendDate
     *
     * @return \DateTime
     */
    public function getLastSendDate()
    {
        return $this->lastSendDate;
    }
    /**
     * @var integer
     */
    private $nif;

    /**
     * @var integer
     */
    private $stat;

    /**
     * @var string
     */
    private $rce;


    /**
     * Set nif
     *
     * @param integer $nif
     *
     * @return Client
     */
    public function setNif($nif)
    {
        $this->nif = $nif;

        return $this;
    }

    /**
     * Get nif
     *
     * @return integer
     */
    public function getNif()
    {
        return $this->nif;
    }

    /**
     * Set stat
     *
     * @param integer $stat
     *
     * @return Client
     */
    public function setStat($stat)
    {
        $this->stat = $stat;

        return $this;
    }

    /**
     * Get stat
     *
     * @return integer
     */
    public function getStat()
    {
        return $this->stat;
    }

    /**
     * Set rce
     *
     * @param string $rce
     *
     * @return Client
     */
    public function setRce($rce)
    {
        $this->rce = $rce;

        return $this;
    }

    /**
     * Get rce
     *
     * @return string
     */
    public function getRce()
    {
        return $this->rce;
    }
}
