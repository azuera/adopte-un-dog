<?php

namespace App\Entity;

use App\Entity\Traits\HasIdTrait;
use App\Entity\Traits\HasNameTrait;
use App\Repository\BreedRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BreedRepository::class)]
class Breed
{
    use HasIdTrait;

    use HasNameTrait;

    #[ORM\ManyToMany(targetEntity: Dog::class, cascade: ['persist'], inversedBy: 'breeds')]
    private Collection $dogs;

    public function __construct()
    {
        $this->dogs = new ArrayCollection();
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
        }

        return $this;
    }

    public function removeDog(Dog $dog): self
    {
        $this->dogs->removeElement($dog);

        return $this;
    }

    public function __toString():string
    {
        return $this->getName();
    }
}
