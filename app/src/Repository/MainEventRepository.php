<?php

namespace App\Repository;

use App\Entity\MainEvent;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method MainEvent|null find($id, $lockMode = null, $lockVersion = null)
 * @method MainEvent|null findOneBy(array $criteria, array $orderBy = null)
 * @method MainEvent[]    findAll()
 * @method MainEvent[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MainEventRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, MainEvent::class);
    }

    /*
    public function findBySomething($value)
    {
        return $this->createQueryBuilder('m')
            ->where('m.something = :value')->setParameter('value', $value)
            ->orderBy('m.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */
}
