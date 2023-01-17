<?php

namespace App\Entity;

use App\Repository\EnergieRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EnergieRepository::class)]
class Energie
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $Carburant = null;

    #[ORM\OneToMany(mappedBy: 'Energie', targetEntity: ArticleVoiture::class, orphanRemoval: true)]
    private Collection $articleVoitures;

    public function __construct()
    {
        $this->articleVoitures = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCarburant(): ?string
    {
        return $this->Carburant;
    }

    public function setCarburant(string $Carburant): self
    {
        $this->Carburant = $Carburant;

        return $this;
    }

    public function __toString(): string
    {
        return (string) $this->getCarburant();
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
            $articleVoiture->setEnergie($this);
        }

        return $this;
    }

    public function removeArticleVoiture(ArticleVoiture $articleVoiture): self
    {
        if ($this->articleVoitures->removeElement($articleVoiture)) {
            // set the owning side to null (unless already changed)
            if ($articleVoiture->getEnergie() === $this) {
                $articleVoiture->setEnergie(null);
            }
        }

        return $this;
    }
}
