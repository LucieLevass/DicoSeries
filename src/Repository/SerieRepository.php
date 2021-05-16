<?php

namespace App\Repository;

use App\Entity\Serie;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Serie|null find($id, $lockMode = null, $lockVersion = null)
 * @method Serie|null findOneBy(array $criteria, array $orderBy = null)
 * @method Serie[]    findAll()
 * @method Serie[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SerieRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Serie::class);
    }

    public function findAllOrder(){
      return $this->createQueryBuilder('s')
                  ->orderBy('s.titreVF', 'ASC')
                  ->getQuery()
                  ->getResult();
    }

    public function search($search){
      return $this->createQueryBuilder('s')
                  ->andWhere('s.titreVF LIKE :val')
                  ->orWhere('s.titreVO LIKE :val')
                  ->setParameter('val', '%'.$search.'%')
                  ->getQuery()
                  ->execute();
    }

    public function findByStatusId($statusId){
      return $this->createQueryBuilder('s')
                  ->andWhere('s.status = :val')
                  ->setParameter('val', $statusId)
                  ->orderBy('s.titreVF', 'ASC')
                  ->getQuery()
                  ->getResult();
    }

    public function findByPaysId($paysId){
      return $this->createQueryBuilder('s')
                  ->andWhere('s.pays = :val')
                  ->setParameter('val', $paysId)
                  ->orderBy('s.titreVF', 'ASC')
                  ->getQuery()
                  ->getResult();
    }

    public function findByGenreId($genreId){
      return $this->createQueryBuilder('s')
                  ->join('s.genres', 'g')
                  ->addSelect('g')
                  ->where('g.id = :val')
                  ->setParameter('val', $genreId)
                  ->orderBy('s.titreVF', 'ASC')
                  ->getQuery()
                  ->getResult();
    }

    // /**
    //  * @return Serie[] Returns an array of Serie objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Serie
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
