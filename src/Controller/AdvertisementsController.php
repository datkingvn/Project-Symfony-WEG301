<?php

namespace App\Controller;

use App\Repository\AdvertisementsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/advertisements", name="advertisements_")
 * @package App\Controller
 */
class AdvertisementsController extends AbstractController
{
    /**
     * @Route("/details/{slug}", name="details")
     */
    public function details($slug, AdvertisementsRepository $advertisementsRepository): Response
    {
        $advertisement = $advertisementsRepository->findOneBy(['slug' => $slug]);

        if (!$advertisement) {
            throw $this->createNotFoundException('Slug Not Found');
        }

        return $this->render('advertisements/detail.html.twig', [
            'advertisement' => $advertisement
        ]);
    }
}
