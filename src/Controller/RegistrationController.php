<?php

namespace App\Controller;

use App\Entity\Client;
use App\Entity\Admin;
use App\Form\AdminRegistrationFormType;
use App\Form\RegistrationFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Attribute\Route;

class RegistrationController extends AbstractController
{
    #[Route('/register', name: 'app_register')]
    public function register(Request $request, UserPasswordHasherInterface $userPasswordHasher, Security $security, EntityManagerInterface $entityManager): Response
    {
        $user = new Client();
        $user->setRoles(['ROLE_USER']);
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // encode the plain password
            $user->setPassword(
                $userPasswordHasher->hashPassword(
                    $user,
                    $form->get('plainPassword')->getData()
                )
            );

            $entityManager->persist($user);
            $entityManager->flush();

            // do anything else you need here, like send an email

            // return $security->login($user, 'json_login', 'login');
        }

        return $this->render('registration/register.html.twig', [
            'registrationForm' => $form,
        ]);
    }

    #[Route('/admin/register', name: 'app_admin_register')]
    public function adminRegister(Request $request, UserPasswordHasherInterface $userPasswordHasher, Security $security, EntityManagerInterface $entityManager): Response
    {
        $admin = new Admin();
        $admin->setRoles(['ROLE_ADMIN']);
        $form = $this->createForm(AdminRegistrationFormType::class, $admin);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // encode the plain password
            $admin->setPassword(
                $userPasswordHasher->hashPassword(
                    $admin,
                    $form->get('plainPassword')->getData()
                )
            );

            $entityManager->persist($admin);
            $entityManager->flush();

            // do anything else you need here, like send an email

            // return $security->redirectToRoute('');
        }

        return $this->render('registration/admin.html.twig', [
            'registrationForm' => $form,
        ]);
    }
}
