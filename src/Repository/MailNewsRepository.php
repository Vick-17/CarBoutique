<?php

namespace App\Repository;

use App\Entity\MailNews;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<MailNews>
 *
 * @method MailNews|null find($id, $lockMode = null, $lockVersion = null)
 * @method MailNews|null findOneBy(array $criteria, array $orderBy = null)
 * @method MailNews[]    findAll()
 * @method MailNews[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MailNewsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MailNews::class);
    }

    public function save(MailNews $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(MailNews $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function findMailUser()
    {
       return $this->createQueryBuilder('u')
            ->select('u.EmailUser')
            ->getQuery()
            ->getResult();

    }


    /*$query = $this->getEntityManager()->createQuery('SELECT emailUser FROM MailNews ');
            $mailsUser = $query->getResult();*/
//    /**
//     * @return MailNews[] Returns an array of MailNews objects
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

//    public function findOneBySomeField($value): ?MailNews
//    {
//        return $this->createQueryBuilder('m')
//            ->andWhere('m.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
