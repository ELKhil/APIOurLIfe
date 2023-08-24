<?php

namespace App\Repository;

use App\Entity\Donation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Donation>
 *
 * @method Donation|null find($id, $lockMode = null, $lockVersion = null)
 * @method Donation|null findOneBy(array $criteria, array $orderBy = null)
 * @method Donation[]    findAll()
 * @method Donation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DonationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Donation::class);
    }

//    /**
//     * @return Donation[] Returns an array of Donation objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('d')
//            ->andWhere('d.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('d.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Donation
//    {
//        return $this->createQueryBuilder('d')
//            ->andWhere('d.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }

      public function getFiveLastDonation(){
          $qb = $this->createQueryBuilder('d');
          $qb->andWhere('d.payement = :payement');
          $qb->setParameter('payement', true);
          $qb->orderBy('d.createdAt', 'DESC');
          $qb->setMaxResults(5);

        return $qb->getQuery()->getResult();
      }

      public function getTotalAmount(){
        $qb =$this->createQueryBuilder('do');
          $qb->select('SUM(do.amount) as totalAmount');
          $qb->andWhere('do.payement = :payement');
          $qb->setParameter('payement', true);
          return $qb->getQuery()->getSingleScalarResult();
      }

}
