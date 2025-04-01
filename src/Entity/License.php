<?php

namespace Artbees\Lemonsqueezy\Entity;

class License extends Entity
{
    protected string $type = 'licenses';

    /**
     * Define the relationships for this entity
     */
    protected function getRelatedEntityClass(string $relation): ?string
    {
        return match($relation) {
            'store' => Store::class,
            'order' => Order::class,
            'order_item' => OrderItem::class,
            'product' => Product::class,
            'variant' => Variant::class,
            'subscription' => Subscription::class,
            'customer' => Customer::class,
            default => null,
        };
    }

    /**
     * Get the license key
     */
    public function key(): ?string
    {
        return $this->key;
    }

    /**
     * Get the license status
     */
    public function status(): ?string
    {
        return $this->status;
    }

    /**
     * Get the license status formatted
     */
    public function statusFormatted(): ?string
    {
        return $this->status_formatted;
    }

    /**
     * Get the license activation limit
     */
    public function activationLimit(): ?int
    {
        return $this->activation_limit;
    }

    /**
     * Get the license activation usage
     */
    public function activationUsage(): ?int
    {
        return $this->activation_usage;
    }

    /**
     * Get the license activation limit per license
     */
    public function activationLimitPerLicense(): ?int
    {
        return $this->activation_limit_per_license;
    }

    /**
     * Get the license activation limit per license usage
     */
    public function activationLimitPerLicenseUsage(): ?int
    {
        return $this->activation_limit_per_license_usage;
    }

    /**
     * Get the license disabled
     */
    public function disabled(): ?bool
    {
        return $this->disabled;
    }

    /**
     * Get the license expires at
     */
    public function expiresAt(): ?string
    {
        return $this->expires_at;
    }

    /**
     * Get the license order ID
     */
    public function orderId(): ?int
    {
        return $this->order_id;
    }

    /**
     * Get the license product ID
     */
    public function productId(): ?int
    {
        return $this->product_id;
    }

    /**
     * Get the license customer ID
     */
    public function customerId(): ?int
    {
        return $this->customer_id;
    }

    /**
     * Get the license creation date
     */
    public function createdAt(): ?string
    {
        return $this->created_at;
    }

    /**
     * Get the license last update date
     */
    public function updatedAt(): ?string
    {
        return $this->updated_at;
    }

    /**
     * Get the store
     */
    public function store(): ?Store
    {
        return $this->getRelationship('store');
    }

    /**
     * Get the order
     */
    public function order(): ?Order
    {
        return $this->getRelationship('order');
    }

    /**
     * Get the order item
     */
    public function orderItem(): ?OrderItem
    {
        return $this->getRelationship('order_item');
    }

    /**
     * Get the product
     */
    public function product(): ?Product
    {
        return $this->getRelationship('product');
    }

    /**
     * Get the variant
     */
    public function variant(): ?Variant
    {
        return $this->getRelationship('variant');
    }

    /**
     * Get the subscription
     */
    public function subscription(): ?Subscription
    {
        return $this->getRelatedEntity('subscription');
    }

    /**
     * Get the customer
     */
    public function customer(): ?Customer
    {
        return $this->getRelatedEntity('customer');
    }
} 