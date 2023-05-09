<?php

namespace App\Repository;

use App\Entity\Symfonyproject;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Symfonyproject>
 *
 * @method Symfonyproject|null find($id, $lockMode = null, $lockVersion = null)
 * @method Symfonyproject|null findOneBy(array $criteria, array $orderBy = null)
 * @method Symfonyproject[]    findAll()
 * @method Symfonyproject[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SymfonyprojectRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Symfonyproject::class);
    }

    public function save(Symfonyproject $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Symfonyproject $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return Symfonyproject[] Returns an array of Symfonyproject objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('s.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Symfonyproject
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
