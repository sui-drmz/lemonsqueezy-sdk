<?php

namespace Artbees\Lemonsqueezy\Entity;

class UsageRecord extends Entity
{
    protected string $type = 'usage_records';

    /**
     * Define the relationships for this entity
     */
    protected function getRelatedEntityClass(string $relation): ?string
    {
        return match($relation) {
            'subscription_item' => SubscriptionItem::class,
            default => null,
        };
    }

    public function subscriptionItem(): ?SubscriptionItem
    {
        return $this->getRelationship('subscription_item');
    }
} 