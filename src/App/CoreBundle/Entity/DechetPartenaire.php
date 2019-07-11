<?php

namespace App\CoreBundle\Entity;

/**
 * DechetPartenaire
 */
class DechetPartenaire
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var float
     */
    private $quantity;

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
     * @var \App\CoreBundle\Entity\Dechet
     */
    private $dechet;

    /**
     * @var \App\CoreBundle\Entity\Partenaire
     */
    private $partenaire;


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
     * Set quantity
     *
     * @param float $quantity
     *
     * @return DechetPartenaire
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;

        return $this;
    }

    /**
     * Get quantity
     *
     * @return float
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * Set token
     *
     * @param string $token
     *
     * @return DechetPartenaire
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
     * @return DechetPartenaire
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
     * @return DechetPartenaire
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
     * Set dechet
     *
     * @param \App\CoreBundle\Entity\Dechet $dechet
     *
     * @return DechetPartenaire
     */
    public function setDechet(\App\CoreBundle\Entity\Dechet $dechet = null)
    {
        $this->dechet = $dechet;

        return $this;
    }

    /**
     * Get dechet
     *
     * @return \App\CoreBundle\Entity\Dechet
     */
    public function getDechet()
    {
        return $this->dechet;
    }

    /**
     * Set partenaire
     *
     * @param \App\CoreBundle\Entity\Partenaire $partenaire
     *
     * @return DechetPartenaire
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
}
