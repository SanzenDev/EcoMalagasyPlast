<?php

namespace App\CoreBundle\Entity;

/**
 * Partenaire
 */
class Partenaire
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
    private $responsable;

    /**
     * @var string
     */
    private $livraison;

    /**
     * @var string
     */
    private $type;

    /**
     * @var string
     */
    private $address;

    /**
     * @var string
     */
    private $website;

    /**
     * @var string
     */
    private $fb;

    /**
     * @var string
     */
    private $description;

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
    private $dechetPartenaires;

    /**
     * @var \App\CoreBundle\Entity\Utilisateur
     */
    private $user;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->dechetPartenaires = new \Doctrine\Common\Collections\ArrayCollection();
        //$this->checked = 0;
        //$this->enabled = 1;
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
     * @return Partenaire
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
     * @return Partenaire
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
     * Set responsable
     *
     * @param string $responsable
     *
     * @return Partenaire
     */
    public function setResponsable($responsable)
    {
        $this->responsable = $responsable;

        return $this;
    }

    /**
     * Get responsable
     *
     * @return string
     */
    public function getResponsable()
    {
        return $this->responsable;
    }

    /**
     * Set livraison
     *
     * @param string $livraison
     *
     * @return Partenaire
     */
    public function setLivraison($livraison)
    {
        $this->livraison = $livraison;

        return $this;
    }

    /**
     * Get livraison
     *
     * @return string
     */
    public function getLivraison()
    {
        return $this->livraison;
    }

    /**
     * Set type
     *
     * @param string $type
     *
     * @return Partenaire
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set address
     *
     * @param string $address
     *
     * @return Partenaire
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
     * Set website
     *
     * @param string $website
     *
     * @return Partenaire
     */
    public function setWebsite($website)
    {
        $this->website = $website;

        return $this;
    }

    /**
     * Get website
     *
     * @return string
     */
    public function getWebsite()
    {
        return $this->website;
    }

    /**
     * Set fb
     *
     * @param string $fb
     *
     * @return Partenaire
     */
    public function setFb($fb)
    {
        $this->fb = $fb;

        return $this;
    }

    /**
     * Get fb
     *
     * @return string
     */
    public function getFb()
    {
        return $this->fb;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Partenaire
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
     * Set slug
     *
     * @param string $slug
     *
     * @return Partenaire
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
     * @return Partenaire
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
     * @return Partenaire
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
     * @return Partenaire
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
     * @return Partenaire
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
     * @return Partenaire
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
     * Add dechetPartenaire
     *
     * @param \App\CoreBundle\Entity\DechetPartenaire $dechetPartenaire
     *
     * @return Partenaire
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
     * Set user
     *
     * @param \App\CoreBundle\Entity\Utilisateur $user
     *
     * @return Partenaire
     */
    public function setUser(\App\CoreBundle\Entity\Utilisateur $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \App\CoreBundle\Entity\Utilisateur
     */
    public function getUser()
    {
        return $this->user;
    }
    /**
     * @var \App\CoreBundle\Entity\PartenaireImage
     */
    private $partenaireImage;

    /**
     * @var \App\CoreBundle\Entity\PartenaireLogo
     */
    private $partenaireLogo;


    /**
     * Set partenaireImage
     *
     * @param \App\CoreBundle\Entity\PartenaireImage $partenaireImage
     *
     * @return Partenaire
     */
    public function setPartenaireImage(\App\CoreBundle\Entity\PartenaireImage $partenaireImage = null)
    {
        $this->partenaireImage = $partenaireImage;

        return $this;
    }

    /**
     * Get partenaireImage
     *
     * @return \App\CoreBundle\Entity\PartenaireImage
     */
    public function getPartenaireImage()
    {
        return $this->partenaireImage;
    }

    /**
     * Set partenaireLogo
     *
     * @param \App\CoreBundle\Entity\PartenaireLogo $partenaireLogo
     *
     * @return Partenaire
     */
    public function setPartenaireLogo(\App\CoreBundle\Entity\PartenaireLogo $partenaireLogo = null)
    {
        $this->partenaireLogo = $partenaireLogo;

        return $this;
    }

    /**
     * Get partenaireLogo
     *
     * @return \App\CoreBundle\Entity\PartenaireLogo
     */
    public function getPartenaireLogo()
    {
        return $this->partenaireLogo;
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
     * @return Partenaire
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
     * @return Partenaire
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
     * @return Partenaire
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
