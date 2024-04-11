<?php

namespace App\Controller;

use App\Entity\Category;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class CategoryController extends AbstractController
{
    private ManagerRegistry $doctrine;

    public function __construct(ManagerRegistry $doctrine)
    {
        $this->doctrine = $doctrine;
    }

    #[Route('/category', name: 'app_category')]
    public function index(): Response
    {
        $category = $this->doctrine->getRepository(Category::class)->findAll();
        return $this->render('category/index.html.twig', [
            'controller_name' => 'CategoryController',
            'category' => $category,
        ]);
    }

    #[Route('/category/{id}', name: 'app_category_show')]
    public function showBoard(Category $category): Response
    {
        $boards = $category->getBoards();

        return $this->render('category/show_board.html.twig', [
            'category' => $category,
            'boards' => $boards,
        ]);
    }

}
