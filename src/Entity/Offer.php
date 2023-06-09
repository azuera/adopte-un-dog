<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use App\Entity\Traits\HasCreatedTime;
use App\Entity\Traits\HasDescrTrait;
use App\Entity\Traits\HasIdTrait;
use App\Repository\OfferRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

#[ORM\Entity(repositoryClass: OfferRepository::class)]
#[ApiResource(
    operations: [
        new Get(),
        new GetCollection()
    ]
)]
class Offer
{
    use HasIdTrait;
    use HasDescrTrait;
    use HasCreatedTime;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\Column(length: 255)]
    private ?string $location = null;

    #[ORM\Column(options: ['default' => false])]
    private ?bool $isClosed = false;

    #[ORM\OneToMany(mappedBy: 'offer', targetEntity: Application::class, orphanRemoval: true)]
    #[ORM\OrderBy([
        'dateTime' => 'DESC',
    ])]
    private Collection $applications;

    #[ORM\ManyToOne(inversedBy: 'offers')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Breeder $breeder = null;

    #[ORM\OneToMany(mappedBy: 'offer', cascade: ['persist'], targetEntity: Dog::class, orphanRemoval: true)]
    private Collection $dogs;

    #[ORM\Column(name: 'updated_time', type: Types::DATETIME_MUTABLE)]
    #[Gedmo\Timestampable(on: 'update')]
    private ?\DateTimeInterface $updatedTime = null;

    public function __construct()
    {
        $this->applications = new ArrayCollection();
        $this->dogs = new ArrayCollection();
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

    public function getLocation(): ?string
    {
        return $this->location;
    }

    public function setLocation(string $location): self
    {
        $this->location = $location;

        return $this;
    }

    public function isIsClosed(): ?bool
    {
        return $this->isClosed;
    }

    public function setIsClosed(bool $isClosed): self
    {
        $this->isClosed = $isClosed;

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
            $application->setOffer($this);
        }

        return $this;
    }

    public function removeApplication(Application $application): self
    {
        if ($this->applications->removeElement($application)) {
            // set the owning side to null (unless already changed)
            if ($application->getOffer() === $this) {
                $application->setOffer(null);
            }
        }

        return $this;
    }

    public function getBreeder(): ?Breeder
    {
        return $this->breeder;
    }

    public function setBreeder(?Breeder $breeder): self
    {
        $this->breeder = $breeder;

        return $this;
    }

    /**
     * @return Collection<int, Dog>
     */
    public function getDogs(): Collection
    {
        return $this->dogs;
    }

    public function addDog(Dog $dog): self
    {
        if (!$this->dogs->contains($dog)) {
            $this->dogs->add($dog);
            $dog->setOffer($this);
        }

        return $this;
    }

    public function removeDog(Dog $dog): self
    {
        if ($this->dogs->removeElement($dog)) {
            // set the owning side to null (unless already changed)
            if ($dog->getOffer() === $this) {
                $dog->setOffer(null);
            }
        }

        return $this;
    }

    public function getBreeds(): array
    {
        $breeds = [];
        foreach ($this->getDogs() as $dog) {
            foreach ($dog->getBreeds() as $breed) {
                $breeds[] = $breed;
            }
        }

        return $breeds;
    }

    public function getUpdatedTime(): ?\DateTimeInterface
    {
        return $this->updatedTime;
    }

    public function setUpdatedTime(\DateTimeInterface $updatedTime): self
    {
        $this->updatedTime = $updatedTime;

        return $this;
    }

    public function getImages(): array
    {
        $images = [];
        foreach ($this->getDogs() as $dog) {
            foreach ($dog->getImages() as $image) {
                $images[] = $image;
            }
        }

        return $images;
    }

    public function hasLOFDog(): bool
    {
        $isDogLof = false;
        foreach ($this->dogs as $dog) {
            if (true == $dog->isIsLof()) {
                $isDogLof = true;
            }
        }

        return $isDogLof;
    }

    public function __toString(): string
    {
        return $this->getTitle();
    }

    public function getLastMessageDate(): ?\DateTimeInterface
    {
        $date = $this->getUpdatedTime();
        if ( $this->getApplications()->count() > 0 ){
            foreach ($this->getApplications() as $application) {
                foreach ($application->getMessages() as $message) {
                    if ($message->getDateTime() > $date) {
                        $date = $message->getDateTime();
                    }
                }
            }
        }
        return $date;
    }
}
