<?php

namespace App\CoreBundle\Entity;

use Vich\UploaderBundle\Mapping\Annotation as Vich;
use App\CoreBundle\Entity\Abstracts\Media as Media;

/**
 * @Vich\Uploadable
 */
class PageImage extends Media
{
     /**
    * @Vich\UploadableField(mapping="page_image", fileNameProperty="name")
    */
    public $file;
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
     * @return PageImage
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
     * @return PageImage
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
     * @var string
     */
    protected $legend;


    /**
     * Set legend
     *
     * @param string $legend
     *
     * @return PageImage
     */
    public function setLegend($legend)
    {
        $this->legend = $legend;

        return $this;
    }

    /**
     * Get legend
     *
     * @return string
     */
    public function getLegend()
    {
        return $this->legend;
    }
    /**
     * @var boolean
     */
    private $cover;


    /**
     * Set cover
     *
     * @param boolean $cover
     *
     * @return PageImage
     */
    public function setCover($cover)
    {
        $this->cover = $cover;

        return $this;
    }

    /**
     * Get cover
     *
     * @return boolean
     */
    public function getCover()
    {
        return $this->cover;
    }
}
