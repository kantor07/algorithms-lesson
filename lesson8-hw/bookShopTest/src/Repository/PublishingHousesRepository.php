<?php

namespace App\Repository;

use App\Entity\PublishingHouses;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method PublishingHouses|null find($id, $lockMode = null, $lockVersion = null)
 * @method PublishingHouses|null findOneBy(array $criteria, array $orderBy = null)
 * @method PublishingHouses[]    findAll()
 * @method PublishingHouses[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PublishingHousesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PublishingHouses::class);
    }

    // /**
    //  * @return PublishingHouses[] Returns an array of PublishingHouses objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?PublishingHouses
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
