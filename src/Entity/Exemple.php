<?php

namespace App\Entity;

use App\Repository\ExempleRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ExempleRepository::class)]
class Exemple
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $fieldExemple = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFieldExemple(): ?string
    {
        return $this->fieldExemple;
    }

    public function setFieldExemple(string $fieldExemple): self
    {
        $this->fieldExemple = $fieldExemple;

        return $this;
    }
}
