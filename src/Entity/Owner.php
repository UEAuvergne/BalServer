<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\OwnerRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ApiResource]
#[ORM\Entity(repositoryClass: OwnerRepository::class)]
class Owner
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $first_name = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $last_name = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $contact = null;

    /**
     * @var Collection<int, BookInstance>
     */
    #[ORM\OneToMany(targetEntity: BookInstance::class, mappedBy: 'owner', orphanRemoval: true)]
    private Collection $books;

    public function getBooksValue(): ?int
    {
        return $this->getBookInstances()->reduce(function($carry, BookInstance $item){$carry += $item->getSoldPrice();return $carry;});
    }

    public function __construct()
    {
        $this->books = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstName(): ?string
    {
        return $this->first_name;
    }

    public function setFirstName(?string $first_name): static
    {
        $this->first_name = $first_name;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->last_name;
    }

    public function setLastName(?string $last_name): static
    {
        $this->last_name = $last_name;

        return $this;
    }

    public function getContact(): ?string
    {
        return $this->contact;
    }

    public function setContact(?string $contact): static
    {
        $this->contact = $contact;

        return $this;
    }

    /**
     * @return Collection<int, BookInstance>
     */
    public function getBookInstances(): Collection
    {
        return $this->books;
    }

    public function addBookInstance(BookInstance $bookInstance): static
    {
        if (!$this->books->contains($bookInstance)) {
            $this->books->add($bookInstance);
            $bookInstance->setOwner($this);
        }

        return $this;
    }

    public function removeBookInstance(BookInstance $bookInstance): static
    {
        if ($this->books->removeElement($bookInstance)) {
            // set the owning side to null (unless already changed)
            if ($bookInstance->getOwner() === $this) {
                $bookInstance->setOwner(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this->getFirstName() . ' ' . $this->getLastName() . ' (' . $this->getContact() . ')';
    }
}
