<?php

namespace App\Repository;

use App\Entity\RelatedProducts;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method RelatedProducts|null find($id, $lockMode = null, $lockVersion = null)
 * @method RelatedProducts|null findOneBy(array $criteria, array $orderBy = null)
 * @method RelatedProducts[]    findAll()
 * @method RelatedProducts[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RelatedProductsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, RelatedProducts::class);
    }

    // /**
    //  * @return RelatedProducts[] Returns an array of RelatedProducts objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('r.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?RelatedProducts
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
