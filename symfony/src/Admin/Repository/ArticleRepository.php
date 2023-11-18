<?php

namespace App\Admin\Repository;

use App\Admin\Entity\Article\Article;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Article>
 *
 * @method Article|null find($id, $lockMode = null, $lockVersion = null)
 * @method Article|null findOneBy(array $criteria, array $orderBy = null)
 * @method Article[]    findAll()
 * @method Article[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ArticleRepository extends ServiceEntityRepository
{
    use RepositoryTrait;

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Article::class);
    }

    public function findOneBySlugAndLocale(string $slug, ?string $locale = null): ?Article
    {
        $qb = $this->createQueryBuilder('p')
            ->innerJoin('p.translations', 'pt');

        if (null !== $locale) {
            $qb->andWhere('pt.locale = :locale')
                ->setParameter('locale', $locale);
        }

        $qb->andWhere('pt.slug = :slug')
            ->setParameter('slug', $slug);

        /** @var Article|null $res */
        $res = $qb
            ->setMaxResults(1)
            ->getQuery()
            ->getOneOrNullResult();

        return $res;
    }
}
