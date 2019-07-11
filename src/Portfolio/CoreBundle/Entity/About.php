<?php

namespace Portfolio\CoreBundle\Entity;

/**
 * About
 */
class About
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $description;

    /**
     * @var string
     */
    private $token;

    /**
     * @var \Portfolio\CoreBundle\Entity\Image
     */
    private $profil;

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
     * Set description
     *
     * @param string $description
     *
     * @return About
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
     * Set token
     *
     * @param string $token
     *
     * @return About
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
     * Set profil
     *
     * @param \Portfolio\CoreBundle\Entity\Image $profil
     *
     * @return About
     */
    public function setProfil(\Portfolio\CoreBundle\Entity\Image $profil = null)
    {
        $this->profil = $profil;

        return $this;
    }

    /**
     * Get profil
     *
     * @return \Portfolio\CoreBundle\Entity\Image
     */
    public function getProfil()
    {
        return $this->profil;
    }
}
