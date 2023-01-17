<?php

namespace App\Entity;

use App\Repository\KmRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: KmRepository::class)]
class Km
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $Nbr_de_Km = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNbrDeKm(): ?string
    {
        return $this->Nbr_de_Km;
    }

    public function setNbrDeKm(string $Nbr_de_Km): self
    {
        $this->Nbr_de_Km = $Nbr_de_Km;

        return $this;
    }
}
