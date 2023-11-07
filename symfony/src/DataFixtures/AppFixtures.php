<?php

namespace App\DataFixtures;

use App\Entity\Configuration\Configuration;
use App\Entity\Configuration\ConfigurationTranslation;
use App\Entity\Home\Home;
use App\Entity\Home\HomeTranslation;
use App\Entity\Project\Category;
use App\Entity\Project\CategoryTranslation;
use App\Entity\Project\Project;
use App\Entity\Project\ProjectImage;
use App\Entity\Project\ProjectTranslation;
use App\Entity\User\User;
use App\Entity\User\UserTranslation;
use App\Enum\LocaleEnum;
use App\Repository\CategoryRepository;
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

        $this->categories($manager);

        $manager->flush();

        $this->projects($manager);

        $manager->flush();
    }

    private function users(ObjectManager $manager): void
    {
        $data = [
            [
                'username' => 'astroi.id',
                'password' => 'azAZ12',
                'firstname' => 'Astrid',
                'lastname' => 'Anquetin',
                'email' => 'anquetin.astrid@gmail.com',
                'roles' => ['ROLE_ADMIN'],
                'image' => '/images/upload/ASTRID_WEB.jpg',
                'translations' => [
                    [
                        'data' => "<p>
                                En 2019, Astrid se penche sur le milieu de la BD lors de son mémoire d'Histoire et décide de faire un virage à 180° pour changer de voie.
                            </p>
                            <p>
                                Désormais étudiante en master de bande dessinée à l'ESA St Luc (Bruxelles), elle explore la forme du fanzine et s'amuse via l'objet à penser la bande dessinée toujours plus loin, équipée de son carnet de croquis et de sa tasse de thé. Toujours en quête de nouveaux médiums, elle définit peu à peu son univers empreint d'émotions.
                            </p>
                            <p>
                                Vélo : De course, pour filer entre les gouttes de pluie.
                            </p>",
                        'locale' => LocaleEnum::FR,
                    ],
                    [
                        'data' => '<p>In 2019, Astrid looks at the comic book world during her History thesis and decides to make a 180° turn to change her path.
                                </p>
                                <p>Now a master student in comics at ESA St Luc (Brussels), she explores the form of the fanzine and has fun via the object to think the comic book always further, equipped with her sketchbook and her cup of tea. Always in search of new mediums, she defines little by little her universe full of emotions.
                                </p>
                                <p>Bicycle: Racing, to spin between the raindrops.</p>',
                        'locale' => LocaleEnum::EN,
                    ],
                ],
            ],
            [
                'username' => 'williamchristophel',
                'password' => 'azAZ12',
                'firstname' => 'William',
                'lastname' => 'Christophel',
                'email' => 'christophel.will@gmail.com',
                'roles' => ['ROLE_ADMIN'],
                'image' => '/images/upload/WILL_WEB.jpg',
                'translations' => [
                    [
                        'data' => "<p>
                                Après avoir terminé ses études en graphisme publicitaire et motion design en alternance, William était un peu perdu une fois atterri dans le monde du travail . Il renoue avec l'illustration pour se conforter dans un style qui lui correspond et lui permet de le mêler au design graphique dans ses projets. Touche à tout et (trop) curieux, il s'étend également à l'animation, puis aux fanzines suite à sa rencontre avec Astrid.
                             </p>
                             <p>
                                Le cinéma et les BD contribuent grandement à son processus créatif, tout autant que les chocolats chauds et cookies à l'heure du goûter.
                             </p>
                             <p>
                                Vélo&nbsp;: Inchangé depuis le collège.
                             </p>",
                        'locale' => LocaleEnum::FR,
                    ],
                    [
                        'data' => '<p>After completing his studies in advertising graphics and motion design, William was a little lost once he landed in the working world. He returned to illustration to consolidate a style that suits him and allows him to mix it with graphic design in his projects. Touching everything and (too) curious, he also extends himself to animation, then to fanzines following his meeting with Astrid.
                                </p>
                                <p>Movies and comics contribute greatly to his creative process, as well as hot chocolates and cookies at snack time.
                                </p>
                                <p>Bicycle: Unchanged since high school.</p>',
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
            'image' => '/images/upload/Coolkids.png',
            'translations' => [
                [
                    'title' => 'Le Tandem Convergent',
                    'description' => 'Hello, nous sommes Astrid Anquetin et William Christophel, deux jeunes artistes ayant décidé de se mettre en selle pour ouvrir notre studio de graphisme et d’illustration entre Strasbourg et Bruxelles. On vous laisse découvrir nos travaux ici et là, et n’hésitez pas à nous contacter pour toute information si vous pédalez trop.',
                    'locale' => LocaleEnum::FR,
                ],
                [
                    'title' => 'Le Tandem Convergent',
                    'description' => 'Hello, we are Astrid Anquetin and William Christophel, two young artists who decided to open our graphic design and illustration studio between Strasbourg and Brussels. We let you discover our work here and there, and do not hesitate to contact us for any information if you pedal too much.',
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
                    'email' => 'collectif.tandem@gmail.com',
                    'city' => 'Strasbourg - Bruxelle',
                ],
                [
                    'locale' => LocaleEnum::EN,
                    'email' => 'collectif.tandem@gmail.com',
                    'city' => 'Strasbourg - Bruxelle',
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

    private function categories(ObjectManager $manager): void
    {
        $data = [
            [
                'order' => 0,
                'translations' => [
                    [
                        'locale' => LocaleEnum::FR,
                        'title' => 'Graphisme',
                    ],
                    [
                        'locale' => LocaleEnum::EN,
                        'title' => 'Graphic design',
                    ],
                ],
            ],
            [
                'order' => 1,
                'translations' => [
                    [
                        'locale' => LocaleEnum::FR,
                        'title' => 'Illustration',
                    ],
                    [
                        'locale' => LocaleEnum::EN,
                        'title' => 'Illustration',
                    ],
                ],
            ],
            [
                'order' => 2,
                'translations' => [
                    [
                        'locale' => LocaleEnum::FR,
                        'title' => 'Motion Design',
                    ],
                    [
                        'locale' => LocaleEnum::EN,
                        'title' => 'Motion Design',
                    ],
                ],
            ],
            [
                'order' => 3,
                'translations' => [
                    [
                        'locale' => LocaleEnum::FR,
                        'title' => 'BD & Zines',
                    ],
                    [
                        'locale' => LocaleEnum::EN,
                        'title' => 'Comics & fanzines',
                    ],
                ],
            ],
            [
                'order' => 3,
                'translations' => [
                    [
                        'locale' => LocaleEnum::FR,
                        'title' => 'Labo',
                    ],
                    [
                        'locale' => LocaleEnum::EN,
                        'title' => 'Labo',
                    ],
                ],
            ],
        ];

        /** @var array{order: int, translations: array{locale: LocaleEnum, title: string}} $row */
        foreach ($data as $row) {
            $category = new Category();

            $category->setOrder($row['order']);
            /** @var array{locale: LocaleEnum, title: string} $col */
            foreach ($row['translations'] as $col) {
                $trans = new CategoryTranslation($col['locale']);
                $trans->setTitle($col['title']);
                $manager->persist($trans);
                $category->addTranslation($trans);
            }

            $manager->persist($category);
        }
    }

    private function projects(ObjectManager $manager): void
    {
        /** @var CategoryRepository $categoryRepository */
        $categoryRepository = $manager->getRepository(Category::class);

        $data = [
            [
                'order' => 0,
                'highlight' => true,
                'category' => 'Graphisme',
                'translations' => [
                    [
                        'locale' => LocaleEnum::FR,
                        'title' => 'BRASSERIE DU GRILLEN',
                        'description' => 'Réalisation de divers supports graphiques pour la Brasserie du Grillen basée à Colmar, notament des étiquettes de bières éphmères, ainsi que l\'identité visuelle de leur événement anniversaire pour leurs trois ans. ',
                    ],
                    [
                        'locale' => LocaleEnum::EN,
                        'title' => 'BRASSERIE DU GRILLEN',
                        'description' => 'Realization of various graphic supports for the Brasserie du Grillen based in Colmar, in particular labels of ephemeral beers, as well as the visual identity of their anniversary event for their three years.',
                    ],
                ],
                'images' => [
                    [
                        'order' => 0,
                        'path' => '/images/upload/BIERE_QAR_WEB.jpg',
                    ],
                    [
                        'order' => 1,
                        'path' => '/images/upload/BIERE_CC_WEB.jpg',
                    ],
                    [
                        'order' => 2,
                        'path' => '/images/upload/GA_WEB.jpg',
                    ],
                ],
            ],
            [
                'order' => 1,
                'highlight' => true,
                'category' => 'Graphisme',
                'translations' => [
                    [
                        'locale' => LocaleEnum::FR,
                        'title' => 'SCHWENDI BIER UN WISTUB',
                        'description' => '',
                    ],
                    [
                        'locale' => LocaleEnum::EN,
                        'title' => 'SCHWENDI BIER UN WISTUB',
                        'description' => '',
                        ],
                ],
                'images' => [
                    [
                        'order' => 0,
                        'path' => '/images/upload/SCHWENDI01_WEB.jpg',
                    ],
                    [
                        'order' => 1,
                        'path' => '/images/upload/SCHWENDI02_WEB.jpg',
                    ],
                    [
                        'order' => 2,
                        'path' => '/images/upload/SCHWENDI03_WEB.jpg',
                    ],
                    [
                        'order' => 3,
                        'path' => '/images/upload/SCHWENDI04_WEB.jpg',
                    ],
                ],
            ],
            [
                'order' => 2,
                'highlight' => true,
                'category' => 'Illustration',
                'translations' => [
                    [
                        'locale' => LocaleEnum::FR,
                        'title' => 'ILLUSTRATIONS & PRINTS',
                        'description' => '',
                    ],
                    [
                        'locale' => LocaleEnum::EN,
                        'title' => 'ILLUSTRATIONS & PRINTS',
                        'description' => '',
                        ],
                ],
                'images' => [
                    [
                        'order' => 0,
                        'path' => '/images/upload/DRAW01_WEB.jpg',
                    ],
                    [
                        'order' => 1,
                        'path' => '/images/upload/DRAW02_WEB.jpg',
                    ],
                    [
                        'order' => 2,
                        'path' => '/images/upload/DRAW03_WEB.jpg',
                    ],
                    [
                        'order' => 3,
                        'path' => '/images/upload/DRAW04_WEB.jpg',
                    ],
                ],
            ],
            [
                'order' => 3,
                'highlight' => true,
                'category' => 'BD & Zines',
                'translations' => [
                    [
                        'locale' => LocaleEnum::FR,
                        'title' => 'FANZINE RISO POP-UP RÉSIDENCE DIMENSIONNELLE',
                        'description' => '',
                    ],
                    [
                        'locale' => LocaleEnum::EN,
                        'title' => 'FANZINE RISO POP-UP RÉSIDENCE DIMENSIONNELLE',
                        'description' => '',
                        ],
                ],
                'images' => [
                    [
                        'order' => 0,
                        'path' => '/images/upload/RD07_WEB.jpg',
                    ],
                    [
                        'order' => 1,
                        'path' => '/images/upload/RD04_WEB.jpg',
                    ],
                    [
                        'order' => 2,
                        'path' => '/images/upload/RD01_WEB.jpg',
                    ],
                ],
            ],
            [
                'order' => 4,
                'highlight' => true,
                'category' => 'Labo',
                'translations' => [
                    [
                        'locale' => LocaleEnum::FR,
                        'title' => 'AFFICHES ÉVÉNEMENTIELLES',
                        'description' => '',
                    ],
                    [
                        'locale' => LocaleEnum::EN,
                        'title' => 'AFFICHES ÉVÉNEMENTIELLES',
                        'description' => '',
                        ],
                ],
                'images' => [
                    [
                        'order' => 0,
                        'path' => '/images/upload/LINO_WEB.jpg',
                    ],
                    [
                        'order' => 1,
                        'path' => '/images/upload/TROLLEY_WEB.jpg',
                    ],
                    [
                        'order' => 2,
                        'path' => '/images/upload/MONTREUX_WEB.jpg',
                    ],
                    [
                        'order' => 3,
                        'path' => '/images/upload/DD_WEB.jpg',
                    ],
                ],
            ],
        ];
        /** @var array{order: int, highlight:bool, category: string, translations: array<array{locale: LocaleEnum, title: string, description: string}>, images: array<array{order: int, path: string}>} $row */
        foreach ($data as $row) {
            /** @var Category $cat */
            $cat = $categoryRepository->findOneByTitle(title: $row['category']);

            $project = new Project();
            $project->setOrder($row['order']);
            $project->setHighlight($row['highlight']);
            $project->setCategory($cat);

            /** @var array{locale: LocaleEnum, title: string, description: string} $rowTranslation */
            foreach ($row['translations'] as $rowTranslation) {
                $trans = new ProjectTranslation($rowTranslation['locale']);
                $trans->setTitle($rowTranslation['title']);
                $trans->setDescription($rowTranslation['description']);
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
