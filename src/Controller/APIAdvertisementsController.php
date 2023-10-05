<?php

namespace App\Controller;

use App\Entity\Advertisements;
use App\Repository\AdvertisementsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

/**
 * @Route("/api/advertisements", name="api_advertisements_")
 */
class APIAdvertisementsController extends AbstractController
{
    private $advertisementsRepository;
    private $serializer;

    public function __construct(AdvertisementsRepository $advertisementsRepository, SerializerInterface $serializer)
    {
        $this->advertisementsRepository = $advertisementsRepository;
        $this->serializer = $serializer;
    }

    /**
     * @Route("/", name="list", methods={"GET"})
     */
    public function list(): Response
    {
        // Retrieve all advertisements from the database
        $advertisements = $this->advertisementsRepository->findAll();

        // Create a new array to hold the serialized advertisement data
        $serializedAdvertisements = [];

        // Serialize each advertisement, excluding the "users" property
        foreach ($advertisements as $advertisement) {
            $serializedAdvertisement = $this->serializer->normalize($advertisement, null, [
                'attributes' => [
                    'id',
                    'title',
                    'description',
                    'createdAt',
                ],
            ]);

            $serializedAdvertisements[] = $serializedAdvertisement;
        }

        // Serialize the array of advertisements to JSON format
        $data = $this->serializer->serialize($serializedAdvertisements, 'json');

        // Return a JSON response with the advertisements
        return new Response($data, Response::HTTP_OK, ['Content-Type' => 'application/json']);
    }
}