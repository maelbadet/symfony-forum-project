<?php

namespace App\DataFixtures;

use App\Entity\Topic;
use App\Entity\Board; // Assurez-vous d'importer la classe Board
use App\Entity\User; // Assurez-vous d'importer la classe User
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class fixtures3 extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $boards = $manager->getRepository(Board::class)->findAll();

        $users = $manager->getRepository(User::class)->findAll();

        foreach ($boards as $board) {
            $topic = new Topic();
            $topic->setTitle("Je suis un titre");
            $topic->setContent("je suis une description");
            $topic->setCreatedAt(new \DateTime());
            $topic->setBoard($board);

            $randomUserKey = array_rand($users);
            $randomUser = $users[$randomUserKey];
            $topic->setUserEntity($randomUser);

            $manager->persist($topic);
        }

        $manager->flush();
    }
}
