<?php

namespace App\Repository;

use App\Entity\Breeder;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Breeder>
 *
 * @method Breeder|null find($id, $lockMode = null, $lockVersion = null)
 * @method Breeder|null findOneBy(array $criteria, array $orderBy = null)
 * @method Breeder[]    findAll()
 * @method Breeder[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BreederRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Breeder::class);
    }

    public function save(Breeder $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Breeder $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function findForHome(): array
    {
        return $this->createQueryBuilder('b')
        ->select([
            'b',
        ])
            ->leftJoin('b.offers', 'o')
            ->orderBy('o.updatedTime', 'DESC')
            // ->groupBy('b.id')
            ->getQuery()
            ->getResult()
        ;
    }
}
