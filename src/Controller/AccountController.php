<?php

namespace App\Controller;

use App\Form\InformationPersonnelType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Attribute\Route;

class AccountController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/personnal/informations', name: 'app_personnal_information')]
    public function index(Request $request, UserPasswordHasherInterface $userPasswordHasher, EntityManagerInterface $entityManager): Response
    {
        $user = $this->getUser();
        $form = $this->createForm(InformationPersonnelType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $newPassword = $form->get('newPassword')->getData();
            $verifNewpassword = $form->get('verifNewPassword')->getData();

            if (!empty($newPassword)) {
                if ($newPassword === $verifNewpassword) {
                    $user->setPassword(
                        $userPasswordHasher->hashPassword(
                            $user,
                            $newPassword
                        )
                    );
                } else {
                    $this->addFlash('danger', 'Les mots de passe ne correspondent pas.');
                    return $this->redirectToRoute('app_personnal_information');
                }
            }

            $profileImageFile = $form->get('profileImage')->getData();

            if ($profileImageFile) {
                $newFilename = uniqid().'.'.$profileImageFile->guessExtension();

                try {
                    $profileImageFile->move(
                        $this->getParameter('profile_images_directory'),
                        $newFilename
                    );
                } catch (FileException $e) {
                    $this->addFlash('danger', 'Une erreur s\'est produite lors du téléchargement de l\'image.');
                    return $this->redirectToRoute('app_personnal_information');
                }

                $user->setProfileImage($newFilename);
            }

            $entityManager->persist($user);
            $entityManager->flush();

            $this->addFlash('success', 'Informations mises à jour avec succès.');
            return $this->redirectToRoute('app_personnal_information');
        }

        return $this->render('account/index.html.twig', [
            'controller_name' => 'PersonnalInformationController',
            'account_form' => $form->createView(),
        ]);
    }
}
