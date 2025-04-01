<?php

namespace Artbees\Lemonsqueezy\Entity;

class Product extends Entity
{
    protected string $type = 'products';

    /**
     * Define the relationships for this entity
     */
    protected function getRelatedEntityClass(string $relation): ?string
    {
        return match($relation) {
            'store' => Store::class,
            'variants' => Variant::class,
            'prices' => Price::class,
            'order_items' => OrderItem::class,
            default => null,
        };
    }

    /**
     * Get the store
     */
    public function store(): ?Store
    {
        return $this->getRelatedEntity('store');
    }

    /**
     * Get the variants
     */
    public function variants(): array
    {
        return $this->getRelatedEntity('variants') ?? [];
    }

    /**
     * Get the prices
     */
    public function prices(): array
    {
        return $this->getRelatedEntity('prices') ?? [];
    }

    /**
     * Get the order items
     */
    public function orderItems(): array
    {
        return $this->getRelatedEntity('order_items') ?? [];
    }
} 