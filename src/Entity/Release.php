<?php

namespace App\Entity;

use App\Repository\ReleaseRepository;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\EntityManagerInterface;

/**
 * @ORM\Entity(repositoryClass=ReleaseRepository::class)
 * @ORM\Table(name="`release`")
 */
class Release
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
    private $artist;

    /**
     * @ORM\Column(type="datetime", length=255)
     */
    private $date_created;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $image;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $release_type;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $date_release;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $release_name;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $facebook;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $instagram;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $twitter;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $youtube;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $deezer;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $spotify;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $soundcloud;

    /**
     * @ORM\ManyToOne(targetEntity=Users::class, inversedBy="releases")
     */
    private $user;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $genre;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $subgenre;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getArtist(): ?string
    {
        return $this->artist;
    }

    public function setArtist(string $artist): self
    {
        $this->artist = $artist;

        return $this;
    }

    public function getDateCreated(): ?\DateTimeInterface
    {
        return $this->date_created;
    }

    public function setDateCreated(\DateTimeInterface $date_created): self
    {
        $this->date_created = $date_created;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getReleaseType(): ?string
    {
        return $this->release_type;
    }

    public function setReleaseType(string $release_type): self
    {
        $this->release_type = $release_type;

        return $this;
    }

    public function getDateRelease(): ?string
    {
        return $this->date_release;
    }

    public function setDateRelease(string $date_release): self
    {
        $this->date_release = $date_release;

        return $this;
    }

    public function getReleaseName(): ?string
    {
        return $this->release_name;
    }

    public function setReleaseName(string $release_name): self
    {
        $this->release_name = $release_name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getFacebook(): ?string
    {
        return $this->facebook;
    }

    public function setFacebook(?string $facebook): self
    {
        $this->facebook = $facebook;

        return $this;
    }

    public function getInstagram(): ?string
    {
        return $this->instagram;
    }

    public function setInstagram(?string $instagram): self
    {
        $this->instagram = $instagram;

        return $this;
    }

    public function getTwitter(): ?string
    {
        return $this->twitter;
    }

    public function setTwitter(?string $twitter): self
    {
        $this->twitter = $twitter;

        return $this;
    }

    public function getYoutube(): ?string
    {
        return $this->youtube;
    }

    public function setYoutube(?string $youtube): self
    {
        $this->youtube = $youtube;

        return $this;
    }

    public function getDeezer(): ?string
    {
        return $this->deezer;
    }

    public function setDeezer(?string $deezer): self
    {
        $this->deezer = $deezer;

        return $this;
    }

    public function getSpotify(): ?string
    {
        return $this->spotify;
    }

    public function setSpotify(?string $spotify): self
    {
        $this->spotify = $spotify;

        return $this;
    }

    public function getSoundcloud(): ?string
    {
        return $this->soundcloud;
    }

    public function setSoundcloud(?string $soundcloud): self
    {
        $this->soundcloud = $soundcloud;

        return $this;
    }

    public function getUser(): ?Users
    {
        return $this->user;
    }

    public function setUser(?Users $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getGenre(): ?string
    {
        return $this->genre;
    }

    public function setGenre(string $genre): self
    {
        $this->genre = $genre;

        return $this;
    }

    public function getSubgenre(): ?string
    {
        return $this->subgenre;
    }

    public function setSubgenre(string $subgenre): self
    {
        $this->subgenre = $subgenre;

        return $this;
    }

}
