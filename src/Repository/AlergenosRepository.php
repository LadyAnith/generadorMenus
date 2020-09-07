<?php

namespace App\Repository;

use App\Entity\Alergenos;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Alergenos|null find($id, $lockMode = null, $lockVersion = null)
 * @method Alergenos|null findOneBy(array $criteria, array $orderBy = null)
 * @method Alergenos[]    findAll()
 * @method Alergenos[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AlergenosRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Alergenos::class);
    }

    // /**
    //  * @return Alergenos[] Returns an array of Alergenos objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Alergenos
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
