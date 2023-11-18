<?php

namespace App\Admin\Repository;

use App\Admin\Entity\Project\Project;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Project>
 *
 * @method Project|null find($id, $lockMode = null, $lockVersion = null)
 * @method Project|null findOneBy(array $criteria, array $orderBy = null)
 * @method Project[]    findAll()
 * @method Project[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProjectRepository extends ServiceEntityRepository
{
    use RepositoryTrait;

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Project::class);
    }

    public function findOneBySlugAndLocale(string $slug, ?string $locale = null): ?Project
    {
        $qb = $this->createQueryBuilder('p')
            ->innerJoin('p.translations', 'pt');

        if (null !== $locale) {
            $qb->andWhere('pt.locale = :locale')
                ->setParameter('locale', $locale);
        }

        $qb->andWhere('pt.slug = :slug')
            ->setParameter('slug', $slug);

        /** @var Project|null $res */
        $res = $qb
            ->setMaxResults(1)
            ->getQuery()
            ->getOneOrNullResult();

        return $res;
    }
}
