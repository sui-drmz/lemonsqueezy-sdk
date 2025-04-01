<?php

namespace Artbees\Lemonsqueezy\Entity;

class Price extends Entity
{
    protected string $type = 'prices';

    /**
     * Define the relationships for this entity
     */
    protected function getRelatedEntityClass(string $relation): ?string
    {
        return match($relation) {
            'product' => Product::class,
            'variant' => Variant::class,
            'subscription_items' => SubscriptionItem::class,
            default => null,
        };
    }

    public function __construct(array $data = [])
    {
        parent::__construct($data);
    }

    public function getProductId(): ?int
    {
        return $this->getAttribute('product_id');
    }

    public function getVariantId(): ?int
    {
        return $this->getAttribute('variant_id');
    }

    public function getName(): ?string
    {
        return $this->getAttribute('name');
    }

    public function getDescription(): ?string
    {
        return $this->getAttribute('description');
    }

    public function getPrice(): ?int
    {
        return $this->getAttribute('price');
    }

    public function getStatus(): ?string
    {
        return $this->getAttribute('status');
    }

    public function getInterval(): ?string
    {
        return $this->getAttribute('interval');
    }

    public function getIntervalCount(): ?int
    {
        return $this->getAttribute('interval_count');
    }

    public function getTrialInterval(): ?string
    {
        return $this->getAttribute('trial_interval');
    }

    public function getTrialIntervalCount(): ?int
    {
        return $this->getAttribute('trial_interval_count');
    }

    public function getPayWhatYouWant(): ?bool
    {
        return $this->getAttribute('pay_what_you_want');
    }

    public function getMinPrice(): ?int
    {
        return $this->getAttribute('min_price');
    }

    public function getSuggestedPrice(): ?int
    {
        return $this->getAttribute('suggested_price');
    }

    public function getCreatedAt(): ?string
    {
        return $this->getAttribute('created_at');
    }

    public function getUpdatedAt(): ?string
    {
        return $this->getAttribute('updated_at');
    }

    public function product(): ?Product
    {
        return $this->getRelationship('product');
    }

    public function variant(): ?Variant
    {
        return $this->getRelationship('variant');
    }

    public function subscriptionItems(): array
    {
        return $this->getRelationship('subscription_items');
    }
} 