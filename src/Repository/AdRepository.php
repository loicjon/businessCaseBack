<?php

namespace App\Repository;

use App\Entity\Ad;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Ad|null find($id, $lockMode = null, $lockVersion = null)
 * @method Ad|null findOneBy(array $criteria, array $orderBy = null)
 * @method Ad[]    findAll()
 * @method Ad[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AdRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Ad::class);
    }


    // /**
    //  * @return Ad|null
    // * @throws \Doctrine\ORM\NonUniqueResultException
    //   */
    /*
    public function findWithRelations(int $id): ?Ad
    {
        $qb = $this->createQueryBuilder('a');

        $qb->where('a.id = :id')
            ->setParameter('id', $id);

        $qb->leftJoin('a.garage', 'g')
            ->addSelect('g')
        ;

        $qb->leftJoin('a.model', 'm')
            ->addSelect('m')
        ;

        $qb->leftJoin('a.fuel', 'f')
            ->addSelect('f')
        ;

        $qb->leftJoin('a.brand', 'b')
            ->addSelect('b')
        ;

        return $qb->getQuery()->getOneOrNullResult();
    }
    */

    // /**
    //  * @return Ad[] Returns an array of Ad objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Ad
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
