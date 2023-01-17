<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\MarqueRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

#[ORM\Entity(repositoryClass: MarqueRepository::class)]
class Marque
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]

    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $Nom = null;

    #[ORM\OneToMany(mappedBy: 'marque', targetEntity: Vehicule::class)]
    private Collection $vehicules;

    #[ORM\OneToMany(mappedBy: 'marque', targetEntity: ArticleVoiture::class, orphanRemoval: true)]
    private Collection $articleVoitures;

    #[ORM\OneToMany(mappedBy: 'marque', targetEntity: Modele::class, orphanRemoval: true)]
    private Collection $modeles;

    #[ORM\OneToMany(mappedBy: 'marc', targetEntity: modele::class)]
    private Collection $Modele;

    #[ORM\OneToMany(mappedBy: 'Related', targetEntity: modele::class)]
    private Collection $modele;

    public function __construct()
    {
        $this->vehicules = new ArrayCollection();
        $this->articleVoitures = new ArrayCollection();
        $this->modeles = new ArrayCollection();
        $this->modele = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->Nom;
    }

    public function setNom(string $Nom): self
    {
        $this->Nom = $Nom;

        return $this;
    }

    /**
     * @return Collection<int, Vehicule>
     */
    public function getVehicules(): Collection
    {
        return $this->vehicules;
    }

    public function addVehicule(Vehicule $vehicule): self
    {
        if (!$this->vehicules->contains($vehicule)) {
            $this->vehicules->add($vehicule);
            $vehicule->setMarque($this);
        }

        return $this;
    }

    public function removeVehicule(Vehicule $vehicule): self
    {
        if ($this->vehicules->removeElement($vehicule)) {
            // set the owning side to null (unless already changed)
            if ($vehicule->getMarque() === $this) {
                $vehicule->setMarque(null);
            }
        }

        return $this;
    }

    public function __toString(): string
    {
        return (string) $this->getNom();
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
            $articleVoiture->setMarque($this);
        }

        return $this;
    }

    public function removeArticleVoiture(ArticleVoiture $articleVoiture): self
    {
        if ($this->articleVoitures->removeElement($articleVoiture)) {
            // set the owning side to null (unless already changed)
            if ($articleVoiture->getMarque() === $this) {
                $articleVoiture->setMarque(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Modele>
     */
    public function getModeles(): Collection
    {
        return $this->modeles;
    }

    public function addModele(Modele $modele): self
    {
        if (!$this->modeles->contains($modele)) {
            $this->modeles->add($modele);
            $modele->setMarque($this);
        }

        return $this;
    }

    public function removeModele(Modele $modele): self
    {
        if ($this->modeles->removeElement($modele)) {
            // set the owning side to null (unless already changed)
            if ($modele->getMarque() === $this) {
                $modele->setMarque(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, modele>
     */
    public function getModele(): Collection
    {
        return $this->Modele;
    }
}
