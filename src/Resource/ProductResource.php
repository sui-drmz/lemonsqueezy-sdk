<?php

namespace Artbees\Lemonsqueezy\Resource;

use Artbees\Lemonsqueezy\Client;
use Artbees\Lemonsqueezy\Entity\Product;
use Artbees\Lemonsqueezy\Response\PaginatedResponse;

class ProductResource extends Resource
{
    public function __construct(Client $client)
    {
        parent::__construct($client);
        $this->endpoint = 'products';
        $this->entityClass = Product::class;
        $this->availableIncludes = [
            'store',
            'variants',
            'files',
            'prices'
        ];
        $this->supportedOperations = [
            'list' => true,
            'retrieve' => true,
            'create' => true,
            'update' => true,
            'delete' => true,
        ];
    }

    /**
     * Get all variants for a product
     *
     * @param string $id
     * @param array $query
     * @return PaginatedResponse
     */
    public function getVariants(string $id, array $query = []): PaginatedResponse
    {
        return $this->related($id, 'variants', $query);
    }
} 