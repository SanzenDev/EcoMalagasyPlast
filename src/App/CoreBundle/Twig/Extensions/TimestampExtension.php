<?php

namespace App\CoreBundle\Twig\Extensions;

class TimestampExtension extends \Twig_Extension
{
    public function getFilters()
    {
        return array(
            'created_ago' => new \Twig_Filter_Method($this, 'createdAgo'),
        );
    }

    public function createdAgo(\DateTime $dateTime)
    {
        $delta = time() - $dateTime->getTimestamp();
        if ($delta < 0)
            throw new \Exception("createdAgo is unable to handle dates in the future");

        $duration = "";
        if ($delta < 60)
        {
            // Seconds
            $time = $delta;
            $duration = " Il y a " . $time . " seconde" . (($time === 0 || $time > 1) ? "s" : "") ;
        }
        else if ($delta < 3600)
        {
            // Mins
            $time = floor($delta / 60);
            $duration =  " Il y a " . $time . " minute" . (($time > 1) ? "s" : "") ;
        }
        else if ($delta < 86400)
        {
            // Hours
            $time = floor($delta / 3600);
            $duration =  " Il y a ". $time . " heure" . (($time > 1) ? "s" : "") ;
        }
        else if ($delta < 31536000)
        {
            // Days
            $time = floor($delta / 86400);
            $duration =  " Il y a " . $time . " jour" . (($time > 1) ? "s" : "") ;
        } else {
            // year
            $time = floor($delta / 3153600);
            $duration =  " Il y a " . $time . " an" . (($time > 1) ? "s" : "") ;            
        }

        return $duration;
    }

    public function getName()
    {
        return 'timestamp_extension';
    }
}