<?php

namespace App\DataFixtures;

use App\Admin\Entity\Article\Article;
use App\Admin\Entity\Article\ArticleImage;
use App\Admin\Entity\Article\ArticleTranslation;
use App\Admin\Entity\Configuration\Configuration;
use App\Admin\Entity\Configuration\ConfigurationTranslation;
use App\Admin\Entity\Home\Home;
use App\Admin\Entity\Home\HomeTranslation;
use App\Admin\Entity\Project\Project;
use App\Admin\Entity\Project\ProjectImage;
use App\Admin\Entity\Project\ProjectTranslation;
use App\Admin\Entity\User\User;
use App\Admin\Entity\User\UserTranslation;
use App\Admin\Enum\LocaleEnum;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    public function __construct(readonly private UserPasswordHasherInterface $hasher)
    {
    }

    public function load(ObjectManager $manager): void
    {
        $this->users($manager);

        $this->home($manager);

        $this->configuration($manager);

        $this->articles($manager);

        $manager->flush();

        $this->projects($manager);

        $manager->flush();
    }

    private function users(ObjectManager $manager): void
    {
        $data = [
            [
                'username' => 'iflashblue',
                'password' => 'N7345219n*',
                'firstname' => 'Nathanaël',
                'lastname' => 'Schmitt',
                'email' => 'schmittnathanael@gmail.com',
                'roles' => ['ROLE_ADMIN'],
                'image' => '/images/upload/nath.jpg',
                'translations' => [
                    [
                        'data' => "<p>Developpeur , par passion.</p>",
                        'locale' => LocaleEnum::FR,
                    ],
                    [
                        'data' => '<p>Developer by passion.</p>',
                        'locale' => LocaleEnum::EN,
                    ],
                ],
            ],
        ];

        /** @var array{email: string, translations: array<int, array{locale: LocaleEnum, data: string}>,username: string, password: string, firstname: string, lastname: string, roles: array<string>, image: string} $row */
        foreach ($data as $row) {
            $user = new User();

            $user->setFirstname($row['firstname']);
            $user->setLastname($row['lastname']);
            $user->setImage($row['image']);
            $user->setUsername($row['username']);
            $user->setEmail($row['email']);
            $user->setRoles($row['roles']);
            // password
            $password = $this->hasher->hashPassword($user, $row['password']);
            $user->setPassword($password);

            $manager->persist($user);
            $manager->flush();

            foreach ($row['translations'] as $data) {
                $translation = new UserTranslation($data['locale']);
                $translation->setDescription($data['data']);

                $user->addTranslation($translation);
            }

            $manager->persist($user);
        }
    }

    private function home(ObjectManager $manager): void
    {
        $data = [
            'image' => '/images/logo.svg',
            'translations' => [
                [
                    'title' => 'Bienvenue',
                    'description' => '<p>Ce site web est une base de connaissances et un portfolio.</p>',
                    'locale' => LocaleEnum::FR,
                ],
                [
                    'title' => 'Welcome',
                    'description' => '<p>This website is a knowledge base and a portfolio.</p>',
                    'locale' => LocaleEnum::EN,
                ],
            ],
        ];

        $home = new Home();

        $home->setImage($data['image']);

        /** @var array{locale: LocaleEnum, description: string, title:string} $translation */
        foreach ($data['translations'] as $translation) {
            $trans = new HomeTranslation($translation['locale']);

            $trans->setDescription($translation['description']);
            $trans->setTitle($translation['title']);

            $home->addTranslation($trans);
        }

        $manager->persist($home);
    }

    private function configuration(ObjectManager $manager): void
    {
        $data = [
            'translations' => [
                [
                    'locale' => LocaleEnum::FR,
                    'email' => '@gmail.com',
                    'city' => 'Paris',
                ],
                [
                    'locale' => LocaleEnum::EN,
                    'email' => '@gmail.com',
                    'city' => 'Paris',
                ],
            ],
        ];

        $configuration = new Configuration();

        /** @var array{locale: LocaleEnum, email: string, city: string} $row */
        foreach ($data['translations'] as $row) {
            $trans = new ConfigurationTranslation($row['locale']);
            $trans->setCity($row['city']);
            $trans->setEmail($row['email']);

            $manager->persist($trans);

            $configuration->addTranslation($trans);
        }

        $manager->persist($configuration);
    }

    private function articles(ObjectManager $manager): void
    {
        $data = [
            [
                'order' => 0,
                'highlight' => true,
                'translations' => [
                    [
                        'locale' => LocaleEnum::FR,
                        'title' => 'Vertex',
                        'tags' => ['IA', 'Google'],
                        'description' => 'Vertex connecteurs.',
                    ],
                    [
                        'locale' => LocaleEnum::EN,
                        'title' => 'Vertex',
                        'tags' => ['IA', 'Google'],
                        'description' => 'Vertex connectors.',
                    ],
                ],
                'images' => [
                    [
                        'order' => 0,
                        'path' => '/images/upload/vertex.png',
                    ],
                ],
            ],
        ];
        /** @var array{order: int, highlight:bool, category: string, translations: array, images: array} $row */
        foreach ($data as $row) {
            $article = new Article();
            $article->setOrder($row['order']);
            $article->setHighlight($row['highlight']);

            /** @var array{locale: LocaleEnum, title: string, description: string, tags: string[]} $rowTranslation */
            foreach ($row['translations'] as $rowTranslation) {
                $trans = new ArticleTranslation($rowTranslation['locale']);
                $trans->setTitle($rowTranslation['title']);
                $trans->setTags($rowTranslation['tags']);
                $trans->setDescription($rowTranslation['description']);
                $article->addTranslation($trans);
            }
            /** @var array{order: int, path: string} $rowImage */
            foreach ($row['images'] as $rowImage) {
                $image = new ArticleImage();
                $image->setImage($rowImage['path']);
                $image->setOrder($rowImage['order']);

                $article->getImages()->add($image);
            }

            $manager->persist($article);
        }
    }

    private function projects(ObjectManager $manager): void
    {
        $data = [
            [
                'order' => 0,
                'highlight' => true,
                'translations' => [
                    [
                        'locale' => LocaleEnum::FR,
                        'title' => 'Le Tandem Convergent',
                        'url' => 'https://www.tandemconvergent.com/',
                        'description' => 'Studio de graphisme d\'Astrid Anquetin et William Christophel ',
                    ],
                    [
                        'locale' => LocaleEnum::EN,
                        'title' => 'Le Tandem Convergent',
                        'url' => 'https://www.tandemconvergent.com/',
                        'description' => 'Graphic design studio of Astrid Anquetin and William Christophel.',
                    ],
                ],
                'images' => [
                    [
                        'order' => 0,
                        'path' => '/images/Coolkids.png',
                    ],
                ],
            ],
        ];
        /** @var array{order: int, highlight:bool, category: string, translations: array, images: array} $row */
        foreach ($data as $row) {
            $project = new Project();
            $project->setOrder($row['order']);
            $project->setHighlight($row['highlight']);

            /** @var array{locale: LocaleEnum, title: string, description: string, url: string} $rowTranslation */
            foreach ($row['translations'] as $rowTranslation) {
                $trans = new ProjectTranslation($rowTranslation['locale']);
                $trans->setTitle($rowTranslation['title']);
                $trans->setDescription($rowTranslation['description']);
                $trans->setUrl($rowTranslation['url']);
                $project->addTranslation($trans);
            }
            /** @var array{order: int, path: string} $rowImage */
            foreach ($row['images'] as $rowImage) {
                $image = new ProjectImage();
                $image->setImage($rowImage['path']);
                $image->setOrder($rowImage['order']);

                $project->getImages()->add($image);
            }

            $manager->persist($project);
        }
    }
}
