<?php

namespace App\Repository;

use App\Entity\Project\Category;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Category>
 *
 * @method Category|null find($id, $lockMode = null, $lockVersion = null)
 * @method Category|null findOneBy(array $criteria, array $orderBy = null)
 * @method Category[]    findAll()
 * @method Category[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CategoryRepository extends ServiceEntityRepository
{
    use RepositoryTrait;

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Category::class);
    }

    public function findOneByTitle(string $title, ?string $locale = null): ?Category
    {
        $qb = $this->createQueryBuilder('c')
            ->innerJoin('c.translations', 'ct')
            ->andWhere('ct.title = :title')
            ->setParameter('title', $title);

        if (null !== $locale) {
            $qb
                ->andWhere('ct.locale = :locale')
                ->setParameter('locale', $title);
        }

        /** @var Category|null $res */
        $res = $qb->setMaxResults(1)
            ->getQuery()
            ->getOneOrNullResult();

        return $res;
    }
}
