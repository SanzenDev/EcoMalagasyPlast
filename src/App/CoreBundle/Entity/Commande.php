<?php

namespace App\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\CoreBundle\Utils\Util;

/**
 * Commande
 */
class Commande
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
     * @var \DateTime
     */
    private $delais;

    /**
     * @var string
     */
    private $reason;

    /**
     * @var string
     */
    private $token;

    /**
     * @var boolean
     */
    private $enabled;

    /**
     * @var boolean
     */
    private $checked;

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
     * @var \App\CoreBundle\Entity\Client
     */
    private $client;


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
     * @return Commande
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
     * Set delais
     *
     * @param \DateTime $delais
     *
     * @return Commande
     */
    public function setDelais($delais)
    {
        $this->delais = $delais;

        return $this;
    }

    /**
     * Get delais
     *
     * @return \DateTime
     */
    public function getDelais()
    {
        return $this->delais;
    }

    /**
     * Set reason
     *
     * @param string $reason
     *
     * @return Commande
     */
    public function setReason($reason)
    {
        $this->reason = $reason;

        return $this;
    }

    /**
     * Get reason
     *
     * @return string
     */
    public function getReason()
    {
        return $this->reason;
    }

    /**
     * Set token
     *
     * @param string $token
     *
     * @return Commande
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
     * Set enabled
     *
     * @param boolean $enabled
     *
     * @return Commande
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
     * @return Commande
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
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return Commande
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
     * @return Commande
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
     * @return Commande
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
     * Set client
     *
     * @param \App\CoreBundle\Entity\Client $client
     *
     * @return Commande
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



    public function finished() {
        $fin = clone $this->getDelais();
        $today = new \DateTime;
        if($fin <= $today) {
            return true;
        }
        return false;
    }

    public function signed() {
        if($this->getEnabled() && $this->finished()){
            return true ;       
        }
        return false;
    }

    public function mesuredAmount()
    {
        return Util::KgToTonne($this->quantity);
    }
    /**
     * @var string
     */
    private $slug;


    /**
     * Set slug
     *
     * @param string $slug
     *
     * @return Commande
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
}
