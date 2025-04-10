<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Data\BookStatus;
use App\Repository\BookInstanceRepository;
use Doctrine\ORM\Mapping as ORM;

#[ApiResource()]
#[ORM\Entity(repositoryClass: BookInstanceRepository::class)]
class BookInstance
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $price = null;

    #[ORM\Column(nullable: false)]
    private ?int $soldPrice = null;

    #[ORM\Column(enumType: BookStatus::class)]
    private ?BookStatus $status = null;

    #[ORM\ManyToOne(inversedBy: 'instances')]
    #[ORM\JoinColumn(nullable: false, referencedColumnName: 'id')]
    private ?Book $data = null;

    #[ORM\ManyToOne(inversedBy: 'books')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Owner $owner = null;

    #[ORM\ManyToOne(inversedBy: 'books')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Bal $bal = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(int $price): static
    {
        $this->price = $price;

        return $this;
    }

    public function getSoldPrice(): ?int
    {
        return $this->soldPrice;
    }

    public function setSoldPrice(int $price): static
    {
        $this->soldPrice = $price;

        return $this;
    }

    public function getStatus(): ?BookStatus
    {
        return $this->status;
    }

    public function setStatus(BookStatus $status): static
    {
        $this->status = $status;

        return $this;
    }

    public function getData(): ?Book
    {
        return $this->data;
    }

    public function setData(?Book $data): static
    {
        $this->data = $data;

        return $this;
    }

    public function getOwner(): ?Owner
    {
        return $this->owner;
    }

    public function setOwner(?Owner $owner): static
    {
        $this->owner = $owner;

        return $this;
    }

    public function getBal(): ?Bal
    {
        return $this->bal;
    }

    public function setBal(?Bal $bal): static
    {
        $this->bal = $bal;

        return $this;
    }
}
