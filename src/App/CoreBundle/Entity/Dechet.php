<?php

namespace App\CoreBundle\Entity;

use App\CoreBundle\Utils\Util;

/**
 * Dechet
 */
class Dechet
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
     * @var integer
     */
    private $amount;

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
    private $soldout;

    /**
     * @var \App\CoreBundle\Entity\DechetImage
     */
    private $dechetImage;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $dechetPartenaires;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $commandes;
    
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->dechetPartenaires = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return Dechet
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
     * Set amount
     *
     * @param integer $amount
     *
     * @return Dechet
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;

        return $this;
    }

    /**
     * Get amount
     *
     * @return integer
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * Set slug
     *
     * @param string $slug
     *
     * @return Dechet
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
     * @return Dechet
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
     * @return Dechet
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
     * @return Dechet
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
     * @return Dechet
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
     * Set soldout
     *
     * @param boolean $soldout
     *
     * @return Dechet
     */
    public function setSoldout($soldout)
    {
        $this->soldout = $soldout;

        return $this;
    }

    /**
     * Get soldout
     *
     * @return boolean
     */
    public function getSoldout()
    {
        return $this->soldout;
    }

    /**
     * Set dechetImage
     *
     * @param \App\CoreBundle\Entity\DechetImage $dechetImage
     *
     * @return Dechet
     */
    public function setDechetImage(\App\CoreBundle\Entity\DechetImage $dechetImage = null)
    {
        $this->dechetImage = $dechetImage;

        return $this;
    }

    /**
     * Get dechetImage
     *
     * @return \App\CoreBundle\Entity\DechetImage
     */
    public function getDechetImage()
    {
        return $this->dechetImage;
    }

    /**
     * Add dechetPartenaire
     *
     * @param \App\CoreBundle\Entity\DechetPartenaire $dechetPartenaire
     *
     * @return Dechet
     */
    public function addDechetPartenaire(\App\CoreBundle\Entity\DechetPartenaire $dechetPartenaire)
    {
        $this->dechetPartenaires[] = $dechetPartenaire;

        return $this;
    }

    /**
     * Remove dechetPartenaire
     *
     * @param \App\CoreBundle\Entity\DechetPartenaire $dechetPartenaire
     */
    public function removeDechetPartenaire(\App\CoreBundle\Entity\DechetPartenaire $dechetPartenaire)
    {
        $this->dechetPartenaires->removeElement($dechetPartenaire);
    }

    /**
     * Get dechetPartenaires
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getDechetPartenaires()
    {
        return $this->dechetPartenaires;
    }

    /**
     * Add commande
     *
     * @param \App\CoreBundle\Entity\Commande $commande
     *
     * @return Dechet
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

    public function mesuredAmount()
    {
        return Util::KgToTonne(trim($this->amount));
    }
    /**
     * @var string
     */
    private $description;


    /**
     * Set description
     *
     * @param string $description
     *
     * @return Dechet
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
}
