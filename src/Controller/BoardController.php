<?php

namespace App\Controller;

use App\Entity\Board;
use App\Form\NewBoardType;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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
            'board' => $board,
        ]);
    }

    #[Route('/board/{id}', name: 'app_board_show_topic')]
    public function showTopic(Board $board): Response
    {
        $topic = $board->getTopics();
        return $this->render('board/show_topics.html.twig', [
            'board' => $board,
            'topics' => $topic,
        ]);
    }

    #[Route('/create/board', name: 'app_board_new')]
    public function newBoard(EntityManagerInterface $entityManager, Request $request): Response
    {
        $board = new Board();
        $form = $this->createForm(newBoardType::class, $board);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $boardName = $board->getName();
            $existingBoard = $entityManager->getRepository(Board::class)->findOneBy(['name' => $boardName]);
            if ($existingBoard) {
                $this->addFlash('danger', 'La catégorie existe déjà.');
                return $this->redirectToRoute('app_board');
            }
            $entityManager->persist($board);
            $entityManager->flush();
            return $this->redirectToRoute('app_board');
        }
        return $this->render('category/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
