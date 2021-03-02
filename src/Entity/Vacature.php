<?php

namespace App\Entity;

use App\Repository\VacatureRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=VacatureRepository::class)
 */
class Vacature
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=NiveauPlatform::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $niveau;

    /**
     * @ORM\ManyToOne(targetEntity=NiveauPlatform::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $platform;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $titel;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $standplaats;

    /**
     * @ORM\Column(type="text")
     */
    private $vacature_beschrijving;

    /**
     * @ORM\Column(type="datetime")
     */
    private $plaatsings_datum;

    /**
     * @ORM\ManyToOne(targetEntity=Gebruiker::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $bedrijf;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNiveau(): ?NiveauPlatform
    {
        return $this->niveau;
    }

    public function setNiveau(?NiveauPlatform $niveau): self
    {
        $this->niveau = $niveau;

        return $this;
    }

    public function getPlatform(): ?NiveauPlatform
    {
        return $this->platform;
    }

    public function setPlatform(?NiveauPlatform $platform): self
    {
        $this->platform = $platform;

        return $this;
    }

    public function getTitel(): ?string
    {
        return $this->titel;
    }

    public function setTitel(string $titel): self
    {
        $this->titel = $titel;

        return $this;
    }

    public function getStandplaats(): ?string
    {
        return $this->standplaats;
    }

    public function setStandplaats(string $standplaats): self
    {
        $this->standplaats = $standplaats;

        return $this;
    }

    public function getVacatureBeschrijving(): ?string
    {
        return $this->vacature_beschrijving;
    }

    public function setVacatureBeschrijving(string $vacature_beschrijving): self
    {
        $this->vacature_beschrijving = $vacature_beschrijving;

        return $this;
    }

    public function getPlaatsingsDatum(): ?\DateTimeInterface
    {
        return $this->plaatsings_datum;
    }

    public function setPlaatsingsDatum(\DateTimeInterface $plaatsings_datum): self
    {
        $this->plaatsings_datum = $plaatsings_datum;

        return $this;
    }

    public function getBedrijf(): ?gebruiker
    {
        return $this->bedrijf;
    }

    public function setBedrijf(?gebruiker $bedrijf): self
    {
        $this->bedrijf = $bedrijf;

        return $this;
    }

}
