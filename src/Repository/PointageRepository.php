<?php

namespace App\Repository;

use App\Entity\Pointage;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Pointage|null find($id, $lockMode = null, $lockVersion = null)
 * @method Pointage|null findOneBy(array $criteria, array $orderBy = null)
 * @method Pointage[]    findAll()
 * @method Pointage[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PointageRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Pointage::class);
    }


    /**
     *  Return la somme des durré d'un user à partir du matricule imat
     */
    public function SommeTime($imat)
    {

        $qb = $this->createQueryBuilder('o');

        $qb->select('SUM(o.time1) AS total')
            ->where('o.user= :imat ')
            ->setParameter('imat', $imat)
            ;
        return $qb->getQuery()->getSingleScalarResult();
    }
}
