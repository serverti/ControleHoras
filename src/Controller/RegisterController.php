<?php

namespace App\Controller;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class RegisterController extends AbstractController
{
    #[Route('/register', name: 'app_register')]
    public function register(Request $request, EntityManagerInterface $entityManager, UserPasswordHasherInterface $passwordHasher): Response
    {
        if ($request->isMethod('POST')) {
            $email = $request->request->get('email');
            $password = $request->request->get('password');

            // Verifica se o email já está cadastrado
            $existingUser = $entityManager->getRepository(User::class)->findOneBy(['email' => $email]);

            if ($existingUser) {
                return $this->render('register/register.html.twig', [
                    'error' => 'Este email já está cadastrado.'
                ]);
            }

            // Criar um novo usuário
            $user = new User();
            $user->setEmail($email);
            $user->setRoles(['ROLE_USER']); // Define um papel padrão

            // Hash da senha
            $hashedPassword = $passwordHasher->hashPassword($user, $password);
            $user->setPassword($hashedPassword);

            // Persistir no banco de dados
            $entityManager->persist($user);
            $entityManager->flush();

            // Redireciona para a página de login após registro
            return $this->redirectToRoute('app_login');
        }

        return $this->render('register/register.html.twig');
    }
}
