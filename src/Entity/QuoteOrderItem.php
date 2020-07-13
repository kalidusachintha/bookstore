<?php

namespace App\Entity;

use App\Repository\QuoteOrderItemRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=QuoteOrderItemRepository::class)
 */
class QuoteOrderItem
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=QuoteOrder::class, inversedBy="quoteOrderItems")
     * @ORM\JoinColumn(nullable=false)
     */
    private $quote_order_id;

    /**
     * @ORM\ManyToOne(targetEntity=Books::class, inversedBy="quoteOrderItems")
     * @ORM\JoinColumn(nullable=false)
     */
    private $book_id;

    /**
     * @ORM\Column(type="integer")
     */
    private $qty;

    /**
     * @ORM\Column(type="float")
     */
    private $price;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $create_date;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQuoteOrderId(): ?QuoteOrder
    {
        return $this->quote_order_id;
    }

    public function setQuoteOrderId(?QuoteOrder $quote_order_id): self
    {
        $this->quote_order_id = $quote_order_id;

        return $this;
    }

    public function getBookId(): ?Books
    {
        return $this->book_id;
    }

    public function setBookId(?Books $book_id): self
    {
        $this->book_id = $book_id;

        return $this;
    }

    public function getQty(): ?int
    {
        return $this->qty;
    }

    public function setQty(int $qty): self
    {
        $this->qty = $qty;

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

    public function getCreateDate(): ?\DateTimeInterface
    {
        return $this->create_date;
    }

    public function setCreateDate(?\DateTimeInterface $create_date): self
    {
        $this->create_date = $create_date;

        return $this;
    }
}
