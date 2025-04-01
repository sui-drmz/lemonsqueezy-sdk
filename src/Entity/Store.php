<?php

namespace Artbees\Lemonsqueezy\Entity;

class Store extends Entity
{
    protected string $type = 'stores';

    /**
     * Define the relationships for this entity
     */
    protected function getRelatedEntityClass(string $relation): ?string
    {
        return match($relation) {
            'products' => Product::class,
            'orders' => Order::class,
            'subscriptions' => Subscription::class,
            'customers' => Customer::class,
            'discounts' => Discount::class,
            'license_keys' => License::class,
            'webhooks' => Webhook::class,
            'subscription_invoices' => SubscriptionInvoice::class,
            default => null,
        };
    }

    /**
     * Get the store name
     */
    public function name(): ?string
    {
        return $this->name;
    }

    /**
     * Get the store slug
     */
    public function slug(): ?string
    {
        return $this->slug;
    }

    /**
     * Get the store domain
     */
    public function domain(): ?string
    {
        return $this->domain;
    }

    /**
     * Get the store status
     */
    public function status(): ?string
    {
        return $this->status;
    }

    /**
     * Get the store status formatted
     */
    public function statusFormatted(): ?string
    {
        return $this->status_formatted;
    }

    /**
     * Get the store URL
     */
    public function url(): ?string
    {
        return $this->url;
    }

    /**
     * Get the store creation date
     */
    public function createdAt(): ?string
    {
        return $this->created_at;
    }

    /**
     * Get the store last update date
     */
    public function updatedAt(): ?string
    {
        return $this->updated_at;
    }

    /**
     * Get the store tax number
     */
    public function taxNumber(): ?string
    {
        return $this->tax_number;
    }

    /**
     * Get the store tax rate
     */
    public function taxRate(): ?float
    {
        return $this->tax_rate;
    }

    /**
     * Get the store tax region
     */
    public function taxRegion(): ?string
    {
        return $this->tax_region;
    }

    /**
     * Get the store tax zip
     */
    public function taxZip(): ?string
    {
        return $this->tax_zip;
    }

    /**
     * Get the user
     */
    public function user(): ?User
    {
        return $this->getRelatedEntity('user');
    }

    /**
     * Get the products
     */
    public function products(): array
    {
        return $this->getRelatedEntity('products') ?? [];
    }

    /**
     * Get the orders
     */
    public function orders(): array
    {
        return $this->getRelatedEntity('orders') ?? [];
    }

    /**
     * Get the subscriptions
     */
    public function subscriptions(): array
    {
        return $this->getRelatedEntity('subscriptions') ?? [];
    }

    /**
     * Get the customers
     */
    public function customers(): array
    {
        return $this->getRelatedEntity('customers') ?? [];
    }

    /**
     * Get the discounts
     */
    public function discounts(): array
    {
        return $this->getRelatedEntity('discounts') ?? [];
    }

    /**
     * Get the license keys
     */
    public function licenseKeys(): array
    {
        return $this->getRelatedEntity('license_keys') ?? [];
    }

    /**
     * Get the webhooks
     */
    public function webhooks(): array
    {
        return $this->getRelatedEntity('webhooks') ?? [];
    }

    public function subscriptionInvoices(): array
    {
        return $this->getRelatedEntity('subscription_invoices') ?? [];
    }

    public function description(): ?string
    {
        return $this->getAttribute('description');
    }

    public function logoUrl(): ?string
    {
        return $this->getAttribute('logo_url');
    }

    public function bannerUrl(): ?string
    {
        return $this->getAttribute('banner_url');
    }

    public function currency(): string
    {
        return $this->getAttribute('currency');
    }

    public function taxName(): ?string
    {
        return $this->getAttribute('tax_name');
    }

    public function taxAddress(): ?string
    {
        return $this->getAttribute('tax_address');
    }

    public function taxCountry(): ?string
    {
        return $this->getAttribute('tax_country');
    }

    public function taxState(): ?string
    {
        return $this->getAttribute('tax_state');
    }

    public function taxCity(): ?string
    {
        return $this->getAttribute('tax_city');
    }
}
