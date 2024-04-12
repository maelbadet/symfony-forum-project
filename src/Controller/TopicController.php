<?php
// src/Controller/TopicController.php

namespace App\Controller;

use App\Entity\Topic;
use App\Entity\Message;
use App\Form\MessageFormType;
use App\Form\TopicFormType;
use App\Form\TopicType;
use DateTime;
use DateTimeZone;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use function Symfony\Component\Clock\now;

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
    public function show(Topic $topic,EntityManagerInterface $entityManager, Request $request): Response
    {
        $message = new Message();
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


}
