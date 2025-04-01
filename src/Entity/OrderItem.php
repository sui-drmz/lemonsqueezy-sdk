<?php

namespace Artbees\Lemonsqueezy\Entity;

class OrderItem extends Entity
{
    protected string $type = 'order_items';

    /**
     * Define the relationships for this entity
     */
    protected function getRelatedEntityClass(string $relation): ?string
    {
        return match($relation) {
            'order' => Order::class,
            'product' => Product::class,
            'variant' => Variant::class,
            default => null,
        };
    }

    /**
     * Get the order ID
     */
    public function orderId(): ?int
    {
        return $this->order_id;
    }

    /**
     * Get the product ID
     */
    public function productId(): ?int
    {
        return $this->product_id;
    }

    /**
     * Get the variant ID
     */
    public function variantId(): ?int
    {
        return $this->variant_id;
    }

    /**
     * Get the product name
     */
    public function productName(): ?string
    {
        return $this->product_name;
    }

    /**
     * Get the variant name
     */
    public function variantName(): ?string
    {
        return $this->variant_name;
    }

    /**
     * Get the price
     */
    public function price(): ?int
    {
        return $this->price;
    }

    /**
     * Get the quantity
     */
    public function quantity(): ?int
    {
        return $this->quantity;
    }

    /**
     * Get the creation date
     */
    public function createdAt(): ?string
    {
        return $this->created_at;
    }

    /**
     * Get the last update date
     */
    public function updatedAt(): ?string
    {
        return $this->updated_at;
    }

    public function order(): ?Order
    {
        return $this->getRelationship('order');
    }

    public function product(): ?Product
    {
        return $this->getRelationship('product');
    }

    public function variant(): ?Variant
    {
        return $this->getRelationship('variant');
    }
} 