<?php

namespace Artbees\Lemonsqueezy\Entity;

class Customer extends Entity
{
    protected string $type = 'customers';

    /**
     * Define the relationships for this entity
     */
    protected function getRelatedEntityClass(string $relation): ?string
    {
        return match($relation) {
            'store' => Store::class,
            'orders' => Order::class,
            'subscriptions' => Subscription::class,
            'license_keys' => License::class,
            default => null,
        };
    }

    /**
     * Get the customer name
     */
    public function name(): ?string
    {
        return $this->name;
    }

    /**
     * Get the customer email
     */
    public function email(): ?string
    {
        return $this->email;
    }

    /**
     * Get the customer status
     */
    public function status(): ?string
    {
        return $this->status;
    }

    /**
     * Get the customer status formatted
     */
    public function statusFormatted(): ?string
    {
        return $this->status_formatted;
    }

    /**
     * Get the customer city
     */
    public function city(): ?string
    {
        return $this->city;
    }

    /**
     * Get the customer region
     */
    public function region(): ?string
    {
        return $this->region;
    }

    /**
     * Get the customer country
     */
    public function country(): ?string
    {
        return $this->country;
    }

    /**
     * Get the customer total revenue
     */
    public function totalRevenue(): ?int
    {
        return $this->total_revenue;
    }

    /**
     * Get the customer mrr
     */
    public function mrr(): ?int
    {
        return $this->mrr;
    }

    /**
     * Get the customer test mode
     */
    public function testMode(): ?bool
    {
        return $this->test_mode;
    }

    /**
     * Get the customer creation date
     */
    public function createdAt(): ?string
    {
        return $this->created_at;
    }

    /**
     * Get the customer last update date
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
     * Get the orders
     */
    public function orders(): array
    {
        return $this->getRelationship('orders');
    }

    /**
     * Get the subscriptions
     */
    public function subscriptions(): array
    {
        return $this->getRelationship('subscriptions');
    }

    /**
     * Get the license keys
     */
    public function licenseKeys(): array
    {
        return $this->getRelationship('license_keys');
    }
} 