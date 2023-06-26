<?php

namespace App\Entity;

use App\Entity\Traits\HasIdTrait;
use App\Entity\Traits\HasCreatedTime;
use App\Repository\MessageRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MessageRepository::class)]
class Message
{
    use HasIdTrait;
    use HasCreatedTime;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $text = null;

    #[ORM\Column (options:["default"=>false])]
    private ?bool $isSentByAdopter = false;

    #[ORM\ManyToOne(inversedBy: 'messages')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Application $application = null;

    public function getText(): ?string
    {
        return $this->text;
    }

    public function setText(string $text): self
    {
        $this->text = $text;

        return $this;
    }

    public function isIsSentByAdopter(): ?bool
    {
        return $this->isSentByAdopter;
    }

    public function setIsSentByAdopter(bool $isSentByAdopter): self
    {
        $this->isSentByAdopter = $isSentByAdopter;

        return $this;
    }

    public function getApplication(): ?Application
    {
        return $this->application;
    }

    public function setApplication(?Application $application): self
    {
        $this->application = $application;

        return $this;
    }
    public function __toString()
    {
        return $this->getText();
    }
}