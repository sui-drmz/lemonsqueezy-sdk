<?php

namespace Artbees\Lemonsqueezy\Entity;

class Checkout extends Entity
{
    protected string $type = 'checkouts';

    /**
     * Define the relationships for this entity
     */
    protected function getRelatedEntityClass(string $relation): ?string
    {
        return match($relation) {
            'store' => Store::class,
            'variant' => Variant::class,
            'order' => Order::class,
            default => null,
        };
    }

    public function store(): ?Store
    {
        return $this->getRelationship('store');
    }

    public function variant(): ?Variant
    {
        return $this->getRelationship('variant');
    }

    public function order(): ?Order
    {
        return $this->getRelationship('order');
    }
} 