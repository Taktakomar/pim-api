<?php

namespace App\Repository;

use App\Entity\ArtikelDefintionen;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ArtikelDefintionen>
 *
 * @method ArtikelDefintionen|null find($id, $lockMode = null, $lockVersion = null)
 * @method ArtikelDefintionen|null findOneBy(array $criteria, array $orderBy = null)
 * @method ArtikelDefintionen[]    findAll()
 * @method ArtikelDefintionen[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ArtikelDefintionenRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ArtikelDefintionen::class);
    }

    public function add(ArtikelDefintionen $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(ArtikelDefintionen $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return ArtikelDefintionen[] Returns an array of ArtikelDefintionen objects
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

//    public function findOneBySomeField($value): ?ArtikelDefintionen
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
