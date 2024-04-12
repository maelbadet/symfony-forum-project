<?php

namespace App\DataFixtures;

use App\Entity\Message;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class fixtures4 extends Fixture
{
    public function load(ObjectManager $manager): void
    {

        $users = $manager->getRepository(User::class)->findAll();

        foreach ($users as $user) {
            $numMessages = mt_rand(1, 5);
            for ($i = 0; $i < $numMessages; $i++) {
                $message = new Message();
                $message->setContent("coucou c'est moi");
                $message->setUserEntity($user);
                $manager->persist($message);
            }
        }
        $manager->flush();
    }
}
