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
use App\RolePlay\Entity\Adventure;
use App\RolePlay\Entity\AdventureImage;
use App\RolePlay\Entity\AdventureTranslation;
use App\RolePlay\Entity\Character;
use App\RolePlay\Entity\CharacterImage;
use App\RolePlay\Enum\ClasseType;
use App\RolePlay\Enum\RaceType;
use App\RolePlay\Enum\UniverseType;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class RolePlayFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $this->adventures($manager);

        $manager->flush();
    }

    private function adventures(ObjectManager $manager): void
    {
        $data = [
            [
                'start_at' => new DateTime('2023-11-11'),
                'end_at' => null,
                'type' => UniverseType::D_AND_D,
                'images' => [
                    '/images/upload/map_monde.jpg',
                    '/images/upload/village_Drachill.jpg',
                    '/images/upload/fortin2-S.jpg',
                    '/images/upload/ice_lake.png',
                    '/images/upload/doplrt.png',
                    '/images/upload/starbuk,.png',
                ],
                'translations' => [
                    [
                        'locale' => LocaleEnum::FR,
                        'title' => 'Le tombeau du roi serpent',
                        'description' => 'Un groupe de héros courageux doivent chercher l\'amulette du Roi serpent pour mettre fin à l\'avancé terrible des Nagas sur le royaume de Telrain.',
                        'intro' => 'intro',
                        'story' => 'story',
                        'end' => 'end',
                    ],
                    [
                        'locale' => LocaleEnum::EN,
                        'title' => 'The tomb of the serpent king',
                        'description' => 'A group of courageous heroes must seek out the Snake King\'s amulet to put an end to the Naga\'s terrible advance on the kingdom of Telrain.',
                        'intro' => 'intro',
                        'story' => 'story',
                        'end' => 'end',
                    ],
                ],
                'characters' => [
                    [
                        'name' => 'Eärendil Siderion',
                        'level' => 2,
                        'age' => 350,
                        'race' => RaceType::ELF,
                        'class' => ClasseType::WIZARD,
                        'images' => [
                            '/images/upload/es-1.png',
                            '/images/upload/es-6.png',
                            '/images/upload/es-2.png',
                            '/images/upload/es-3.png',
                            '/images/upload/es-7.png',
                            '/images/upload/es-4.png',
                            '/images/upload/es-5.png',
                        ],
                    ]
                ],
            ],
        ];
        foreach ($data as $row) {
            $adventure = new Adventure();

            $adventure->setStartAt($row['start_at']);
            $adventure->setEndAt($row['end_at']);
            $adventure->setUniverseType($row['type']);

            $manager->persist($adventure);


            foreach ($row['images'] as $path) {
                $adventureImage = new AdventureImage();
                $adventureImage->setImage($path);
                $manager->persist($adventureImage);

                $adventure->getImages()->add($adventureImage);
            }

            foreach ($row['translations'] as $data) {
                $translation = new AdventureTranslation($data['locale']);
                $translation->setTitle($data['title']);
                $translation->setDescription($data['description']);
                $translation->setIntro($data['intro']);
                $translation->setStory($data['story']);
                $translation->setEnd($data['end']);

                $manager->persist($translation);

                $adventure->getTranslations()->add($translation);
            }


            $manager->flush();

            foreach ($row['characters'] as $data) {
                $character = new Character();
                $character->setName($data['name']);
                $character->setLevel($data['level']);
                $character->setAge($data['age']);
                $character->setClassType($data['class']);
                $character->setRaceType($data['race']);


                $manager->persist($character);

                foreach ($data['images'] as $row) {
                    $img = new CharacterImage();
                    $img->setImage($row);

                    $manager->persist($img);

                    $character->getImages()->add($img);
                }


                $adventure->getCharacters()->add($character);
            }


        }

        $manager->flush();
    }
}
