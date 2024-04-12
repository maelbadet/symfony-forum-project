<?php

namespace App\Controller;

use App\Entity\Message;
use App\Entity\Topic;
use App\Form\MessageFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MessageController extends AbstractController
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/topic/{id}/message/new', name: 'message_new', methods: ['GET', 'POST'])]
    public function new(Request $request, Topic $topic): Response
    {
        $message = new Message();
        $form = $this->createForm(MessageFormType::class, $message);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $message->setTopic($topic);
            $message->setUserEntity($this->getUser());
            $this->entityManager->persist($message);
            $this->entityManager->flush();

            return $this->redirectToRoute('topic_show', ['id' => $topic->getId()]);
        }

        return $this->render('message/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}