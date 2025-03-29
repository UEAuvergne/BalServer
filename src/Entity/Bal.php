<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\BalRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BalRepository::class)]
#[ApiResource]
class Bal
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\ManyToOne(inversedBy: 'bourses')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $creator = null;

    /**
     * @var Collection<int, BookInstance>
     */
    #[ORM\OneToMany(targetEntity: BookInstance::class, mappedBy: 'bal', orphanRemoval: true)]
    private Collection $books;

    public function __construct()
    {
        $this->books = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getCreator(): ?User
    {
        return $this->creator;
    }

    public function setCreator(?User $creator): static
    {
        $this->creator = $creator;

        return $this;
    }

    /**
     * @return Collection<int, BookInstance>
     */
    public function getBooks(): Collection
    {
        return $this->books;
    }

    public function addBook(BookInstance $book): static
    {
        if (!$this->books->contains($book)) {
            $this->books->add($book);
            $book->setBal($this);
        }

        return $this;
    }

    public function removeBook(BookInstance $book): static
    {
        if ($this->books->removeElement($book)) {
            // set the owning side to null (unless already changed)
            if ($book->getBal() === $this) {
                $book->setBal(null);
            }
        }

        return $this;
    }
}
