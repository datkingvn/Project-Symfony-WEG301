<?php

namespace App\Controller;
use App\Entity\Favourites; // Add this line
use App\Entity\Advertisements;
use App\Repository\AdvertisementsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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

    /**
     * @Route("/favourite/like/{id}", name="like_favourite")
     */
    public function addFavourite($id, AdvertisementsRepository $advertisementsRepository, Request $request): Response
    {
        $user = $this->getUser();
        $advertisement = $advertisementsRepository->find($id);

        if (!$advertisement) {
            throw $this->createNotFoundException('Advertisement not found');
        }

        // Create a new Favourites object
        $favourite = new Favourites();
        $favourite->setUsers($user); // Updated method name

        // Add the Favourites object to the advertisement
        $advertisement->addFavourite($favourite);

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($favourite);
        $entityManager->persist($advertisement);
        $entityManager->flush();

        return $this->redirect($request->headers->get('referer'));
    }

    /**
     * @Route("/favourite/dislike/{id}", name="dislike_favourite")
     */
    public function dislikeFavourite($id, AdvertisementsRepository $advertisementsRepository, Request $request): Response
    {
        $user = $this->getUser();
        $advertisement = $advertisementsRepository->find($id);

        if (!$advertisement) {
            throw $this->createNotFoundException('Advertisement not found');
        }

        // Find the favourites associated with the user and advertisement
        $favourites = $advertisement->getFavourites();

        foreach ($favourites as $favourite) {
            if ($favourite->getUsers() === $user) {
                // Remove the favourite from the user
                $user->removeFavourite($favourite);
                // Remove the favourite from the advertisement
                $advertisement->removeFavourite($favourite);

                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->remove($favourite); // Remove the favourite from the database
                $entityManager->persist($advertisement);
                $entityManager->flush();

                break; // Exit the loop after removing the favourite
            }
        }

        return $this->redirect($request->headers->get('referer'));
    }
}
