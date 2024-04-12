<?php

namespace App\Controller;

use App\Entity\Topic;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class SearchbarController extends AbstractController
{

    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }
    #[Route('/search/results', name: 'app_search_results')]
    public function searchResults(Request $request): Response
    {
        $query = $request->query->get('query');
        $topics = $this->entityManager->getRepository(Topic::class)->findByTitleContaining($query);

        return $this->render('searchbar/results.html.twig', [
            'query' => $query,
            'results' => $topics,
        ]);
    }
}
