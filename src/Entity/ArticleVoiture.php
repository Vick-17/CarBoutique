<?php

namespace App\Entity;

use App\Repository\ArticleVoitureRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ArticleVoitureRepository::class)]
#[Vich\Uploadable]
#[ORM\Index(name: "article", columns : ['title', 'description'], flags: ['fulltext'])]
class ArticleVoiture
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[Vich\UploadableField(mapping: 'annonces_image', fileNameProperty: 'imageName')]
    private ?File $imageFile = null;
    
     #[ORM\Column(type: 'string')]
    private ?string $imageName = null;

    #[Vich\UploadableField(mapping: 'annonces_image', fileNameProperty: 'imaged')]
    private ?File $imageFiled = null;
    
     #[ORM\Column(type: 'string')]
    private ?string $imaged = null;

    #[Vich\UploadableField(mapping: 'annonces_image', fileNameProperty: 'imaget')]
    private ?File $imageFilet = null;
    
     #[ORM\Column(type: 'string')]
    private ?string $imaget = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $createdAt = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $DescriptionLongue = null;

    #[ORM\ManyToOne(inversedBy: 'AnnonceVoiture')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user = null;

    #[ORM\ManyToOne(inversedBy: 'articleVoitures')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Marque $marque = null;

    #[ORM\ManyToOne(inversedBy: 'articlevoitures')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Modele $modele = null;

    #[ORM\ManyToOne(inversedBy: 'articleVoitures')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Transmission $transmission = null;

    #[ORM\ManyToOne(inversedBy: 'articleVoitures')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Porte $Porte = null;

    #[ORM\ManyToOne(inversedBy: 'articleVoitures')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Place $Place = null;

    #[ORM\ManyToOne(inversedBy: 'articleVoitures')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Energie $Energie = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Type $Type = null;

    #[ORM\Column(length: 255)]
    private ?string $Annee = null;

    #[ORM\Column(length: 255)]
    private ?string $Km = null;

    #[ORM\Column(length: 255)]
    private ?string $PuissanceCv = null;

    #[ORM\Column(length: 255)]
    private ?string $PuissanceDIN = null;

    #[ORM\Column(length: 255)]
    private ?string $price = null;

    #[ORM\ManyToMany(targetEntity: User::class, mappedBy: 'Favori')]
    private Collection $users;

    public function __construct()
    {
        $this->users = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

     /**
     * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile|null $imageFile
     */
    public function setImageFile(?File $imageFile = null): void
    {
        $this->imageFile = $imageFile;

        if (null !== $imageFile) {
            $this->updatedAt = new \DateTimeImmutable();
        }
    }

    public function getImageFile(): ?File
    {
        return $this->imageFile;
    }

    public function setImageName(?string $imageName): void
    {
        $this->imageName = $imageName;
    }

    public function getImageName(): ?string
    {
        return $this->imageName;
    }

         /**
     * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile|null $imageFiled
     */
    public function setImageFiled(?File $imageFiled = null): void
    {
        $this->imageFiled = $imageFiled;

        if (null !== $imageFiled) {
            $this->updatedAt = new \DateTimeImmutable();
        }
    }

    public function getImageFiled(): ?File
    {
        return $this->imageFiled;
    }

    public function setImaged(?string $imaged): void
    {
        $this->imaged = $imaged;
    }

    public function getimaged(): ?string
    {
        return $this->imaged;
    }

         /**
     * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile|null $imageFilet
     */
    public function setimageFilet(?File $imageFilet = null): void
    {
        $this->imageFilet = $imageFilet;

        if (null !== $imageFilet) {
            $this->updatedAt = new \DateTimeImmutable();
        }
    }

    public function getimageFilet(): ?File
    {
        return $this->imageFilet;
    }

    public function setimaget(?string $imaget): void
    {
        $this->imaget = $imaget;
    }

    public function getimaget(): ?string
    {
        return $this->imaget;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getDescriptionLongue(): ?string
    {
        return $this->DescriptionLongue;
    }

    public function setDescriptionLongue(string $DescriptionLongue): self
    {
        $this->DescriptionLongue = $DescriptionLongue;

        return $this;
    }

    public function getUser(): ?user
    {
        return $this->user;
    }

    public function setUser(?user $user): self
    {
        $this->user = $user;

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

    public function getModele(): ?modele
    {
        return $this->modele;
    }

    public function setModele(?modele $modele): self
    {
        $this->modele = $modele;

        return $this;
    }

    public function getTransmission(): ?transmission
    {
        return $this->transmission;
    }

    public function setTransmission(?transmission $transmission): self
    {
        $this->transmission = $transmission;

        return $this;
    }

    public function getPorte(): ?Porte
    {
        return $this->Porte;
    }

    public function setPorte(?Porte $Porte): self
    {
        $this->Porte = $Porte;

        return $this;
    }

    public function getPlace(): ?Place
    {
        return $this->Place;
    }

    public function setPlace(?Place $Place): self
    {
        $this->Place = $Place;

        return $this;
    }

    public function getEnergie(): ?energie
    {
        return $this->Energie;
    }

    public function setEnergie(?energie $Energie): self
    {
        $this->Energie = $Energie;

        return $this;
    }

    public function getType(): ?Type
    {
        return $this->Type;
    }

    public function setType(?Type $Type): self
    {
        $this->Type = $Type;

        return $this;
    }

    public function getAnnee(): ?string
    {
        return $this->Annee;
    }

    public function setAnnee(string $Annee): self
    {
        $this->Annee = $Annee;

        return $this;
    }

    public function getKm(): ?string
    {
        return $this->Km;
    }

    public function setKm(string $Km): self
    {
        $this->Km = $Km;

        return $this;
    }

    public function getPuissanceCv(): ?string
    {
        return $this->PuissanceCv;
    }

    public function setPuissanceCv(string $PuissanceCv): self
    {
        $this->PuissanceCv = $PuissanceCv;

        return $this;
    }

    public function getPuissanceDIN(): ?string
    {
        return $this->PuissanceDIN;
    }

    public function setPuissanceDIN(string $PuissanceDIN): self
    {
        $this->PuissanceDIN = $PuissanceDIN;

        return $this;
    }

    public function __toString(): string
    {
        return (string) $this->getMarque();
    }

    public function getPrice(): ?string
    {
        return $this->price;
    }

    public function setPrice(string $price): self
    {
        $this->price = $price;

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(User $user): self
    {
        if (!$this->users->contains($user)) {
            $this->users->add($user);
            $user->addFavori($this);
        }

        return $this;
    }

    public function removeUser(User $user): self
    {
        if ($this->users->removeElement($user)) {
            $user->removeFavori($this);
        }

        return $this;
    }
}
