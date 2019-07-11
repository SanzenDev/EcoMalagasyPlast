<?php

namespace App\CoreBundle\Entity;

use App\CoreBundle\Utils\Util;
use Doctrine\ORM\Mapping as ORM;

/**
 * Page
 */
class Page
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $title;

    /**
     * @var string
     */
    private $content;

    /**
     * @var string
     */
    private $metaTitle;

    /**
     * @var string
     */
    private $metaDescription;

    /**
     * @var string
     */
    private $metaKeywords;

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
     * @var \App\CoreBundle\Entity\PageImage
     */
    private $pageImage;

    /**
     * @var \App\CoreBundle\Entity\Utilisateur
     */
    private $user;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $pageOtherImages;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->pageOtherImages = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set title
     *
     * @param string $title
     *
     * @return Page
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set content
     *
     * @param string $content
     *
     * @return Page
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content
     *
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set metaTitle
     *
     * @param string $metaTitle
     *
     * @return Page
     */
    public function setMetaTitle($metaTitle)
    {
        $this->metaTitle = $metaTitle;

        return $this;
    }

    /**
     * Get metaTitle
     *
     * @return string
     */
    public function getMetaTitle()
    {
        return $this->metaTitle;
    }

    /**
     * Set metaDescription
     *
     * @param string $metaDescription
     *
     * @return Page
     */
    public function setMetaDescription($metaDescription)
    {
        $this->metaDescription = $metaDescription;

        return $this;
    }

    /**
     * Get metaDescription
     *
     * @return string
     */
    public function getMetaDescription()
    {
        return $this->metaDescription;
    }

    /**
     * Set metaKeywords
     *
     * @param string $metaKeywords
     *
     * @return Page
     */
    public function setMetaKeywords($metaKeywords)
    {
        $this->metaKeywords = $metaKeywords;

        return $this;
    }

    /**
     * Get metaKeywords
     *
     * @return string
     */
    public function getMetaKeywords()
    {
        return $this->metaKeywords;
    }

    /**
     * Set slug
     *
     * @param string $slug
     *
     * @return Page
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
     * @return Page
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
     * @return Page
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
     * @return Page
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
     * @return Page
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
     * Set pageImage
     *
     * @param \App\CoreBundle\Entity\PageImage $pageImage
     *
     * @return Page
     */
    public function setPageImage(\App\CoreBundle\Entity\PageImage $pageImage = null)
    {
        $this->pageImage = $pageImage;

        return $this;
    }

    /**
     * Get pageImage
     *
     * @return \App\CoreBundle\Entity\PageImage
     */
    public function getPageImage()
    {
        return $this->pageImage;
    }

    /**
     * Set user
     *
     * @param \App\CoreBundle\Entity\Utilisateur $user
     *
     * @return Page
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
     * Add pageOtherImage
     *
     * @param \App\CoreBundle\Entity\PageOtherImages $pageOtherImage
     *
     * @return Page
     */
    public function addPageOtherImage(\App\CoreBundle\Entity\PageOtherImages $pageOtherImage)
    {
        $this->pageOtherImages[] = $pageOtherImage;

        return $this;
    }

    /**
     * Remove pageOtherImage
     *
     * @param \App\CoreBundle\Entity\PageOtherImages $pageOtherImage
     */
    public function removePageOtherImage(\App\CoreBundle\Entity\PageOtherImages $pageOtherImage)
    {
        $this->pageOtherImages->removeElement($pageOtherImage);
    }

    /**
     * Get pageOtherImages
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPageOtherImages()
    {
        return $this->pageOtherImages;
    }

    /**
     * @ORM\PrePersist
     */
    public function setMetaTitleValue()
    {
        $text = strlen($this->title) < 200 
                ? strip_tags($this->title).' - Re-cycl\'in Mada'
                : strip_tags($this->title);
        if(!$this->getMetaTitle()){
            $this->setMetaTitle($text);
        }
    }

    /**
     * @ORM\PrePersist
     */
    public function setMetaDescriptionValue()
    {
        if(!$this->getMetaDescription() && $this->getContent()){
            $this->setMetaDescription(Util::shortify(strip_tags($this->content), 254));
        }
    }

    /**
     * @ORM\PrePersist
     */
    public function setMetaKeysValue()
    {
        if(!$this->getMetaKeywords() && $this->getContent()){
            $this->setMetaKeywords(Util::tags(strip_tags($this->content)));
        }
    }
}
