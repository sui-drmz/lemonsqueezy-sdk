<?php

namespace Artbees\Lemonsqueezy\Entity;

class Discount extends Entity
{
    protected string $type = 'discounts';

    /**
     * Define the relationships for this entity
     */
    protected function getRelatedEntityClass(string $relation): ?string
    {
        return match($relation) {
            'store' => Store::class,
            default => null,
        };
    }

    public function __construct(array $data = [])
    {
        parent::__construct($data);
    }

    public function store(): ?Store
    {
        return $this->getRelationship('store');
    }
} 