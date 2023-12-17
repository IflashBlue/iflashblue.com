<?php

namespace App\RolePlay\Repository;

use App\Admin\Repository\RepositoryTrait;
use App\RolePlay\Entity\CharacterAttribute;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<CharacterAttribute>
 *
 * @method CharacterAttribute|null find($id, $lockMode = null, $lockVersion = null)
 * @method CharacterAttribute|null findOneBy(array $criteria, array $orderBy = null)
 * @method CharacterAttribute[]    findAll()
 * @method CharacterAttribute[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CharacterAttributeRepository extends ServiceEntityRepository
{
    use RepositoryTrait;

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CharacterAttribute::class);
    }
}
