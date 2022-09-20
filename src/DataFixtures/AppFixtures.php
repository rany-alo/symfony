<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Users;
use DateTimeImmutable;
use App\Entity\Articles;
use App\Entity\Comments;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    public function __construct(
        private UserPasswordHasherInterface $passwordEncoder,
    ){}
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');

        for($i = 1; $i <= 10; $i++){
            $user = new Users();
            $article = new Articles();
            $comment = new Comments();
            $createdat = new DateTimeImmutable();

            $user->setEmail($faker->email);
            $user->setLastname($faker->lastName);
            $user->setFirstname($faker->firstName);
            $user->setRoles(['ROLE_USER']);
            $user->setPassword(
                $this->passwordEncoder->hashPassword($user, 'secret')
            );

            $article->setTitle($faker->sentence(4));
            $article->setArticle($faker->realText());
            $article->setCreatedAt($createdat);
            $article->setUser($user);

            $comment->setComment($faker->sentence());
            $comment->setUser($user);
            $comment->setCreatedAt($createdat);

            $comment->setArticle($article);

            $manager->persist($user);
            $manager->persist($article);
            $manager->persist($comment);
        }



        $manager->flush();
    }
}
