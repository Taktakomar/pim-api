<?php

namespace App\Repository;

use App\Entity\VerbindungenArten;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<VerbindungenArten>
 *
 * @method VerbindungenArten|null find($id, $lockMode = null, $lockVersion = null)
 * @method VerbindungenArten|null findOneBy(array $criteria, array $orderBy = null)
 * @method VerbindungenArten[]    findAll()
 * @method VerbindungenArten[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VerbindungenArtenRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, VerbindungenArten::class);
    }

    public function add(VerbindungenArten $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(VerbindungenArten $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return VerbindungenArten[] Returns an array of VerbindungenArten objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('v')
//            ->andWhere('v.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('v.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?VerbindungenArten
//    {
//        return $this->createQueryBuilder('v')
//            ->andWhere('v.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
