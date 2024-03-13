<?php

namespace App\Repository;

use App\Entity\StateOrder;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<StateOrder>
 *
 * @method StateOrder|null find($id, $lockMode = null, $lockVersion = null)
 * @method StateOrder|null findOneBy(array $criteria, array $orderBy = null)
 * @method StateOrder[]    findAll()
 * @method StateOrder[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class StateOrderRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, StateOrder::class);
    }

//    /**
//     * @return StateOrder[] Returns an array of StateOrder objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('s.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?StateOrder
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
