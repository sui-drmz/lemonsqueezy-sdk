<?php

namespace Artbees\Lemonsqueezy\Entity;

class SubscriptionInvoice extends Entity
{
    protected string $type = 'subscription_invoices';

    /**
     * Define the relationships for this entity
     */
    protected function getRelatedEntityClass(string $relation): ?string
    {
        return match($relation) {
            'subscription' => Subscription::class,
            'store' => Store::class,
            default => null,
        };
    }

    public function subscription(): ?Subscription
    {
        return $this->getRelationship('subscription');
    }

    public function store(): ?Store
    {
        return $this->getRelationship('store');
    }
} 