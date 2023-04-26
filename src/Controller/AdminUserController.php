<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin')]
class AdminUserController extends AbstractController
{
    #[Route('/user/add', name: 'admin_user_add')]
    public function add(): Response
    {
        $form = $this->createForm(UserType::class, new User());
        return $this->render('admin_user/add.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
