<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class fixtures0 extends Fixture
{
    public function load(ObjectManager $manager)
    {
        for ($i = 1; $i <= 10; $i++) {
            $category = new User();
            $category->setEmail('emailFixture' . $i . '@gmail.com');
            $category->setUsername('fixt'. $i);
            $category->setRoles(["ROLE_USER"]);
            $category->setPassword('$pass'.$i);
            $manager->persist($category);
        }

        $manager->flush();
    }
}
