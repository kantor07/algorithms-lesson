<?php

namespace App\Entity;

use App\Repository\AuthorRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AuthorRepository::class)]
class Author
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $name;

    #[ORM\Column(type: 'string', length: 255)]
    private $surname;

    #[ORM\Column(type: 'text', nullable: true)]
    private $description;

    #[ORM\ManyToMany(targetEntity: Book::class, mappedBy: 'authors')]
    private $books_id;

    public function __construct()
    {
        $this->books_id = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getSurname(): ?string
    {
        return $this->surname;
    }

    public function setSurname(string $surname): self
    {
        $this->surname = $surname;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection|Book[]
     */
    public function getBooksId(): Collection
    {
        return $this->books_id;
    }

    public function addBooksId(Book $booksId): self
    {
        if (!$this->books_id->contains($booksId)) {
            $this->books_id[] = $booksId;
            $booksId->addAuthor($this);
        }

        return $this;
    }

    public function removeBooksId(Book $booksId): self
    {
        if ($this->books_id->removeElement($booksId)) {
            $booksId->removeAuthor($this);
        }

        return $this;
    }
}
