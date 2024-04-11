<?php

namespace App\Controller;

use App\Entity\Board;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class BoardController extends AbstractController
{
    private ManagerRegistry $doctrine;

    public function __construct(ManagerRegistry $doctrine)
    {
        $this->doctrine = $doctrine;
    }

    #[Route('/board', name: 'app_board')]
    public function index(): Response
    {
        $board = $this->doctrine->getRepository(Board::class)->findAll();
        return $this->render('board/index.html.twig', [
            'controller_name' => 'BoardController',
            'board' => $board,
        ]);
    }

    #[Route('/board/{id}', name: 'app_board')]
    public function showTopic(Board $board): Response
    {
        $topic = $board->getTopics();
        return $this->render('board/show_topics.html.twig', [
            'board' => $board,
            'topics' => $topic,
        ]);
    }
}
