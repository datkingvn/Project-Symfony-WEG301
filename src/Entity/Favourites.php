<?php

namespace App\Entity;

use App\Repository\FavouritesRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=FavouritesRepository::class)
 */
class Favourites
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Users::class, inversedBy="favourites")
     */
    private $users;

    /**
     * @ORM\ManyToOne(targetEntity=Advertisements::class, inversedBy="favourites")
     */
    private $advertisements;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsers(): ?Users
    {
        return $this->users;
    }

    public function setUsers(?Users $users): self
    {
        $this->users = $users;

        return $this;
    }

    public function getAdvertisements(): ?Advertisements
    {
        return $this->advertisements;
    }

    public function setAdvertisements(?Advertisements $advertisements): self
    {
        $this->advertisements = $advertisements;

        return $this;
    }
}
