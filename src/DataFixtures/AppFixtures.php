<?php

namespace App\DataFixtures;

use App\Entity\Category;
use App\Entity\Image;
use App\Entity\Trick;
use App\Entity\User;
use App\Entity\Video;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    private UserPasswordHasherInterface $hasher;

    public function __construct(UserPasswordHasherInterface $hasher)
    {
        $this->hasher = $hasher;
    }

    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');

        // 1. UTILISATEUR TEST
        $user = new User();
        $user->setEmail('admin@snowtricks.com')
            ->setUsername('JimSnow')
            ->setIsVerified(true)
            ->setPassword($this->hasher->hashPassword($user, 'password'));
        $manager->persist($user);

        // 2. CATÉGORIES
        $categoriesNames = ['Grabs', 'Rotations', 'Flips', 'Slides', 'Old School'];
        $categories      = [];
        foreach ($categoriesNames as $name) {
            $category = new Category();
            $category->setName($name);
            $manager->persist($category);
            $categories[] = $category;
        }

        // 3. TRICKS
        for ($i = 0; $i < 15; $i++) {
            $trick = new Trick();
            $name  = $faker->unique()->sentence(2);
            $slug  = strtolower(str_replace([' ', '.'], '-', $name));

            $trick->setName($name)
                ->setSlug($slug)
                ->setDescription($faker->paragraphs(3, true))
                ->setCategory($categories[array_rand($categories)])
                ->setUser($user) // La relation qu'on vient d'ajouter !
                ->setCreatedAt(\DateTimeImmutable::createFromMutable($faker->dateTimeBetween('-1 month')));

            // AJOUT D'IMAGES (Fixtures)
            for ($j = 0; $j < 2; $j++) {
                $image = new Image();
                $image->setName('https://picsum.photos/seed/' . $faker->uuid . '/800/600');
                $trick->addImage($image);
                $manager->persist($image);
            }

            // AJOUT D'UNE VIDÉO
            $video = new Video();
            $video->setUrl('https://www.youtube.com/embed/dQw4w9WgXcQ'); // La classique !
            $trick->addVideo($video);
            $manager->persist($video);

            // 4. AJOUT DE COMMENTAIRES (3 à 5 par Trick)
            $numberOfComments = rand(3, 5);
            for ($k = 0; $k < $numberOfComments; $k++) {
                $comment = new \App\Entity\Comment();
                $comment->setContent($faker->sentence(12))
                    ->setUser($user) // JimSnow commente ses propres tricks pour l'instant
                    ->setTrick($trick)
                    ->setCreatedAt(\DateTimeImmutable::createFromMutable($faker->dateTimeBetween('-15 days')));

                $manager->persist($comment);
            }

            $manager->persist($trick);
        }

        $manager->flush();
    }
}
