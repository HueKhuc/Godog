<?php

namespace App\Repository;

use App\Entity\Announcement;
use App\Form\Filter\AnnouncementsFilter;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Announcement>
 *
 * @method Announcement|null find($id, $lockMode = null, $lockVersion = null)
 * @method Announcement|null findOneBy(array $criteria, array $orderBy = null)
 * @method Announcement[]    findAll()
 * @method Announcement[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AnnouncementRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Announcement::class);
    }

    public function save(Announcement $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Announcement $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    /**
     * @return Announcement[] Returns an array of Anoucement objects
     */
    // QUERY BULDER FUNCTION does not need settings in repository, instead, do it in controller
    public function showAnnouncementList(): array
    {
        return $this->createQueryBuilder('a')
            ->select(['a'])
            ->orderBy('a.dateAnnouncement', 'DESC')
            ->setMaxResults(5)
            ->getQuery()
            ->getResult()
        ;
    }

    public function findByFilter(AnnouncementsFilter $filter): array
    {
        $qb = $this->createQueryBuilder('a')
            ->leftJoin('a.dogs', 'd');

        if (!is_null($filter->getRace())) {
            $qb
                ->innerJoin('d.races', 'r')
                ->andWhere('r.id = :race')
                ->setParameter('race', $filter->getRace()->getId());
        }

        if ($filter->getIsLof()) {
            $qb
                ->andWhere('d.isLof = :lof')
                ->setParameter('lof', $filter->getIsLof());
        }

        return $qb
            ->getQuery()
            ->getResult()
        ;
    }

    // public function findOneById($value): ?Announcement
    // {
    //     return $this->createQueryBuilder('a')
    //      ->innerJoin('a.breeder', 'b')
    //      ->andWhere('a.id = :val')
    //      ->setParameter('val', $value)
    //      ->getQuery()
    //      ->getOneOrNullResult()
    //     ;
    // }
}
