<?php

namespace App\Entity;

use App\Repository\CouponCodeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CouponCodeRepository::class)
 */
class CouponCode
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
    private $codename;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $code;

    /**
     * @ORM\Column(type="float")
     */
    private $discount;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $createddate;

    /**
     * @ORM\OneToMany(targetEntity=QuoteOrder::class, mappedBy="discount")
     */
    private $quoteOrders;

    public function __construct()
    {
        $this->quoteOrders = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCodename(): ?string
    {
        return $this->codename;
    }

    public function setCodename(string $codename): self
    {
        $this->codename = $codename;

        return $this;
    }

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(string $code): self
    {
        $this->code = $code;

        return $this;
    }

    public function getDiscount(): ?float
    {
        return $this->discount;
    }

    public function setDiscount(float $discount): self
    {
        $this->discount = $discount;

        return $this;
    }

    public function getCreateddate(): ?\DateTimeInterface
    {
        return $this->createddate;
    }

    public function setCreateddate(?\DateTimeInterface $createddate): self
    {
        $this->createddate = $createddate;

        return $this;
    }

    /**
     * @return Collection|QuoteOrder[]
     */
    public function getQuoteOrders(): Collection
    {
        return $this->quoteOrders;
    }

    public function addQuoteOrder(QuoteOrder $quoteOrder): self
    {
        if (!$this->quoteOrders->contains($quoteOrder)) {
            $this->quoteOrders[] = $quoteOrder;
            $quoteOrder->setDiscount($this);
        }

        return $this;
    }

    public function removeQuoteOrder(QuoteOrder $quoteOrder): self
    {
        if ($this->quoteOrders->contains($quoteOrder)) {
            $this->quoteOrders->removeElement($quoteOrder);
            // set the owning side to null (unless already changed)
            if ($quoteOrder->getDiscount() === $this) {
                $quoteOrder->setDiscount(null);
            }
        }

        return $this;
    }
}
