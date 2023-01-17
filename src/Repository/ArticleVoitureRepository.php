<?php

namespace App\Repository;

use App\Entity\ArticleVoiture;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ArticleVoiture>
 *
 * @method ArticleVoiture|null find($id, $lockMode = null, $lockVersion = null)
 * @method ArticleVoiture|null findOneBy(array $criteria, array $orderBy = null)
 * @method ArticleVoiture[]    findAll()
 * @method ArticleVoiture[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ArticleVoitureRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ArticleVoiture::class);
    }

    public function save(ArticleVoiture $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(ArticleVoiture $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }
    public function getFavById($id): ?array {
        return $this->createQueryBuilder('f')
            ->innerJoin('f.users', 'u')
            ->where('u.id = :Users_id')
            ->setParameter(":Users_id", $id)
            ->getQuery()->getArrayResult();
    }

       public function findAllArticleVoitureByID($id): array
        {
        return $this->createQueryBuilder('a')
            ->andWhere('a.user = :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getResult()
            ;
        }
        
        public function findType($type)
        {
            return $this->createQueryBuilder('a')
                ->andWhere('a.Type = :id')
                ->setParameter('id', $type)
                ->getQuery()
                ->getResult()
                ;
        }

        public function findPrice($price)
        {
            return $this->createQueryBuilder('a')
            ->andWhere('a.price = :price')
            ->setParameter('price', $price)
            ->getQuery()
            ->getResult();
        }

        public function search($mots, $marque, $modele, $type, $transmission, $place, $energie) {
            $query = $this->createQueryBuilder('a');
            if($mots != null) {
                $query->andWhere('MATCH_AGAINST(a.title, a.description) AGAINST (:mots boolean)>0')
                ->setParameter('mots', $mots);
                
            }
            if($marque != null) {
                $query->leftJoin('a.marque', 'b');
                $query->andWhere('b.id = :mar')
                ->setParameter('mar', $marque);
            }
            if($modele != null) {
                $query->leftJoin('a.modele', 'c');
                $query->andWhere('c.id = :mod')
                ->setParameter('mod', $modele);
            }
            if($type != null) {
                $query->leftJoin('a.Type', 'd');
                $query->andWhere('d.id = :typ')
                ->setParameter('typ', $type);
            }
            if($transmission != null) {
                $query->leftJoin('a.transmission', 'e');
                $query->andWhere('e.id = :tran')
                ->setParameter('tran', $transmission);
            }
            if($place != null) {
                $query->leftJoin('a.Place', 'f');
                $query->andWhere('f.id = :nbr')
                ->setParameter('nbr', $place);
            }
            if($energie != null) {
                $query->leftJoin('a.Energie', 'g');
                $query->andWhere('g.id = :nrj')
                ->setParameter('nrj', $energie);
            }

            return $query->getQuery()->getResult();
        }

    
//    /**
//     * @return ArticleVoiture[] Returns an array of ArticleVoiture objects
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

//    public function findOneBySomeField($value): ?ArticleVoiture
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
