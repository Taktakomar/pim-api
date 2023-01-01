<?php

namespace App\Repository;

use App\Entity\KundenDefintionen;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<KundenDefintionen>
 *
 * @method KundenDefintionen|null find($id, $lockMode = null, $lockVersion = null)
 * @method KundenDefintionen|null findOneBy(array $criteria, array $orderBy = null)
 * @method KundenDefintionen[]    findAll()
 * @method KundenDefintionen[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class KundenDefintionenRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, KundenDefintionen::class);
    }

    public function add(KundenDefintionen $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(KundenDefintionen $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return KundenDefintionen[] Returns an array of KundenDefintionen objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('k')
//            ->andWhere('k.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('k.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?KundenDefintionen
//    {
//        return $this->createQueryBuilder('k')
//            ->andWhere('k.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
