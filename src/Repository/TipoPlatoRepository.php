<?php

namespace App\Repository;

use App\Entity\TipoPlato;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method TipoPlato|null find($id, $lockMode = null, $lockVersion = null)
 * @method TipoPlato|null findOneBy(array $criteria, array $orderBy = null)
 * @method TipoPlato[]    findAll()
 * @method TipoPlato[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TipoPlatoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TipoPlato::class);
    }

    // /**
    //  * @return TipoPlato[] Returns an array of TipoPlato objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?TipoPlato
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
