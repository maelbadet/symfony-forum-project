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

        if (!$user) {
            return $this->redirectToRoute('app_login');
        }
        if (!empty($newPassword)){
            if ($form->isSubmitted() && $form->isValid()) {
            var_dump('coucou');
                if ( $newPassword === $verifNewpassword) {
                    $user->setPassword(
                        $userPasswordHasher->hashPassword(
                            $user,
                            $newPassword
                        )
                    );
                    $entityManager->persist($user);
                    $entityManager->flush();
                    return $this->redirectToRoute('app_personnal_information');
                } else {
                    $this->addFlash('danger', 'Mot de passe invalide. Êtes vous sur que vos mots passe correspondais ?');
                }
            }

            $profileImageFile = $form->get('profileImage')->getData();
            
            if ($profileImageFile) {
                $newFilename = uniqid().'.'.$profileImageFile->guessExtension();
                
                try {
                    $profileImageFile->move(
                        $this->getParameter('profile_images'),
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
