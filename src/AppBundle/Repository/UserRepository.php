<?php

namespace AppBundle\Repository;

/**
 * UserRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class UserRepository extends \Doctrine\ORM\EntityRepository
{

    public function getLatestTen()
    {
        return $this->findBy([], ['id' => 'asc'], 10, 0);
    }

    public function getFirstTen()
    {
//        return $this->getEntityManager()
//            ->createQuery("SELECT u FROM AppBundle\Entity\User u ORDER BY u.id ASC")
//            ->setMaxResults(10)
//            ->getResult();

        return $this->createQueryBuilder('u')
            ->orderBy('u.id', 'asc')
            ->setMaxResults(10)
            ->getQuery()
            ->getArrayResult();
    }

}
