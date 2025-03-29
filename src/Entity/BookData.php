<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\BookDataRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ApiResource]
#[ORM\Entity(repositoryClass: BookDataRepository::class)]
class BookData
{
    #[ORM\Id]
    #[ORM\Column]
    private ?string $ean = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $authorName = null;

    /**
     * @var Collection<int, BookInstance>
     */
    #[ORM\OneToMany(targetEntity: BookInstance::class, mappedBy: 'data', orphanRemoval: true)]
    private Collection $instances;

    public function __construct()
    {
        $this->instances = new ArrayCollection();
    }
    
    public function getEan(): ?string
    {
        return $this->ean;
    }
    
    public function setEan(string $ean)
    {
        $this->ean = $ean;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getAuthorName(): ?string
    {
        return $this->authorName;
    }

    public function setAuthorName(?string $author_name): static
    {
        $this->authorName = $author_name;

        return $this;
    }

    /**
     * @return Collection<int, BookInstance>
     */
    public function getInstances(): Collection
    {
        return $this->instances;
    }

    public function addBookInstance(BookInstance $bookInstance): static
    {
        if (!$this->instances->contains($bookInstance)) {
            $this->instances->add($bookInstance);
            $bookInstance->setData($this);
        }

        return $this;
    }

    public function removeBookInstance(BookInstance $bookInstance): static
    {
        if ($this->instances->removeElement($bookInstance)) {
            // set the owning side to null (unless already changed)
            if ($bookInstance->getData() === $this) {
                $bookInstance->setData(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this->getAuthorName() ? "{$this->getTitle()} ({$this->getAuthorName()})" : $this->getTitle();
    }
}
