<?php

namespace App\Entity;

use App\Repository\PorteRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PorteRepository::class)]
class Porte
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $Nbr_de_porte = null;

    #[ORM\OneToMany(mappedBy: 'Porte', targetEntity: ArticleVoiture::class, orphanRemoval: true)]
    private Collection $articleVoitures;

    public function __construct()
    {
        $this->articleVoitures = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNbrDePorte(): ?string
    {
        return $this->Nbr_de_porte;
    }

    public function setNbrDePorte(string $Nbr_de_porte): self
    {
        $this->Nbr_de_porte = $Nbr_de_porte;

        return $this;
    }

    public function __toString(): string
    {
        return (string) $this->getNbrDePorte();
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
            $articleVoiture->setPorte($this);
        }

        return $this;
    }

    public function removeArticleVoiture(ArticleVoiture $articleVoiture): self
    {
        if ($this->articleVoitures->removeElement($articleVoiture)) {
            // set the owning side to null (unless already changed)
            if ($articleVoiture->getPorte() === $this) {
                $articleVoiture->setPorte(null);
            }
        }

        return $this;
    }
}
