<?php

namespace App\Controller;

use App\Entity\Board;
use App\Repository\BoardRepository;
use App\Repository\CategoryRepository;
use Symfony\Bridge\Doctrine\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(BoardRepository $boardRepository, CategoryRepository $categoryRepository): Response
    {
        $boards = $boardRepository->findRandom10();
        $categories = $categoryRepository->findTop20CategoriesByBoardCount();
        return $this->render('home/index.html.twig', [
            'boards' => $boards,
            'categories' => $categories,
        ]);
    }
}