<?php

namespace App\Repository;

use App\Entity\SponsorType;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method SponsorType|null find($id, $lockMode = null, $lockVersion = null)
 * @method SponsorType|null findOneBy(array $criteria, array $orderBy = null)
 * @method SponsorType[]    findAll()
 * @method SponsorType[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SponsorTypeRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, SponsorType::class);
    }

    /*
    public function findBySomething($value)
    {
        return $this->createQueryBuilder('s')
            ->where('s.something = :value')->setParameter('value', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */
}
