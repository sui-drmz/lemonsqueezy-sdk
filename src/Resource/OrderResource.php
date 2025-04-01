<?php

namespace Artbees\Lemonsqueezy\Resource;

use Artbees\Lemonsqueezy\Client;
use Artbees\Lemonsqueezy\Entity\Order;
use Artbees\Lemonsqueezy\Entity\OrderItem;
use Artbees\Lemonsqueezy\Response\PaginatedResponse;

class OrderResource extends Resource
{
    protected string $endpoint = 'orders';
    protected string $entityClass = Order::class;
    protected array $availableIncludes = [
        'store',
        'customer',
        'order-items',
        'subscriptions',
        'license-keys'
    ];

    public function __construct(Client $client)
    {
        parent::__construct($client);
    }

    /**
     * Get a single order by ID
     *
     * @param string $id
     * @param array|string|null $include Relations to eager load
     * @return Order
     */
    public function find(string $id, array|string|null $include = null): Order
    {
        $query = [];
        if ($include) {
            $query['include'] = $this->formatInclude($include);
        }

        $response = $this->client->get("{$this->endpoint}/{$id}", $query);
        return new Order($response['data']);
    }

    /**
     * Get all orders with pagination
     *
     * @param array $query
     * @param array|string|null $include Relations to eager load
     * @return PaginatedResponse
     */
    public function all(array $query = [], array|string|null $include = null): PaginatedResponse
    {
        if (!$this->client->getStoreId()) {
            throw new \RuntimeException('Store ID must be set using forStore() before fetching orders');
        }

        return parent::all($query, $include);
    }

    /**
     * Get all order items for an order
     *
     * @param string $id
     * @param array $query
     * @return PaginatedResponse
     */
    public function getOrderItems(string $id, array $query = []): PaginatedResponse
    {
        return $this->related($id, 'order-items', $query);
    }

    /**
     * Get a single order item
     *
     * @param string $orderId
     * @param string $orderItemId
     * @return OrderItem
     */
    public function getOrderItem(string $orderId, string $orderItemId): OrderItem
    {
        $response = $this->client->get("{$this->endpoint}/{$orderId}/order-items/{$orderItemId}");
        return new OrderItem($response['data']);
    }

    /**
     * Get orders with store information
     *
     * @return $this
     */
    public function withStore(): self
    {
        return $this->include('store');
    }

    /**
     * Get orders with customer information
     *
     * @return $this
     */
    public function withCustomer(): self
    {
        return $this->include('customer');
    }

    /**
     * Get orders with order items
     *
     * @return $this
     */
    public function withOrderItems(): self
    {
        return $this->include('order-items');
    }

    /**
     * Get orders with subscriptions
     *
     * @return $this
     */
    public function withSubscriptions(): self
    {
        return $this->include('subscriptions');
    }

    /**
     * Get orders with license keys
     *
     * @return $this
     */
    public function withLicenseKeys(): self
    {
        return $this->include('license-keys');
    }

    /**
     * Get orders with all available relationships
     *
     * @return $this
     */
    public function withAll(): self
    {
        return $this->include($this->availableIncludes);
    }
} 