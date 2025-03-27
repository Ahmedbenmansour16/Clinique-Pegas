<?php

namespace App\Repository;

use App\Entity\Cheval;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Cheval>
 *
 * @method Cheval|null find($id, $lockMode = null, $lockVersion = null)
 * @method Cheval|null findOneBy(array $criteria, array $orderBy = null)
 * @method Cheval[]    findAll()
 * @method Cheval[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ChevalRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Cheval::class);
    }


}
