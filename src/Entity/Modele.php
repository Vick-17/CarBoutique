<?php

namespace App\Entity;

use App\Repository\ModeleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ModeleRepository::class)]
class Modele
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $Name = null;

    #[ORM\OneToMany(mappedBy: 'modele', targetEntity: ArticleVoiture::class, orphanRemoval: true)]
    private Collection $articlevoitures;

    #[ORM\ManyToOne(inversedBy: 'modeles')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Marque $marque = null;

    #[ORM\ManyToOne(inversedBy: 'Modele')]
    private ?Marque $marc = null;

    public function __construct()
    {
        $this->articlevoitures = new ArrayCollection();
        $this->Modele = new ArrayCollection();
        $this->Marque = new ArrayCollection();
        
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->Name;
    }

    public function setName(string $Name): self
    {
        $this->Name = $Name;

        return $this;
    }

    public function __toString(): string
    {
        return (string) $this->getName();
    }

    /**
     * @return Collection<int, Articlevoiture>
     */
    public function getArticlevoitures(): Collection
    {
        return $this->articlevoitures;
    }

    public function addArticlevoiture(Articlevoiture $articlevoiture): self
    {
        if (!$this->articlevoitures->contains($articlevoiture)) {
            $this->articlevoitures->add($articlevoiture);
            $articlevoiture->setModele($this);
        }

        return $this;
    }

    public function removeArticlevoiture(Articlevoiture $articlevoiture): self
    {
        if ($this->articlevoitures->removeElement($articlevoiture)) {
            // set the owning side to null (unless already changed)
            if ($articlevoiture->getModele() === $this) {
                $articlevoiture->setModele(null);
            }
        }

        return $this;
    }

    public function getMarque(): ?marque
    {
        return $this->marque;
    }

    public function setMarque(?marque $marque): self
    {
        $this->marque = $marque;

        return $this;
    }

    public function getMarc(): ?Marque
    {
        return $this->marc;
    }

    public function setMarc(?Marque $marc): self
    {
        $this->marc = $marc;

        return $this;
    }
}
