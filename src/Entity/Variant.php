<?php

namespace Artbees\Lemonsqueezy\Entity;

class Variant extends Entity
{
    protected string $type = 'variants';

    /**
     * Define the relationships for this entity
     */
    protected function getRelatedEntityClass(string $relation): ?string
    {
        return match($relation) {
            'store' => Store::class,
            'product' => Product::class,
            'prices' => Price::class,
            'order_items' => OrderItem::class,
            'license_keys' => License::class,
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
     * Get the product
     */
    public function product(): ?Product
    {
        return $this->getRelatedEntity('product');
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

    /**
     * Get the license keys
     */
    public function licenseKeys(): array
    {
        return $this->getRelatedEntity('license_keys') ?? [];
    }

    /**
     * Get the variant name
     */
    public function name(): ?string
    {
        return $this->name;
    }

    /**
     * Get the variant description
     */
    public function description(): ?string
    {
        return $this->description;
    }

    /**
     * Get the variant status
     */
    public function status(): ?string
    {
        return $this->status;
    }

    /**
     * Get the variant status formatted
     */
    public function statusFormatted(): ?string
    {
        return $this->status_formatted;
    }

    /**
     * Get the variant price
     */
    public function price(): ?int
    {
        return $this->price;
    }

    /**
     * Get the variant price formatted
     */
    public function priceFormatted(): ?string
    {
        return $this->price_formatted;
    }

    /**
     * Get the variant compare at price
     */
    public function compareAtPrice(): ?int
    {
        return $this->compare_at_price;
    }

    /**
     * Get the variant compare at price formatted
     */
    public function compareAtPriceFormatted(): ?string
    {
        return $this->compare_at_price_formatted;
    }

    /**
     * Get the variant is subscription
     */
    public function isSubscription(): ?bool
    {
        return $this->is_subscription;
    }

    /**
     * Get the variant interval
     */
    public function interval(): ?string
    {
        return $this->interval;
    }

    /**
     * Get the variant interval count
     */
    public function intervalCount(): ?int
    {
        return $this->interval_count;
    }

    /**
     * Get the variant has free trial
     */
    public function hasFreeTrial(): ?bool
    {
        return $this->has_free_trial;
    }

    /**
     * Get the variant trial interval
     */
    public function trialInterval(): ?string
    {
        return $this->trial_interval;
    }

    /**
     * Get the variant trial interval count
     */
    public function trialIntervalCount(): ?int
    {
        return $this->trial_interval_count;
    }

    /**
     * Get the variant trial ends at
     */
    public function trialEndsAt(): ?string
    {
        return $this->trial_ends_at;
    }

    /**
     * Get the variant pay what you want
     */
    public function payWhatYouWant(): ?bool
    {
        return $this->pay_what_you_want;
    }

    /**
     * Get the variant minimum price
     */
    public function minimumPrice(): ?int
    {
        return $this->minimum_price;
    }

    /**
     * Get the variant suggested price
     */
    public function suggestedPrice(): ?int
    {
        return $this->suggested_price;
    }

    /**
     * Get the variant sales count
     */
    public function salesCount(): ?int
    {
        return $this->sales_count;
    }

    /**
     * Get the variant creation date
     */
    public function createdAt(): ?string
    {
        return $this->created_at;
    }

    /**
     * Get the variant last update date
     */
    public function updatedAt(): ?string
    {
        return $this->updated_at;
    }

    /**
     * Get the subscriptions
     */
    public function subscriptions(): array
    {
        return $this->getRelatedEntity('subscriptions') ?? [];
    }

    public function checkouts(): array
    {
        return $this->getRelatedEntity('checkouts') ?? [];
    }
} 