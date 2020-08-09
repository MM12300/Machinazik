<?php

namespace App\Entity;

use App\Repository\GenreRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=GenreRepository::class)
 */
class Genre
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $genre_name;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $subgenre_name;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getGenreName(): ?string
    {
        return $this->genre_name;
    }

    public function setGenreName(string $genre_name): self
    {
        $this->genre_name = $genre_name;

        return $this;
    }

    public function getSubgenreName(): ?string
    {
        return $this->subgenre_name;
    }

    public function setSubgenreName(string $subgenre_name): self
    {
        $this->subgenre_name = $subgenre_name;

        return $this;
    }
}
