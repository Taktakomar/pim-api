<?php

namespace App\Repository;

use App\Entity\FlowProtokoll;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<FlowProtokoll>
 *
 * @method FlowProtokoll|null find($id, $lockMode = null, $lockVersion = null)
 * @method FlowProtokoll|null findOneBy(array $criteria, array $orderBy = null)
 * @method FlowProtokoll[]    findAll()
 * @method FlowProtokoll[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FlowProtokollRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, FlowProtokoll::class);
    }

    public function add(FlowProtokoll $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(FlowProtokoll $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return FlowProtokoll[] Returns an array of FlowProtokoll objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('f')
//            ->andWhere('f.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('f.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?FlowProtokoll
//    {
//        return $this->createQueryBuilder('f')
//            ->andWhere('f.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
