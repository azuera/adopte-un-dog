<?php

namespace App\Repository;

use App\Entity\Offer;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Offer>
 *
 * @method Offer|null find($id, $lockMode = null, $lockVersion = null)
 * @method Offer|null findOneBy(array $criteria, array $orderBy = null)
 * @method Offer[]    findAll()
 * @method Offer[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OfferRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Offer::class);
    }

    public function save(Offer $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Offer $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function findOffers():QueryBuilder
    {
        return $this->createQueryBuilder('o')
        ->select([
            'o',
        ])
            ->leftJoin('o.dogs', 'd')
            ->leftJoin('d.breeds', 'b')
            ->leftJoin('d.images', 'i')
            ->andWhere('o.isClosed = false')
            ->groupBy('o.id')
            ->orderBy('o.updatedTime', 'DESC')
            ;
    }
    public function findForHome():array
    {
        return $this->findOffers()
            ->setMaxResults(5)
            ->getQuery()
            ->getResult()
        ;
    }
}
