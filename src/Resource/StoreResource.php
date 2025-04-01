<?php

namespace Artbees\Lemonsqueezy\Resource;

use Artbees\Lemonsqueezy\Client;
use Artbees\Lemonsqueezy\Entity\Store;
use Artbees\Lemonsqueezy\Response\PaginatedResponse;

class StoreResource extends Resource
{
    public function __construct(Client $client)
    {
        parent::__construct($client);
        $this->endpoint = 'stores';
        $this->entityClass = Store::class;
        $this->availableIncludes = [
            'products',
            'customers',
            'orders',
            'subscriptions',
            'subscription_invoices',
            'webhooks'
        ];
        $this->supportedOperations = [
            'list' => true,
            'retrieve' => true,
            'create' => false,
            'update' => false,
            'delete' => false,
        ];
    }

    /**
     * Get all products for a store
     *
     * @param string $id
     * @param array $query
     * @return PaginatedResponse
     */
    public function products(string $id, array $query = []): PaginatedResponse
    {
        return $this->related($id, 'products', $query);
    }

    /**
     * Get all customers for a store
     *
     * @param string $id
     * @param array $query
     * @return PaginatedResponse
     */
    public function customers(string $id, array $query = []): PaginatedResponse
    {
        return $this->related($id, 'customers', $query);
    }

    /**
     * Get all orders for a store
     *
     * @param string $id
     * @param array $query
     * @return PaginatedResponse
     */
    public function orders(string $id, array $query = []): PaginatedResponse
    {
        return $this->related($id, 'orders', $query);
    }

    /**
     * Get all subscriptions for a store
     *
     * @param string $id
     * @param array $query
     * @return PaginatedResponse
     */
    public function subscriptions(string $id, array $query = []): PaginatedResponse
    {
        return $this->related($id, 'subscriptions', $query);
    }
}
