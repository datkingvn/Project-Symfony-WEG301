<?php

namespace App\Controller;

use App\Entity\Advertisements;
use App\Form\AdvertisementsType;
use App\Form\EditProfileType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UsersController extends AbstractController
{
    /**
     * @Route("/users", name="app_users")
     */
    public function index(): Response
    {
        return $this->render('users/index.html.twig', [
            'controller_name' => 'UsersController',
        ]);
    }

    /**
     * @Route("/users/advertisements/add", name="users_advertisements_add")
     */
    public function addAdvertisement(Request $request): Response
    {
        $advertisement = new Advertisements();

        $form = $this->createForm(AdvertisementsType::class, $advertisement);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $advertisement->setUsers($this->getUser());
            $advertisement->setActive(false);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($advertisement);
            $entityManager->flush();

            return $this->redirectToRoute('app_users');
        }

        return $this->render('users/advertisements/add.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/users/profile/edit", name="users_profile_edit")
     */
    public function editProfile(Request $request): Response
    {
        $user = $this->getUser();

        $form = $this->createForm(EditProfileType::class, $user);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();

            $this->addFlash('message', 'Profile Update Successfully!');
            return $this->redirectToRoute('app_users');
        }

        return $this->render('users/edit-profile.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
