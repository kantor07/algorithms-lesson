<?php

namespace App\Entity;

use App\Repository\PublishingHousesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PublishingHousesRepository::class)]
class PublishingHouses
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $name;

    #[ORM\Column(type: 'string', length: 255)]
    private $city;

    #[ORM\OneToMany(mappedBy: 'publishingHouses', targetEntity: Book::class)]
    private $book_id;

    public function __construct()
    {
        $this->book_id = new ArrayCollection();
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

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): self
    {
        $this->city = $city;

        return $this;
    }

    /**
     * @return Collection|Book[]
     */
    public function getBookId(): Collection
    {
        return $this->book_id;
    }

    public function addBookId(Book $bookId): self
    {
        if (!$this->book_id->contains($bookId)) {
            $this->book_id[] = $bookId;
            $bookId->setPublishingHouses($this);
        }

        return $this;
    }

    public function removeBookId(Book $bookId): self
    {
        if ($this->book_id->removeElement($bookId)) {
            // set the owning side to null (unless already changed)
            if ($bookId->getPublishingHouses() === $this) {
                $bookId->setPublishingHouses(null);
            }
        }

        return $this;
    }
}
