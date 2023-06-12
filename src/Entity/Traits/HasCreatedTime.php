<?php

namespace App\Entity\Traits;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\DBAL\Types\Types;
use Gedmo\Mapping\Annotation as Gedmo;

trait HasCreatedTime
{
    #[Gedmo\Timestampable(on: 'create')]
    #[ORM\Column(name: 'created_time', type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $dateTime = null;

    public function getDateTime(): ?\DateTimeInterface
    {
        return $this->dateTime;
    }

    public function setDateTime(\DateTimeInterface $dateTime): self
    {
        $this->dateTime = $dateTime;

        return $this;
    }
}