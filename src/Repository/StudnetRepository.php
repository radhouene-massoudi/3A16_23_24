<?php

namespace App\Repository;

use App\Entity\Studnet;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Studnet>
 *
 * @method Studnet|null find($id, $lockMode = null, $lockVersion = null)
 * @method Studnet|null findOneBy(array $criteria, array $orderBy = null)
 * @method Studnet[]    findAll()
 * @method Studnet[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class StudnetRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Studnet::class);
    }

//    /**
//     * @return Studnet[] Returns an array of Studnet objects
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

//    public function findOneBySomeField($value): ?Studnet
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
