<?php

namespace App\Repository;

use App\Entity\Message;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Message>
 *
 * @method Message|null find($id, $lockMode = null, $lockVersion = null)
 * @method Message|null findOneBy(array $criteria, array $orderBy = null)
 * @method Message[]    findAll()
 * @method Message[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MessageRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Message::class);
    }

//    /**
//     * @return Message[] Returns an array of Message objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('m')
//            ->andWhere('m.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('m.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Message
//    {
//        return $this->createQueryBuilder('m')
//            ->andWhere('m.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }


     public function nombreMessageNonLu($user, $userConnected){
         $qb = $this->createQueryBuilder("m");
         $qb->select('COUNT(m.id)');
         $qb->where('m.sentTo = :p1');
         $qb->andWhere('m.sentFrom = :p2');
         $qb->andWhere('m.isRead = 0');
         $qb->setParameter('p1' , $userConnected);
         $qb->setParameter('p2' , $user);
         return $qb->getQuery()->getSingleScalarResult();
     }

     public function lastMessage($value){
         $qb = $this->createQueryBuilder("m");
         $qb->select('m.content , m.createdAt');
         $qb->where('m.sentTo = :p1 OR m.sentFrom = :p1');
         $qb->orderBy('m.createdAt', 'DESC');
         $qb->setParameter('p1' , $value);
         $qb->setMaxResults(1);
         $result =  $qb->getQuery()->getOneOrNullResult();

         if ($result) {
             $result['content'] = substr($result['content'], 0, 30);
             return $result;  // this will return an array with 'content' and 'createdAt'
         }

         return ['content' => '', 'createdAt' => null];
     }

     public function messageNotification($value){
         $qb = $this->createQueryBuilder("m");
         $qb->select('COUNT(m.id)');
         $qb->where('m.sentTo = :p1');
         $qb->andWhere('m.isRead = 0');
         $qb->setParameter('p1' , $value);
         return $qb->getQuery()->getSingleScalarResult();
     }
}
