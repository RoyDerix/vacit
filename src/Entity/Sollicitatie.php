<?php

namespace App\Entity;

use App\Repository\SollicitatieRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SollicitatieRepository::class)
 */
class Sollicitatie
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=vacature::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $vacature;

    /**
     * @ORM\Column(type="boolean")
     */
    private $uitgenodigd;

    /**
     * @ORM\Column(type="datetime")
     */
    private $sollicitatie_datum;

    /**
     * @ORM\ManyToOne(targetEntity=gebruiker::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $kandidaat;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getVacature(): ?vacature
    {
        return $this->vacature;
    }

    public function setVacature(?vacature $vacature): self
    {
        $this->vacature = $vacature;

        return $this;
    }

    public function getUitgenodigd(): ?bool
    {
        return $this->uitgenodigd;
    }

    public function setUitgenodigd(bool $uitgenodigd): self
    {
        $this->uitgenodigd = $uitgenodigd;

        return $this;
    }

    public function getSollicitatieDatum(): ?\DateTimeInterface
    {
        return $this->sollicitatie_datum;
    }

    public function setSollicitatieDatum(\DateTimeInterface $sollicitatie_datum): self
    {
        $this->sollicitatie_datum = $sollicitatie_datum;

        return $this;
    }

    public function getKandidaat(): ?gebruiker
    {
        return $this->kandidaat;
    }

    public function setKandidaat(?gebruiker $kandidaat): self
    {
        $this->kandidaat = $kandidaat;

        return $this;
    }
}
