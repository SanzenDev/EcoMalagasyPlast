<?php

namespace App\CoreBundle\Entity;

use App\CoreBundle\Utils\Util;
use Doctrine\ORM\Mapping as ORM;

/**
 * News
 */
class News
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
     * @var \App\CoreBundle\Entity\NewsImage
     */
    private $newsImage;

    /**
     * @var \App\CoreBundle\Entity\NewsVideoMp4
     */
    private $newsVideoMp4;

    /**
     * @var \App\CoreBundle\Entity\NewsVideoOgg
     */
    private $newsVideoOgg;

    /**
     * @var \App\CoreBundle\Entity\NewsZip
     */
    private $newsZip;

    /**
     * @var \App\CoreBundle\Entity\NewsPdf
     */
    private $newsPdf;

    /**
     * @var \App\CoreBundle\Entity\Utilisateur
     */
    private $user;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $newsOtherImages;

    /**
     * @var \App\CoreBundle\Entity\NewsVideoWebm
     */
    private $newsVideoWebm;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->newsOtherImages = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return News
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
     * @return News
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
        return html_entity_decode($this->content, ENT_QUOTES, "UTF-8");
    }

    /**
     * Set metaTitle
     *
     * @param string $metaTitle
     *
     * @return News
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
     * @return News
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
     * @return News
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
     * @return News
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
     * @return News
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
     * @return News
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
     * @return News
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
     * @return News
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
     * Set newsImage
     *
     * @param \App\CoreBundle\Entity\NewsImage $newsImage
     *
     * @return News
     */
    public function setNewsImage(\App\CoreBundle\Entity\NewsImage $newsImage = null)
    {
        $this->newsImage = $newsImage;

        return $this;
    }

    /**
     * Get newsImage
     *
     * @return \App\CoreBundle\Entity\NewsImage
     */
    public function getNewsImage()
    {
        return $this->newsImage;
    }

    /**
     * Set newsVideoMp4
     *
     * @param \App\CoreBundle\Entity\NewsVideoMp4 $newsVideoMp4
     *
     * @return News
     */
    public function setNewsVideoMp4(\App\CoreBundle\Entity\NewsVideoMp4 $newsVideoMp4 = null)
    {
        $this->newsVideoMp4 = $newsVideoMp4;

        return $this;
    }

    /**
     * Get newsVideoMp4
     *
     * @return \App\CoreBundle\Entity\NewsVideoMp4
     */
    public function getNewsVideoMp4()
    {
        return $this->newsVideoMp4;
    }

    /**
     * Set newsVideoOgg
     *
     * @param \App\CoreBundle\Entity\NewsVideoOgg $newsVideoOgg
     *
     * @return News
     */
    public function setNewsVideoOgg(\App\CoreBundle\Entity\NewsVideoOgg $newsVideoOgg = null)
    {
        $this->newsVideoOgg = $newsVideoOgg;

        return $this;
    }

    /**
     * Get newsVideoOgg
     *
     * @return \App\CoreBundle\Entity\NewsVideoOgg
     */
    public function getNewsVideoOgg()
    {
        return $this->newsVideoOgg;
    }

    /**
     * Set newsZip
     *
     * @param \App\CoreBundle\Entity\NewsZip $newsZip
     *
     * @return News
     */
    public function setNewsZip(\App\CoreBundle\Entity\NewsZip $newsZip = null)
    {
        $this->newsZip = $newsZip;

        return $this;
    }

    /**
     * Get newsZip
     *
     * @return \App\CoreBundle\Entity\NewsZip
     */
    public function getNewsZip()
    {
        return $this->newsZip;
    }

    /**
     * Set newsPdf
     *
     * @param \App\CoreBundle\Entity\NewsPdf $newsPdf
     *
     * @return News
     */
    public function setNewsPdf(\App\CoreBundle\Entity\NewsPdf $newsPdf = null)
    {
        $this->newsPdf = $newsPdf;

        return $this;
    }

    /**
     * Get newsPdf
     *
     * @return \App\CoreBundle\Entity\NewsPdf
     */
    public function getNewsPdf()
    {
        return $this->newsPdf;
    }

    /**
     * Set user
     *
     * @param \App\CoreBundle\Entity\Utilisateur $user
     *
     * @return News
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
     * Add newsOtherImage
     *
     * @param \App\CoreBundle\Entity\NewsOtherImages $newsOtherImage
     *
     * @return News
     */
    public function addNewsOtherImage(\App\CoreBundle\Entity\NewsOtherImages $newsOtherImage)
    {
        $this->newsOtherImages[] = $newsOtherImage;

        return $this;
    }

    /**
     * Remove newsOtherImage
     *
     * @param \App\CoreBundle\Entity\NewsOtherImages $newsOtherImage
     */
    public function removeNewsOtherImage(\App\CoreBundle\Entity\NewsOtherImages $newsOtherImage)
    {
        $this->newsOtherImages->removeElement($newsOtherImage);
    }

    /**
     * Get newsOtherImages
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getNewsOtherImages()
    {
        return $this->newsOtherImages;
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
    
    /**
     * Set newsVideoWebm
     *
     * @param \App\CoreBundle\Entity\NewsVideoWebm $newsVideoWebm
     *
     * @return News
     */
    public function setNewsVideoWebm(\App\CoreBundle\Entity\NewsVideoWebm $newsVideoWebm = null)
    {
        $this->newsVideoWebm = $newsVideoWebm;

        return $this;
    }

    /**
     * Get newsVideoWebm
     *
     * @return \App\CoreBundle\Entity\NewsVideoWebm
     */
    public function getNewsVideoWebm()
    {
        return $this->newsVideoWebm;
    }
    /**
     * @var string
     */
    private $youtube;


    /**
     * Set youtube
     *
     * @param string $youtube
     *
     * @return News
     */
    public function setYoutube($youtube)
    {
        $this->youtube = $youtube;

        return $this;
    }

    /**
     * Get youtube
     *
     * @return string
     */
    public function getYoutube()
    {
        return $this->youtube;
    }
}
