<?php

namespace App\Repository;

use App\Entity\SchollBranch;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<SchollBranch>
 *
 * @method SchollBranch|null find($id, $lockMode = null, $lockVersion = null)
 * @method SchollBranch|null findOneBy(array $criteria, array $orderBy = null)
 * @method SchollBranch[]    findAll()
 * @method SchollBranch[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SchollBranchRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SchollBranch::class);
    }

//    /**
//     * @return SchollBranch[] Returns an array of SchollBranch objects
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

//    public function findOneBySomeField($value): ?SchollBranch
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
