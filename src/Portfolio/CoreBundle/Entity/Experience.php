<?php

namespace Portfolio\CoreBundle\Entity;

/**
 * Experience
 */
class Experience
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $poste;

    /**
     * @var string
     */
    private $duree;

    /**
     * @var string
     */
    private $description;

    /**
     * @var string
     */
    private $link;

    /**
     * @var string
     */
    private $token;

    /**
     * @var \Portfolio\CoreBundle\Entity\Image
     */
    private $logo;

    /**
     * @var \Portfolio\CoreBundle\Entity\Fichier
     */
    private $fichier;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $images;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->images = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set poste
     *
     * @param string $poste
     *
     * @return Experience
     */
    public function setPoste($poste)
    {
        $this->poste = $poste;

        return $this;
    }

    /**
     * Get poste
     *
     * @return string
     */
    public function getPoste()
    {
        return $this->poste;
    }

    /**
     * Set duree
     *
     * @param string $duree
     *
     * @return Experience
     */
    public function setDuree($duree)
    {
        $this->duree = $duree;

        return $this;
    }

    /**
     * Get duree
     *
     * @return string
     */
    public function getDuree()
    {
        return $this->duree;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Experience
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
     * Set link
     *
     * @param string $link
     *
     * @return Experience
     */
    public function setLink($link)
    {
        $this->link = $link;

        return $this;
    }

    /**
     * Get link
     *
     * @return string
     */
    public function getLink()
    {
        return $this->link;
    }

    /**
     * Set token
     *
     * @param string $token
     *
     * @return Experience
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
     * Set logo
     *
     * @param \Portfolio\CoreBundle\Entity\Image $logo
     *
     * @return Experience
     */
    public function setLogo(\Portfolio\CoreBundle\Entity\Image $logo = null)
    {
        $this->logo = $logo;

        return $this;
    }

    /**
     * Get logo
     *
     * @return \Portfolio\CoreBundle\Entity\Image
     */
    public function getLogo()
    {
        return $this->logo;
    }

    /**
     * Set fichier
     *
     * @param \Portfolio\CoreBundle\Entity\Fichier $fichier
     *
     * @return Experience
     */
    public function setFichier(\Portfolio\CoreBundle\Entity\Fichier $fichier = null)
    {
        $this->fichier = $fichier;

        return $this;
    }

    /**
     * Get fichier
     *
     * @return \Portfolio\CoreBundle\Entity\Fichier
     */
    public function getFichier()
    {
        return $this->fichier;
    }

    /**
     * Add image
     *
     * @param \Portfolio\CoreBundle\Entity\Image $image
     *
     * @return Experience
     */
    public function addImage(\Portfolio\CoreBundle\Entity\Image $image)
    {
        $this->images[] = $image;

        return $this;
    }

    /**
     * Remove image
     *
     * @param \Portfolio\CoreBundle\Entity\Image $image
     */
    public function removeImage(\Portfolio\CoreBundle\Entity\Image $image)
    {
        $this->images->removeElement($image);
    }

    /**
     * Get images
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getImages()
    {
        return $this->images;
    }
    /**
     * @var string
     */
    private $society;


    /**
     * Set society
     *
     * @param string $society
     *
     * @return Experience
     */
    public function setSociety($society)
    {
        $this->society = $society;

        return $this;
    }

    /**
     * Get society
     *
     * @return string
     */
    public function getSociety()
    {
        return $this->society;
    }
}
