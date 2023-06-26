<?php

namespace App\Form;

use App\Entity\Breed;

class Filter
{
    protected ?Breed $breed = null;
    protected bool $lof = false;

    public function getBreed(): ?Breed
    {
        return $this->breed;
    }

    public function setBreed(?Breed $breed): self
    {
        $this->breed = $breed;

        return $this;
    }

    public function getLof(): bool
    {
        return $this->lof;
    }

    public function setLof(bool $lof): self
    {
        $this->lof = $lof;

        return $this;
    }
}