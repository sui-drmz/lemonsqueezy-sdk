<?php

namespace Artbees\Lemonsqueezy\Traits;

use Artbees\Lemonsqueezy\Entity\Customer;
use Artbees\Lemonsqueezy\Entity\License;
use Artbees\Lemonsqueezy\Entity\Order;
use Artbees\Lemonsqueezy\Entity\OrderItem;
use Artbees\Lemonsqueezy\Entity\Product;
use Artbees\Lemonsqueezy\Entity\Store;
use Artbees\Lemonsqueezy\Entity\Subscription;
use Artbees\Lemonsqueezy\Entity\Variant;

trait HasRelationships
{
    /**
     * Define the relationships between resources
     * 
     * @return array<string, array<string, string>>
     */
    protected static function relationships(): array
    {
        return [
            // Store relationships
            Store::class => [
                'products' => Product::class,
                'customers' => Customer::class,
                'orders' => Order::class,
                'subscriptions' => Subscription::class,
                'subscription_invoices' => 'subscription_invoices',
                'webhooks' => 'webhooks',
            ],

            // Order relationships
            Order::class => [
                'store' => Store::class,
                'customer' => Customer::class,
                'order-items' => OrderItem::class,
                'subscriptions' => Subscription::class,
                'license-keys' => License::class,
            ],

            // OrderItem relationships
            OrderItem::class => [
                'order' => Order::class,
                'product' => Product::class,
                'variant' => Variant::class,
            ],

            // Product relationships
            Product::class => [
                'store' => Store::class,
                'variants' => Variant::class,
                'files' => 'files',
                'prices' => 'prices',
            ],

            // Subscription relationships
            Subscription::class => [
                'store' => Store::class,
                'customer' => Customer::class,
                'order' => Order::class,
                'order_item' => OrderItem::class,
                'product' => Product::class,
                'variant' => Variant::class,
            ],

            // License relationships
            License::class => [
                'order' => Order::class,
                'product' => Product::class,
                'customer' => Customer::class,
            ],
        ];
    }

    /**
     * Get the related entity class for a relationship
     * 
     * @param string $entityClass
     * @param string $relation
     * @return string|null
     */
    public static function getRelatedEntityClass(string $entityClass, string $relation): ?string
    {
        return self::relationships()[$entityClass][$relation] ?? null;
    }

    /**
     * Get all available relationships for an entity
     * 
     * @param string $entityClass
     * @return array<string, string>
     */
    public static function getEntityRelationships(string $entityClass): array
    {
        return self::relationships()[$entityClass] ?? [];
    }
} 