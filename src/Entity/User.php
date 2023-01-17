<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[UniqueEntity(fields: ['email'], message: 'There is already an account with this email')]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180, unique: true)]
    private ?string $email = null;

    #[ORM\Column]
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    private ?string $password = null;

    #[ORM\Column(type: 'boolean')]
    private $isVerified = false;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $lastname = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $PhoneNumber = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $adresse = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $Photo = null;

    #[ORM\OneToMany(mappedBy: 'User', targetEntity: ArticleVoiture::class, orphanRemoval: true)]
    private Collection $AnnonceVoiture;

    #[ORM\OneToMany(mappedBy: 'User', targetEntity: Reclam::class)]
    private Collection $reclams;

    #[ORM\ManyToMany(targetEntity: ArticleVoiture::class, inversedBy: 'users')]
    private Collection $Favori;

    public function __construct()
    {
        $this->articlevoitures = new ArrayCollection();
        $this->AnnonceVoiture = new ArrayCollection();
        $this->Article = new ArrayCollection();
        $this->reclams = new ArrayCollection();
        $this->Favori = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function isVerified(): bool
    {
        return $this->isVerified;
    }

    public function setIsVerified(bool $isVerified): self
    {
        $this->isVerified = $isVerified;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): self
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getPhoneNumber(): ?string
    {
        return $this->PhoneNumber;
    }

    public function setPhoneNumber(?string $PhoneNumber): self
    {
        $this->PhoneNumber = $PhoneNumber;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(?string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getPhoto(): ?string
    {
        return $this->Photo;
    }

    public function setPhoto(?string $Photo): self
    {
        $this->Photo = $Photo;

        return $this;
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
            $articlevoiture->setUserId($this);
        }

        return $this;
    }

    public function removeArticlevoiture(Articlevoiture $articlevoiture): self
    {
        if ($this->articlevoitures->removeElement($articlevoiture)) {
            // set the owning side to null (unless already changed)
            if ($articlevoiture->getUserId() === $this) {
                $articlevoiture->setUserId(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Articlevoiture>
     */
    public function getAnnonceVoiture(): Collection
    {
        return $this->AnnonceVoiture;
    }

    public function addAnnonceVoiture(Articlevoiture $annonceVoiture): self
    {
        if (!$this->AnnonceVoiture->contains($annonceVoiture)) {
            $this->AnnonceVoiture->add($annonceVoiture);
            $annonceVoiture->setUser($this);
        }

        return $this;
    }

    public function removeAnnonceVoiture(Articlevoiture $annonceVoiture): self
    {
        if ($this->AnnonceVoiture->removeElement($annonceVoiture)) {
            // set the owning side to null (unless already changed)
            if ($annonceVoiture->getUser() === $this) {
                $annonceVoiture->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, articleVoiture>
     */
    public function getArticle(): Collection
    {
        return $this->Article;
    }

    /**
     * @return Collection<int, Reclam>
     */
    public function getReclams(): Collection
    {
        return $this->reclams;
    }

    public function addReclam(Reclam $reclam): self
    {
        if (!$this->reclams->contains($reclam)) {
            $this->reclams->add($reclam);
            $reclam->setUser($this);
        }

        return $this;
    }

    public function removeReclam(Reclam $reclam): self
    {
        if ($this->reclams->removeElement($reclam)) {
            // set the owning side to null (unless already changed)
            if ($reclam->getUser() === $this) {
                $reclam->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, ArticleVoiture>
     */
    public function getFavori(): Collection
    {
        return $this->Favori;
    }

    public function addFavori(ArticleVoiture $favori): self
    {
        if (!$this->Favori->contains($favori)) {
            $this->Favori->add($favori);
        }

        return $this;
    }

    public function removeFavori(ArticleVoiture $favori): self
    {
        $this->Favori->removeElement($favori);

        return $this;
    }
}
