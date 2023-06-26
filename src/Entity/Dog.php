<?php

namespace App\Entity;

use App\Entity\Traits\HasDescrTrait;
use App\Entity\Traits\HasIdTrait;
use App\Entity\Traits\HasNameTrait;
use App\Repository\DogRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: DogRepository::class)]
class Dog
{
    use HasIdTrait;
    use HasNameTrait;
    use HasDescrTrait;

    #[ORM\Column(options: ['default' => false])]
    private ?bool $isLOF = false;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $history = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $sociability = null;

    #[ORM\Column(options: ['default' => false])]
    private ?bool $isAdopted = false;

    #[ORM\ManyToOne(inversedBy: 'dogs')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Offer $offer = null;

    #[ORM\OneToMany(mappedBy: 'dog', cascade: ['persist'], targetEntity: Image::class, orphanRemoval: true)]
    private Collection $images;

    #[ORM\ManyToMany(targetEntity: Application::class, inversedBy: 'dogs')]
    #[ORM\JoinColumn(nullable: true)]
    private Collection $applications;

    #[ORM\ManyToMany(targetEntity: Breed::class, mappedBy: 'dogs')]
    private Collection $breeds;

    public function __construct()
    {
        $this->images = new ArrayCollection();
        $this->applications = new ArrayCollection();
        $this->breeds = new ArrayCollection();
    }

    public function isIsLOF(): ?bool
    {
        return $this->isLOF;
    }

    public function setIsLOF(bool $isLOF): self
    {
        $this->isLOF = $isLOF;

        return $this;
    }

    public function getHistory(): ?string
    {
        return $this->history;
    }

    public function setHistory(string $history): self
    {
        $this->history = $history;

        return $this;
    }

    public function getSociability(): ?string
    {
        return $this->sociability;
    }

    public function setSociability(string $sociability): self
    {
        $this->sociability = $sociability;

        return $this;
    }

    public function isIsAdopted(): ?bool
    {
        return $this->isAdopted;
    }

    public function setIsAdopted(bool $isAdopted): self
    {
        $this->isAdopted = $isAdopted;

        return $this;
    }

    public function getOffer(): ?Offer
    {
        return $this->offer;
    }

    public function setOffer(?Offer $offer): self
    {
        $this->offer = $offer;

        return $this;
    }

    /**
     * @return Collection<int, Image>
     */
    public function getImages(): Collection
    {
        return $this->images;
    }

    public function addImage(Image $image): self
    {
        if (!$this->images->contains($image)) {
            $this->images->add($image);
            $image->setDog($this);
        }

        return $this;
    }

    public function removeImage(Image $image): self
    {
        if ($this->images->removeElement($image)) {
            // set the owning side to null (unless already changed)
            if ($image->getDog() === $this) {
                $image->setDog(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Application>
     */
    public function getApplications(): Collection
    {
        return $this->applications;
    }

    public function addApplication(Application $application): self
    {
        if (!$this->applications->contains($application)) {
            $this->applications->add($application);
        }

        return $this;
    }

    public function removeApplication(Application $application): self
    {
        $this->applications->removeElement($application);

        return $this;
    }

    /**
     * @return Collection<int, Breed>
     */
    public function getBreeds(): Collection
    {
        return $this->breeds;
    }

    public function addBreed(Breed $breed): self
    {
        if (!$this->breeds->contains($breed)) {
            $this->breeds->add($breed);
            $breed->addDog($this);
        }

        return $this;
    }

    public function removeBreed(Breed $breed): self
    {
        if ($this->breeds->removeElement($breed)) {
            $breed->removeDog($this);
        }

        return $this;
    }

    public function __toString(): string
    {
        return $this->getName();
    }

    #[Assert\IsTrue(message: 'Un chien avec plusieurs races ne peut être LOF')]
    public function isLofOK(): bool
    {
        if ($this->isIsLOF() && 1 != $this->getBreeds()->count()) {
            return false;
        }

        return true;
    }
}
