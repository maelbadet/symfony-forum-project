<?php

namespace App\DataFixtures;

use App\Entity\Board;
use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class fixtures1 extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $boardcpt = 1;
        // Créer et persister les catégories
        $categories = [];
        for ($i = 1; $i <= 10; $i++) {
            $category = new Category();
            $category->setName('Category ' . $i);
            $category->setRoleAccess('["ROLE_USER"]');
            $manager->persist($category);
            $categories[] = $category;
        }

        // Créer et persister les boards
        foreach ($categories as $category) {
            $board = new Board();
            $board->setName('Board ' . $boardcpt);
            $manager->persist($board);
            $category->addBoard($board);
            $boardcpt ++;
        }

        $manager->flush();
    }
}
