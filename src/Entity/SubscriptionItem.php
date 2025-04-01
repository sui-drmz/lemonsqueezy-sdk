<?php

namespace Artbees\Lemonsqueezy\Entity;

class SubscriptionItem extends Entity
{
    protected string $type = 'subscription_items';

    /**
     * Define the relationships for this entity
     */
    protected function getRelatedEntityClass(string $relation): ?string
    {
        return match($relation) {
            'store' => Store::class,
            'subscription' => Subscription::class,
            'price' => Price::class,
            'usage_records' => UsageRecord::class,
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
     * Get the subscription
     */
    public function subscription(): ?Subscription
    {
        return $this->getRelatedEntity('subscription');
    }

    /**
     * Get the price
     */
    public function price(): ?Price
    {
        return $this->getRelatedEntity('price');
    }

    /**
     * Get the usage records
     */
    public function usageRecords(): array
    {
        return $this->getRelatedEntity('usage_records') ?? [];
    }
} 