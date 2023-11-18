<?php

namespace App\RolePlay\Repository;

use App\Admin\Repository\RepositoryTrait;
use App\RolePlay\Entity\Adventure;
use App\RolePlay\Entity\Character;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Adventure>
 *
 * @method Adventure|null find($id, $lockMode = null, $lockVersion = null)
 * @method Adventure|null findOneBy(array $criteria, array $orderBy = null)
 * @method Adventure[]    findAll()
 * @method Adventure[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AdventureRepository extends ServiceEntityRepository
{
    use RepositoryTrait;

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Adventure::class);
    }

    public function findOneByCharacter(Character $character): Adventure|null
    {
        $res =  $this->createQueryBuilder('a')
            ->leftJoin('a.characters', 'c')
            ->andWhere('c = :character')
            ->setParameter('character', $character)
            ->getQuery()->getResult();


        return $res[0] ?? null;
    }
}
