<?php

namespace App\CoreBundle\Entity\Abstracts;

use App\CoreBundle\Entity\Traits\FileTrait;

/**
 * Class Media.
 */
abstract class Media
{
    use FileTrait;

    public function __toString()
    {
        return $this->name;
    }

    public function sizeInMega()
    {
        if(strlen($this->size) <= 4 )    {
            return round(($this->size/1024), 1).' Ko';
        } else {
            return round(($this->size/1024)/1024, 2).' Mo';          
        }
    }
}
