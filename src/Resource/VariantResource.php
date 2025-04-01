<?php

namespace Artbees\Lemonsqueezy\Resource;

use Artbees\Lemonsqueezy\Client;
use Artbees\Lemonsqueezy\Entity\Variant;
use Artbees\Lemonsqueezy\Response\PaginatedResponse;

class VariantResource extends Resource
{
    public function __construct(Client $client)
    {
        parent::__construct($client);
        $this->endpoint = 'variants';
        $this->entityClass = Variant::class;
        $this->supportedOperations = [
            'list' => true,
            'retrieve' => true,
            'create' => true,
            'update' => true,
            'delete' => true,
        ];
    }

    /**
     * Get a single variant by ID
     *
     * @param string $id
     * @param array|string|null $include Relations to eager load
     * @return \Artbees\Lemonsqueezy\Entity\Variant
     */
    public function find(string $id, array|string|null $include = null): \Artbees\Lemonsqueezy\Entity\Variant
    {
        $query = [];
        if ($include) {
            $query['include'] = $this->formatInclude($include);
        }

        $response = $this->client->get("/{$this->endpoint}/{$id}", $query);
        return new Variant($response['data']);
    }

    /**
     * Get all files for a variant
     *
     * @param string $id
     * @return PaginatedResponse
     */
    public function getFiles(string $id): PaginatedResponse
    {
        return $this->related($id, 'files');
    }
} 