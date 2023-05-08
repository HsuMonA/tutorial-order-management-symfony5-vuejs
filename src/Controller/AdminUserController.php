<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin')]
class AdminUserController extends AbstractController
{
    public function __construct(private EntityManagerInterface $em)
    {

    }

    #[Route('/user/add', name: 'admin_user_add')]
    public function add(Request $request, UserPasswordHasherInterface $passwordHasher): Response
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            //Passwort hashen
            $user->setPassword($passwordHasher->hashPassword($user, $user->getPassword()));
            $user->setRoles(['ROLE_USER']);
            //User persistieren
            $this->em->persist($user);
            //Datenbank schreiben
            $this->em->flush();
            return $this->redirectToRoute(route: 'admin_user_list');
        }
        return $this->render('admin_user/add.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/users', name: 'admin_user_list')]
    public function list(): Response
    {
        return $this->render('admin_user/list.html.twig', [
            'users' => $this->em->getRepository(User::class)->findUsers(),
        ]);
    }
}