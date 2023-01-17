<?php

namespace App\Entity;

use App\Repository\TransmissionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TransmissionRepository::class)]
class Transmission
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $Boite = null;

    #[ORM\OneToMany(mappedBy: 'transmission', targetEntity: ArticleVoiture::class, orphanRemoval: true)]
    private Collection $articleVoitures;


    public function __construct()
    {
        $this->articleVoitures = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBoite(): ?string
    {
        return $this->Boite;
    }

    public function setBoite(string $Boite): self
    {
        $this->Boite = $Boite;

        return $this;
    }

    public function __toString(): string
    {
        return (string) $this->getBoite();
    }

    /**
     * @return Collection<int, ArticleVoiture>
     */
    public function getArticleVoitures(): Collection
    {
        return $this->articleVoitures;
    }

    public function addArticleVoiture(ArticleVoiture $articleVoiture): self
    {
        if (!$this->articleVoitures->contains($articleVoiture)) {
            $this->articleVoitures->add($articleVoiture);
            $articleVoiture->setTransmission($this);
        }

        return $this;
    }

    public function removeArticleVoiture(ArticleVoiture $articleVoiture): self
    {
        if ($this->articleVoitures->removeElement($articleVoiture)) {
            // set the owning side to null (unless already changed)
            if ($articleVoiture->getTransmission() === $this) {
                $articleVoiture->setTransmission(null);
            }
        }

        return $this;
    }
}
