<?php

namespace App\CoreBundle\Entity\Traits;

use Symfony\Component\HttpFoundation\File\File;

trait FileTrait
{
    public function setFile(File $file = null)
    {
        $this->file = $file;
        
        if (null !== $file) {
            $this->updatedAt = new \DateTimeImmutable();

                $this->size = $file->getSize();               
                $this->extension = $file->getExtension();               
                $this->mimeType = $file->getMimeType();               
        }
    }   
}