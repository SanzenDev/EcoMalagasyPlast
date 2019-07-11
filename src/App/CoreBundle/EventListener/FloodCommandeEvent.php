<?php

namespace App\CoreBundle\EventListener;

use Doctrine\ORM\Event\LifecycleEventArgs;
use App\CoreBundle\Entity\Commande;
use App\CoreBundle\Entity\Utilisateur;

class FloodCommandeEvent
{
    private $floodLimit;
    
    public function __construct($floodLimit)
    {
        $this->floodLimit = $floodLimit;
    }
    public function prePersist(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();

        if (!$entity instanceof Commande) {
            return;
        }

        $dateNow = new \DateTime('now');
        $floodLimit = new \DateTime('-'.$this->floodLimit.' seconds');

        if (!is_null($entity->getClient()->getLastSendDate()) && $floodLimit <= $entity->getClient()->getLastSendDate()) { // USER IS FLOODING
            throw new \Exception('Vous devriez attendre '.$this->floodLimit.'secondes pour pouvoir commander de nouveau');
        }

        $entity->getClient()->setLastSendDate($dateNow);

        return;
    }
}