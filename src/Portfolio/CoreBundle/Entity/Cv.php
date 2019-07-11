<?php

namespace Portfolio\CoreBundle\Entity;

/**
 * Cv
 */
class Cv
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $token;

    /**
     * @var \Portfolio\CoreBundle\Entity\Fichier
     */
    private $fichier;

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
     * @return Cv
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
     * Set fichier
     *
     * @param \Portfolio\CoreBundle\Entity\Fichier $fichier
     *
     * @return Cv
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
}
