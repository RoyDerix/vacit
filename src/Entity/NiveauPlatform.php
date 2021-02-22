<?php

namespace App\Entity;

use App\Repository\NiveauPlatformRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=NiveauPlatformRepository::class)
 */
class NiveauPlatform
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=1)
     */
    private $record_type;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $tekstveld;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $platform_icoon;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRecordType(): ?string
    {
        return $this->record_type;
    }

    public function setRecordType(string $record_type): self
    {
        $this->record_type = $record_type;

        return $this;
    }

    public function getTekstveld(): ?string
    {
        return $this->tekstveld;
    }

    public function setTekstveld(string $tekstveld): self
    {
        $this->tekstveld = $tekstveld;

        return $this;
    }

    public function getPlatformIcoon(): ?string
    {
        return $this->platform_icoon;
    }

    public function setPlatformIcoon(?string $platform_icoon): self
    {
        $this->platform_icoon = $platform_icoon;

        return $this;
    }
}
