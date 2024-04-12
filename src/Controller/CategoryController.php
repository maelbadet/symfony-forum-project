<?php

namespace App\Controller;

use App\Entity\Category;
use App\Form\NewCategoryType;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
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

    #[Route('/create/category', name: 'app_category_new')]
    public function newCategory(EntityManagerInterface $entityManager, Request $request): Response
    {
        $category = new Category();
        $form = $this->createForm(NewCategoryType::class, $category);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $categoryName = $category->getName();
            $existingCategory = $entityManager->getRepository(Category::class)->findOneBy(['name' => $categoryName]);
            if ($existingCategory) {
                $this->addFlash('danger', 'La catégorie existe déjà.');
                return $this->redirectToRoute('app_category');
            }
            $category->setRoleAccess('["ROLE_USER"]');
            $entityManager->persist($category);
            $entityManager->flush();
            return $this->redirectToRoute('app_category');
        }
        return $this->render('category/new.html.twig', [
            'controller_name' => 'CategoryController',
            'form' => $form->createView(),
        ]);
    }
}
