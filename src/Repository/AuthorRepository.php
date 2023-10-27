<?php

namespace App\Repository;

use App\Entity\Author;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Author>
 *
 * @method Author|null find($id, $lockMode = null, $lockVersion = null)
 * @method Author|null findOneBy(array $criteria, array $orderBy = null)
 * @method Author[]    findAll()
 * @method Author[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AuthorRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Author::class);
    }

    //    /**
    //     * @return Author[] Returns an array of Author objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('a')
    //            ->andWhere('a.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('a.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Author
    //    {
    //        return $this->createQueryBuilder('a')
    //            ->andWhere('a.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }

    public function fetchAuthorByUserName($username)
    {
        $dql = "select a.username from App\Entity\Author a where a.username=?1 ";
        $em = $this->getEntityManager();

        $req = $em->createQuery($dql);
        $req->setParameter('1', $username);
        return $req->getResult();
    }
    public function fetchAuthors()
    {
        $condtion = true;
        $req = $this
            ->createQueryBuilder('a')
            ->select('a.email')
            ->where('a.age>:age')
            ->setParameter('age', 46);
        if ($condtion) {
            $req->join('a.books', 'b')
            ->addSelect('b.title');
        }
       $result= $req->getQuery()
            ->getResult();
        return $result;
    }
}
