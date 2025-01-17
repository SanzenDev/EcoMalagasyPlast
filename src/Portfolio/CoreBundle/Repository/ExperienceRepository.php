<?php

namespace Portfolio\CoreBundle\Repository;

use Portfolio\CoreBundle\Entity\Experience;

/**
 * ExperienceRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ExperienceRepository extends \Doctrine\ORM\EntityRepository
{
	public function create() {
        return new Experience;
    }

    public function findEntities()
    {
        return $this->createQueryBuilder('e')
                ->select('e','i', 'f')
                ->leftJoin('e.logo', 'i')
                ->leftJoin('e.fichier', 'f')
                ->orderBy('e.id', 'DESC')
				->getQuery()
                ->getResult();
    }
}
