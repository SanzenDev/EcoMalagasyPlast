<?php

namespace Portfolio\CoreBundle\Repository;

use Portfolio\CoreBundle\Entity\Blog;

/**
 * BlogRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class BlogRepository extends \Doctrine\ORM\EntityRepository
{
	public function create() {
        return new Blog;
    }

    public function findEntities()
    {
        return $this->createQueryBuilder('e')
                ->select('e','i')
                ->leftJoin('e.image', 'i')
                ->orderBy('e.id', 'DESC')
				->getQuery()
                ->getResult();
    }

    public function findEntity($slug)
    {
        return $this->createQueryBuilder('e')
                ->select('e','i')
                ->leftJoin('e.image', 'i')
                ->where('e.slug = :slug')
                ->setParameter('slug', $slug)           
                ->getQuery()
                ->getOneOrNullResult();
    }
    public function findLatest($limit)
    {
        return $this->createQueryBuilder('e')
                ->select('e','i')
                ->leftJoin('e.image', 'i')
                ->orderBy('e.id', 'DESC')
                ->setMaxResults($limit)
                ->getQuery()->getResult();
    }
}