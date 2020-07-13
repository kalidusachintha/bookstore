<?php

namespace App\Entity;

use App\Repository\BooksRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=BooksRepository::class)
 */
class Books
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=BooksCategory::class, inversedBy="books")
     * @ORM\JoinColumn(nullable=false)
     */
    private $books_category;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $book_name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $book_image;

    /**
     * @ORM\Column(type="boolean")
     */
    private $status;

    /**
     * @ORM\Column(type="float")
     */
    private $price;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="integer")
     */
    private $stock;

    /**
     * @ORM\Column(type="date" ,nullable=true)
     */
    private $added_date;

    /**
     * @ORM\OneToMany(targetEntity=QuoteOrderItem::class, mappedBy="book_id")
     */
    private $quoteOrderItems;

    public function __construct()
    {
        $this->quoteOrderItems = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBooksCategory(): ?BooksCategory
    {
        return $this->books_category;
    }

    public function setBooksCategory(?BooksCategory $books_category): self
    {
        $this->books_category = $books_category;

        return $this;
    }

    public function getBookName(): ?string
    {
        return $this->book_name;
    }

    public function setBookName(string $book_name): self
    {
        $this->book_name = $book_name;

        return $this;
    }

    public function getBookImage(): ?string
    {
        return $this->book_image;
    }

    public function setBookImage(string $book_image): self
    {
        $this->book_image = $book_image;

        return $this;
    }

    public function getStatus(): ?bool
    {
        return $this->status;
    }

    public function setStatus(bool $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): self
    {
        $this->price = $price;

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

    public function getStock(): ?int
    {
        return $this->stock;
    }

    public function setStock(int $stock): self
    {
        $this->stock = $stock;

        return $this;
    }

    public function getAddedDate(): ?\DateTimeInterface
    {
        return $this->added_date;
    }

    public function setAddedDate(\DateTimeInterface $added_date): self
    {
        $this->added_date = $added_date;

        return $this;
    }

    /**
     * @return Collection|QuoteOrderItem[]
     */
    public function getQuoteOrderItems(): Collection
    {
        return $this->quoteOrderItems;
    }

    public function addQuoteOrderItem(QuoteOrderItem $quoteOrderItem): self
    {
        if (!$this->quoteOrderItems->contains($quoteOrderItem)) {
            $this->quoteOrderItems[] = $quoteOrderItem;
            $quoteOrderItem->setBookId($this);
        }

        return $this;
    }

    public function removeQuoteOrderItem(QuoteOrderItem $quoteOrderItem): self
    {
        if ($this->quoteOrderItems->contains($quoteOrderItem)) {
            $this->quoteOrderItems->removeElement($quoteOrderItem);
            // set the owning side to null (unless already changed)
            if ($quoteOrderItem->getBookId() === $this) {
                $quoteOrderItem->setBookId(null);
            }
        }

        return $this;
    }
}
