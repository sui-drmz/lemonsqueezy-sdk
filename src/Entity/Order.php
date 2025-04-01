<?php

namespace Artbees\Lemonsqueezy\Entity;

class Order extends Entity
{
    protected string $type = 'orders';

    /**
     * Define the relationships for this entity
     */
    protected function getRelatedEntityClass(string $relation): ?string
    {
        return match($relation) {
            'store' => Store::class,
            'customer' => Customer::class,
            'order-items' => OrderItem::class,
            'subscriptions' => Subscription::class,
            'license-keys' => License::class,
            default => null,
        };
    }

    /**
     * Get the order number
     */
    public function orderNumber(): ?int
    {
        return $this->order_number;
    }

    /**
     * Get the order status
     */
    public function status(): ?string
    {
        return $this->status;
    }

    /**
     * Get the order total
     */
    public function total(): ?int
    {
        return $this->total;
    }

    /**
     * Get the order currency
     */
    public function currency(): ?string
    {
        return $this->currency;
    }

    /**
     * Get the order tax
     */
    public function tax(): ?int
    {
        return $this->tax;
    }

    /**
     * Get the order tax rate
     */
    public function taxRate(): ?float
    {
        return $this->tax_rate;
    }

    /**
     * Get the order subtotal
     */
    public function subtotal(): ?int
    {
        return $this->subtotal;
    }

    /**
     * Get the order discount total
     */
    public function discountTotal(): ?int
    {
        return $this->discount_total;
    }

    /**
     * Get the order total formatted
     */
    public function totalFormatted(): ?string
    {
        return $this->total_formatted;
    }

    /**
     * Get the order subtotal formatted
     */
    public function subtotalFormatted(): ?string
    {
        return $this->subtotal_formatted;
    }

    /**
     * Get the order tax formatted
     */
    public function taxFormatted(): ?string
    {
        return $this->tax_formatted;
    }

    /**
     * Get the order discount total formatted
     */
    public function discountTotalFormatted(): ?string
    {
        return $this->discount_total_formatted;
    }

    /**
     * Get the order URL
     */
    public function url(): ?string
    {
        return $this->url;
    }

    /**
     * Get the order creation date
     */
    public function createdAt(): ?string
    {
        return $this->created_at;
    }

    /**
     * Get the order last update date
     */
    public function updatedAt(): ?string
    {
        return $this->updated_at;
    }

    /**
     * Get the order items
     */
    public function orderItems(): array
    {
        return $this->getRelatedEntity('order-items') ?? [];
    }

    /**
     * Get the store
     */
    public function store(): ?Store
    {
        return $this->getRelatedEntity('store');
    }

    /**
     * Get the customer
     */
    public function customer(): ?Customer
    {
        return $this->getRelatedEntity('customer');
    }

    /**
     * Get the subscriptions
     */
    public function subscriptions(): array
    {
        return $this->getRelatedEntity('subscriptions') ?? [];
    }

    /**
     * Get the license keys
     */
    public function licenseKeys(): array
    {
        return $this->getRelatedEntity('license-keys') ?? [];
    }
} 