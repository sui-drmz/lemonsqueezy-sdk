<?php

namespace Artbees\Lemonsqueezy\Resource;

use Artbees\Lemonsqueezy\Client;
use Artbees\Lemonsqueezy\Entity\Entity;
use Artbees\Lemonsqueezy\Response\PaginatedResponse;

abstract class Resource
{
    protected Client $client;
    protected string $endpoint;
    protected string $entityClass;
    protected array $availableIncludes = [];
    protected array $includes = [];
    protected array $supportedOperations = [
        'list' => true,    // GET /v1/{resource}
        'retrieve' => true, // GET /v1/{resource}/{id}
        'create' => false,  // POST /v1/{resource}
        'update' => false,  // PUT /v1/{resource}/{id}
        'delete' => false,  // DELETE /v1/{resource}/{id}
    ];

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * Include related resources in the response
     *
     * @param string|array $includes The relations to include
     * @return $this
     */
    public function include(string|array $includes): self
    {
        if (is_string($includes)) {
            $includes = [$includes];
        }

        // Filter out any includes that aren't available for this resource
        $validIncludes = array_intersect($includes, $this->availableIncludes);
        
        if (!empty($validIncludes)) {
            $this->includes = array_merge($this->includes, $validIncludes);
        }

        return $this;
    }

    /**
     * Get all resources with pagination
     *
     * @param array $query
     * @return PaginatedResponse
     */
    public function all(array $query = []): PaginatedResponse
    {
        if (!$this->supportedOperations['list']) {
            throw new \RuntimeException('List operation is not supported for this resource');
        }

        if (!empty($this->includes)) {
            $query['include'] = $this->formatInclude($this->includes);
        }

        $response = $this->client->get($this->endpoint, $query);
        
        $fetchCallback = function(int $page) use ($query) {
            $query['page'] = ['number' => $page];
            $response = $this->client->get($this->endpoint, $query);
            
            // Ensure we have the full response structure
            if (!isset($response['data']) || !isset($response['meta']) || !isset($response['links'])) {
                throw new \RuntimeException('Invalid response format from API');
            }
            
            return $response;
        };

        return new PaginatedResponse($response, $this->entityClass, $fetchCallback);
    }

    /**
     * Get a single resource by ID
     *
     * @param string $id
     * @return Entity
     */
    public function find(string $id): Entity
    {
        if (!$this->supportedOperations['retrieve']) {
            throw new \RuntimeException('Retrieve operation is not supported for this resource');
        }

        $query = [];
        if (!empty($this->includes)) {
            $query['include'] = $this->formatInclude($this->includes);
        }

        $response = $this->client->get("{$this->endpoint}/{$id}", $query);
        return new $this->entityClass($response['data']);
    }

    /**
     * Create a new resource
     *
     * @param array $data
     * @return Entity
     */
    public function create(array $data): Entity
    {
        if (!$this->supportedOperations['create']) {
            throw new \RuntimeException('Create operation is not supported for this resource');
        }

        if (!empty($this->includes)) {
            $data['include'] = $this->formatInclude($this->includes);
        }

        $response = $this->client->post($this->endpoint, $data);
        return new $this->entityClass($response['data']);
    }

    /**
     * Update an existing resource
     *
     * @param string $id
     * @param array $data
     * @return Entity
     */
    public function update(string $id, array $data): Entity
    {
        if (!$this->supportedOperations['update']) {
            throw new \RuntimeException('Update operation is not supported for this resource');
        }

        if (!empty($this->includes)) {
            $data['include'] = $this->formatInclude($this->includes);
        }

        $response = $this->client->put("{$this->endpoint}/{$id}", $data);
        return new $this->entityClass($response['data']);
    }

    /**
     * Delete a resource
     *
     * @param string $id
     * @return bool
     */
    public function delete(string $id): bool
    {
        if (!$this->supportedOperations['delete']) {
            throw new \RuntimeException('Delete operation is not supported for this resource');
        }

        $this->client->delete("{$this->endpoint}/{$id}");
        return true;
    }

    /**
     * Get related resources
     *
     * @param string $id
     * @param string $relation
     * @param array $query
     * @return PaginatedResponse
     */
    public function related(string $id, string $relation, array $query = []): PaginatedResponse
    {
        if (!empty($this->includes)) {
            $query['include'] = $this->formatInclude($this->includes);
        }

        $response = $this->client->get("{$this->endpoint}/{$id}/{$relation}", $query);
        
        $fetchCallback = function(int $page) use ($id, $relation, $query) {
            $query['page'] = $page;
            return $this->client->get("{$this->endpoint}/{$id}/{$relation}", $query);
        };

        return new PaginatedResponse($response, $this->entityClass, $fetchCallback);
    }

    /**
     * Format include parameter for API request
     *
     * @param array $includes
     * @return string
     */
    protected function formatInclude(array $includes): string
    {
        return implode(',', array_unique($includes));
    }

    /**
     * Get available includes for this resource
     *
     * @return array
     */
    public function getAvailableIncludes(): array
    {
        return $this->availableIncludes;
    }

    /**
     * Reset the includes for the next request
     *
     * @return $this
     */
    protected function resetIncludes(): self
    {
        $this->includes = [];
        return $this;
    }
}
