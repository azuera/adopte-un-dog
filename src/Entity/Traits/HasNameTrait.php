<?php

namespace App\Entity\Traits;

use Doctrine\ORM\Mapping as ORM;

trait HasNameTrait
{
    #[ORM\Column(length: 255)]
    protected ?string $name = null;

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }
}