<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Entity\Topic;
use App\Entity\Message;
use Doctrine\Persistence\ManagerRegistry;

class TopicController extends AbstractController
{
    private ManagerRegistry $doctrine;

    public function __construct(ManagerRegistry $doctrine)
    {
        $this->doctrine = $doctrine;
    }

    #[Route('/topics', name: 'topic_index')]
    public function index(): Response
    {
        $topics = $this->doctrine->getRepository(Topic::class)->findAll();

        return $this->render('topic/index.html.twig', [
            'topics' => $topics,
        ]);
    }

    #[Route('/topic/{id}', name: 'topic_show')]
    public function show(Topic $topic): Response
    {
        return $this->render('topic/show.html.twig', [
            'topic' => $topic,
        ]);
    }

    #[Route('/create-topic-with-messages', name: 'create_topic_with_messages')]
    public function createTopicWithMessages(EntityManagerInterface $entityManager): Response
    {
        
        $topic = new Topic();
        $topic->setTitle("Titre du sujet");
        $topic->setContent("Contenu du sujet");
        $topic->setCreatedAt(new \DateTime());
        $topic->setUpdatedAt(new \DateTime());
        $topic->setDeletedAt(new \DateTime());
        
        $message1 = new Message();
        $message1->setContent("Premier message");
        $message2 = new Message();
        $message2->setContent("Deuxième message");

        $topic->addMessage($message1);
        $topic->addMessage($message2);

        $entityManager->persist($topic);
        $entityManager->flush();

        return new Response("Sujet créé avec des messages.");
    }
}