<?php

namespace App\Repository;

use App\Entity\Announcement;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<announcement>
 *
 * @method announcement|null find($id, $lockMode = null, $lockVersion = null)
 * @method announcement|null findOneBy(array $criteria, array $orderBy = null)
 * @method announcement[]    findAll()
 * @method announcement[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AnnouncementRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, announcement::class);
    }

    public function save(announcement $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(announcement $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    /**
     * @return Announcement[] Returns an array of Anoucement objects
     */
    //QUERY BULDER FUNCTION does not need settings in repository, instead, do it in controller
    public function showAnnouncementList(): array
    {
        return $this->createQueryBuilder('a')
            ->select([
                'a',
            ])
            ->orderBy('a.dateannouncement', 'DESC')
            ->setMaxResults(5)
            ->getQuery()
            ->getResult()
        ;
    }

    //    public function findOneBySomeField($value): ?Anoucement
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}