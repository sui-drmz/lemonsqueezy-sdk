<?php

namespace Artbees\Lemonsqueezy\Entity;

class Subscription extends Entity
{
    protected string $type = 'subscriptions';

    /**
     * Define the relationships for this entity
     */
    protected function getRelatedEntityClass(string $relation): ?string
    {
        return match($relation) {
            'store' => Store::class,
            'customer' => Customer::class,
            'order' => Order::class,
            'order_item' => OrderItem::class,
            'product' => Product::class,
            'variant' => Variant::class,
            'subscription_items' => SubscriptionItem::class,
            'subscription_invoices' => SubscriptionInvoice::class,
            default => null,
        };
    }

    /**
     * Get the subscription status
     */
    public function status(): ?string
    {
        return $this->status;
    }

    /**
     * Get the subscription status formatted
     */
    public function statusFormatted(): ?string
    {
        return $this->status_formatted;
    }

    /**
     * Get the subscription pause
     */
    public function pause(): ?bool
    {
        return $this->pause;
    }

    /**
     * Get the subscription canceled
     */
    public function canceled(): ?bool
    {
        return $this->canceled;
    }

    /**
     * Get the subscription trial ends at
     */
    public function trialEndsAt(): ?string
    {
        return $this->trial_ends_at;
    }

    /**
     * Get the subscription billing anchor
     */
    public function billingAnchor(): ?int
    {
        return $this->billing_anchor;
    }

    /**
     * Get the subscription urls
     */
    public function urls(): ?array
    {
        return $this->urls;
    }

    /**
     * Get the subscription test mode
     */
    public function testMode(): ?bool
    {
        return $this->test_mode;
    }

    /**
     * Get the subscription creation date
     */
    public function createdAt(): ?string
    {
        return $this->created_at;
    }

    /**
     * Get the subscription last update date
     */
    public function updatedAt(): ?string
    {
        return $this->updated_at;
    }

    /**
     * Get the store ID
     */
    public function storeId(): ?int
    {
        return $this->store_id;
    }

    /**
     * Get the customer ID
     */
    public function customerId(): ?int
    {
        return $this->customer_id;
    }

    /**
     * Get the product ID
     */
    public function productId(): ?int
    {
        return $this->product_id;
    }

    /**
     * Get the variant ID
     */
    public function variantId(): ?int
    {
        return $this->variant_id;
    }

    /**
     * Get the order ID
     */
    public function orderId(): ?int
    {
        return $this->order_id;
    }

    /**
     * Get the order item ID
     */
    public function orderItemId(): ?int
    {
        return $this->order_item_id;
    }

    /**
     * Get the product name
     */
    public function productName(): ?string
    {
        return $this->product_name;
    }

    /**
     * Get the variant name
     */
    public function variantName(): ?string
    {
        return $this->variant_name;
    }

    /**
     * Get the card brand
     */
    public function cardBrand(): ?string
    {
        return $this->card_brand;
    }

    /**
     * Get the card last four
     */
    public function cardLastFour(): ?string
    {
        return $this->card_last_four;
    }

    /**
     * Get the subscription renews at
     */
    public function renewsAt(): ?string
    {
        return $this->renews_at;
    }

    /**
     * Get the subscription ends at
     */
    public function endsAt(): ?string
    {
        return $this->ends_at;
    }

    /**
     * Get the store
     */
    public function store(): ?Store
    {
        return $this->getRelationship('store');
    }

    /**
     * Get the customer
     */
    public function customer(): ?Customer
    {
        return $this->getRelationship('customer');
    }

    /**
     * Get the product
     */
    public function product(): ?Product
    {
        return $this->getRelationship('product');
    }

    /**
     * Get the variant
     */
    public function variant(): ?Variant
    {
        return $this->getRelationship('variant');
    }

    /**
     * Get the order
     */
    public function order(): ?Order
    {
        return $this->getRelationship('order');
    }

    /**
     * Get the order item
     */
    public function orderItem(): ?OrderItem
    {
        return $this->getRelationship('order_item');
    }

    /**
     * Get the subscription items
     */
    public function subscriptionItems(): array
    {
        return $this->getRelationship('subscription_items');
    }

    /**
     * Get the subscription invoices
     */
    public function subscriptionInvoices(): array
    {
        return $this->getRelationship('subscription_invoices');
    }
} 