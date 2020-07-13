<?php

namespace App\Entity;

use App\Repository\QuoteOrderRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=QuoteOrderRepository::class)
 */
class QuoteOrder
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $order_session_id;

    /**
     * @ORM\Column(type="float")
     */
    private $order_total;

    /**
     * @ORM\Column(type="integer")
     */
    private $order_qty;

    /**
     * @ORM\ManyToOne(targetEntity=CouponCode::class, inversedBy="quoteOrders")
     */
    private $discount;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $updated_date;

    /**
     * @ORM\OneToMany(targetEntity=QuoteOrderItem::class, mappedBy="quote_order_id")
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

    public function getOrderSessionId(): ?string
    {
        return $this->order_session_id;
    }

    public function setOrderSessionId(string $order_session_id): self
    {
        $this->order_session_id = $order_session_id;

        return $this;
    }

    public function getOrderTotal(): ?float
    {
        return $this->order_total;
    }

    public function setOrderTotal(float $order_total): self
    {
        $this->order_total = $order_total;

        return $this;
    }

    public function getOrderQty(): ?int
    {
        return $this->order_qty;
    }

    public function setOrderQty(int $order_qty): self
    {
        $this->order_qty = $order_qty;

        return $this;
    }

    public function getDiscount(): ?CouponCode
    {
        return $this->discount;
    }

    public function setDiscount(?CouponCode $discount): self
    {
        $this->discount = $discount;

        return $this;
    }

    public function getUpdatedDate(): ?\DateTimeInterface
    {
        return $this->updated_date;
    }

    public function setUpdatedDate(?\DateTimeInterface $updated_date): self
    {
        $this->updated_date = $updated_date;

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
            $quoteOrderItem->setQuoteOrderId($this);
        }

        return $this;
    }

    public function removeQuoteOrderItem(QuoteOrderItem $quoteOrderItem): self
    {
        if ($this->quoteOrderItems->contains($quoteOrderItem)) {
            $this->quoteOrderItems->removeElement($quoteOrderItem);
            // set the owning side to null (unless already changed)
            if ($quoteOrderItem->getQuoteOrderId() === $this) {
                $quoteOrderItem->setQuoteOrderId(null);
            }
        }

        return $this;
    }
}
