<?php

namespace App\Controller\Admin;


use App\Entity\Advertisements;
use App\Form\AdvertisementsType;
use App\Repository\AdvertisementsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


/**
 * @Route("/admin/advertisements", name="admin_advertisements_")
 * @package App\Controller
 */
class AdvertisementsController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(AdvertisementsRepository $advertisementsRepository): Response
    {
        return $this->render('admin/advertisements/index.html.twig', [
            'advertisements' => $advertisementsRepository->findAll(),
        ]);
    }

    /**
     * @Route("/active-advertisements/{id}", name="active")
     */
    public function activeAdvertisement($id, AdvertisementsRepository $advertisementsRepository): Response
    {
        $advertisement = $advertisementsRepository->find($id);

        if (!$advertisement) {
            throw $this->createNotFoundException('Advertisement not found');
        }

        $isActive = !$advertisement->isActive();
        $advertisement->setActive($isActive);

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($advertisement);
        $entityManager->flush();

        $this->addFlash('success', 'Change Status Successfully!');

        return new Response($isActive ? 'true' : 'false');
    }
}
