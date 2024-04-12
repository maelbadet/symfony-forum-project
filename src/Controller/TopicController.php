<?php
// src/Controller/TopicController.php

namespace App\Controller;

use App\Entity\Topic;
use App\Entity\Message;
use App\Form\TopicFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TopicController extends AbstractController
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/topics', name: 'topic_index')]
    public function index(): Response
    {
        $topics = $this->entityManager->getRepository(Topic::class)->findAll();

        return $this->render('topic/index.html.twig', [
            'topics' => $topics,
        ]);
    }


}
