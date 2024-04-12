<?php
// src/Controller/TopicController.php

namespace App\Controller;

use App\Entity\Board;
use App\Entity\Topic;
use App\Entity\Message;
use App\Form\MessageFormType;
use App\Form\NewTopicType;
use DateTime;
use DateTimeZone;
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

    #[Route('/topics/{id}', name: 'topic_show')]
    public function show(Topic $topic, EntityManagerInterface $entityManager, Request $request): Response
    {
        $message = new Message();
        $message->getUserEntity($this->getUser());
        $form = $this->createForm(MessageFormType::class, $message);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $message->setTopic($topic);
            $message->setUserEntity($this->getUser());
            $dateTimeParis = new DateTime('now', new DateTimeZone('Europe/Paris'));
            $message->setCreatedAt($dateTimeParis);
            $this->entityManager->persist($message);
            $this->entityManager->flush();

            return $this->redirectToRoute('topic_show', ['id' => $topic->getId()]);
        }
        return $this->render('topic/show.html.twig', [
            'topic' => $topic,
        ]);
    }

    #[Route('/create/topic', name: 'app_topic_new')]
    public function newTopic(EntityManagerInterface $entityManager, Request $request): Response
    {
        $topic = new Topic();
        $form = $this->createForm(NewTopicType::class, $topic);
        $form->handleRequest($request);
        $boards = $entityManager->getRepository(Board::class)->findAll();
        if ($form->isSubmitted() && $form->isValid()) {
            $topicName = $topic->getTitle();
            $existingTopic = $entityManager->getRepository(Topic::class)->findOneBy(['title' => $topicName]);
            if ($existingTopic) {
                $this->addFlash('danger', 'Un sujet avec le même titre existe déjà.');
                return $this->redirectToRoute('app_topic_new');
            }
            $entityManager->persist($topic);
            $entityManager->flush();
            return $this->redirectToRoute('topic_index');
        }

        return $this->render('topic/new.html.twig', [
            'form' => $form->createView(),
            'boards' => $boards,
        ]);
    }
}
