<?php

namespace App\Repository;

use App\Entity\Genre;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Genre|null find($id, $lockMode = null, $lockVersion = null)
 * @method Genre|null findOneBy(array $criteria, array $orderBy = null)
 * @method Genre[]    findAll()
 * @method Genre[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GenreRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Genre::class);
    }


    /**
     * Recherche tous les genres
     */
    public function findAllGenre(){
        return $this->createQueryBuilder('g')
            ->andWhere('g.subgenre_name IS NULL')
            ->orderBy('g.genre_name', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    }

     /**
     * Recherche tous les SOUS genres
     */
    public function findAllSubGenre(){
        return $this->createQueryBuilder('g')
            ->andWhere('g.subgenre_name IS NOT NULL')
            ->orderBy('g.genre_name', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    }


    

    // /**
    //  * @return Genre[] Returns an array of Genre objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('g.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Genre
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
