<?php

namespace App\Repository;

use App\Entity\GroupAd;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<GroupAd>
 *
 * @method GroupAd|null find($id, $lockMode = null, $lockVersion = null)
 * @method GroupAd|null findOneBy(array $criteria, array $orderBy = null)
 * @method GroupAd[]    findAll()
 * @method GroupAd[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GroupAdRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, GroupAd::class);
    }

//    /**
//     * @return GroupAd[] Returns an array of GroupAd objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('g')
//            ->andWhere('g.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('g.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?GroupAd
//    {
//        return $this->createQueryBuilder('g')
//            ->andWhere('g.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
