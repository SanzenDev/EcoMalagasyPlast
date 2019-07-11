<?php

namespace App\CoreBundle\Entity;

use Vich\UploaderBundle\Mapping\Annotation as Vich;
use App\CoreBundle\Entity\Abstracts\Media as Media;

/**
 * @Vich\Uploadable
 */
class NewsOtherImages extends Media
{
    /**
     * @var integer
     */
    protected $id;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var \DateTime
     */
    protected $updatedAt;

     /**
    * @Vich\UploadableField(mapping="news_other_images", fileNameProperty="name")
    */
    public $file;
    public function __toString()
    {
        return $this->name;
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
     * @return NewsOtherImages
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
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     *
     * @return NewsOtherImages
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
}
