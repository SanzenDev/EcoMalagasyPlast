<?php

namespace App\CoreBundle\Utils;

use App\CoreBundle\Entity\News;
use App\CoreBundle\Entity\Partenaire;
use App\CoreBundle\Entity\Dechet;
use App\CoreBundle\Entity\Page;
	
class Util
{
    static public function tokenfy()
    {
        return date("dmy")."-".rand(11111,99999);
        //$text = sha1($text.rand(11111, 99999));
    }
	
    static public function shortify($text, $length = null)
    {
        return (!is_null($length) && $length > 0)
            ? trim(substr($text, 0, $length))
            : null;
    }

    static public function tags($text) {
        return implode(',', explode(' ', Util::shortify($text, 250)));
    }

 // $tags = array_merge(explode(",", $blogTag['metaKeywords']), $tags);
    static public function url($link, $website)
    {
    	switch ($website) {
    		case 'fb':
    			$pattern = '#^([a-z]+://)?[a-zA-Z0-9\-]+(\.[a-zA-Z0-9\-]+)+(:[0-9]+)?(/.*)?$#';
    			break;
    		
    		default:
    			$pattern = '#^([a-z]+://)?[a-zA-Z0-9\-]+(\.[a-zA-Z0-9\-]+)+(:[0-9]+)?(/.*)?$#';
    			break;
    	}

        if( $link !== '' && preg_match( $pattern, $link ) !== 1 ) {
            throw new \Exception( sprintf( 'Invalid web site URL "%1$s"', $link ) );
        }

        return (string) $link;
    }

    static public function KgToTonne($amount)
    {
        if(strlen($amount) < 4)    {
            return $amount.' Kg';
            // return round(($amount/1024), 1).' Ko';
        } else {
            $tonnes = round(($amount/1000), 2);
            return $tonnes <= 1 ? $tonnes .' tonne' : $tonnes .' tonnes';     
        }
    }
}
	