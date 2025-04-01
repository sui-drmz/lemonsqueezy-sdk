<?php

namespace Artbees\Lemonsqueezy\Response;

class PaginatedResponse implements \Iterator
{
    private readonly array $data;
    private readonly array $meta;
    private readonly array $links;
    private readonly ?string $nextPageUrl;
    private readonly ?string $prevPageUrl;
    private readonly ?string $firstPageUrl;
    private readonly ?string $lastPageUrl;
    private readonly int $currentPage;
    private readonly int $lastPage;
    private readonly int $perPage;
    private readonly int $total;
    private readonly ?string $entityClass;
    
    private readonly array $pageCache;
    private int $position = 0;
    /** @var \Closure|null */
    private readonly ?\Closure $fetchPageCallback;

    public function __construct(
        array $response,
        ?string $entityClass = null,
        ?\Closure $fetchPageCallback = null
    ) {
        $this->entityClass = $entityClass;
        $this->fetchPageCallback = $fetchPageCallback;

        $this->initializeResponseData($response);
        $this->initializePaginationData($response);
        $this->initializeLinks($response);

        $data = $response['data'] ?? [];
        if ($this->entityClass) {
            $data = $this->convertToEntities($data, $response['included'] ?? []);
        }

        $this->data = $data;
        $this->pageCache = [$this->currentPage => $data];
    }

    /**
     * Initialize the response data from the API response
     */
    private function initializeResponseData(array $response): void
    {
        $this->meta = $response['meta'] ?? [];
        $this->links = $response['links'] ?? [];
    }

    /**
     * Initialize pagination data from the meta information
     */
    private function initializePaginationData(array $response): void
    {
        $page = $this->meta['page'] ?? [];

        $this->currentPage = $page['currentPage'];
        $this->lastPage = $page['lastPage'];
        $this->perPage = $page['perPage'];
        $this->total = $page['total'];
    }

    /**
     * Initialize pagination links
     */
    private function initializeLinks(array $response): void
    {
        $this->nextPageUrl = $this->links['next'] ?? null;
        $this->prevPageUrl = $this->links['prev'] ?? null;
        $this->firstPageUrl = $this->links['first'] ?? null;
        $this->lastPageUrl = $this->links['last'] ?? null;
    }

    /**
     * Convert raw data to entity objects
     */
    private function convertToEntities(array $data, array $included): array
    {
        $this->validateEntityClass();

        return array_map(function ($item) use ($included) {
            return $this->createEntity($item, $included);
        }, $data);
    }

    /**
     * Validate the entity class exists and extends the base Entity class
     */
    private function validateEntityClass(): void
    {
        if (!class_exists($this->entityClass)) {
            throw new \InvalidArgumentException("Entity class {$this->entityClass} does not exist");
        }
        
        if (!is_subclass_of($this->entityClass, \Artbees\Lemonsqueezy\Entity\Entity::class)) {
            throw new \InvalidArgumentException("Entity class {$this->entityClass} must extend Entity class");
        }
    }

    /**
     * Create an entity instance with its relationships
     */
    private function createEntity(array $item, array $included): object
    {
        if (isset($item['relationships'])) {
            $item['relationships'] = $this->processRelationships($item['relationships'], $included);
        }

        return new ($this->entityClass)($item);
    }

    /**
     * Process relationships and include related data
     */
    private function processRelationships(array $relationships, array $included): array
    {
        foreach ($relationships as $relation => $data) {
            if (isset($data['data'])) {
                $relationships[$relation] = $this->processRelationshipData($data['data'], $included);
            }
        }

        return $relationships;
    }

    /**
     * Process relationship data and find included items
     */
    private function processRelationshipData(array $data, array $included): array
    {
        $items = is_array($data) && isset($data[0]) ? $data : [$data];
        $includedItems = [];

        foreach ($items as $itemData) {
            $includedItem = $this->findIncludedItem($itemData, $included);
            if ($includedItem) {
                $includedItems[] = $includedItem;
            }
        }

        return $includedItems;
    }

    /**
     * Find an included item by type and ID
     */
    private function findIncludedItem(array $itemData, array $included): ?array
    {
        foreach ($included as $includedItem) {
            if ($includedItem['type'] === $itemData['type'] && $includedItem['id'] === $itemData['id']) {
                return $includedItem;
            }
        }

        return null;
    }

    /**
     * Fetch the next page of results
     */
    public function nextPage(): ?self
    {
        if (!$this->hasNextPage() || !$this->fetchPageCallback) {
            return null;
        }

        $nextPage = $this->currentPage + 1;
        if (isset($this->pageCache[$nextPage])) {
            return new self($this->pageCache[$nextPage], $this->entityClass, $this->fetchPageCallback);
        }

        $response = ($this->fetchPageCallback)($nextPage);
        
        // Ensure we have the full response structure
        if (!isset($response['data']) || !isset($response['meta']) || !isset($response['links'])) {
            throw new \RuntimeException('Invalid response format from API');
        }
        
        // Convert data to entities if needed
        $data = $response['data'];
        if ($this->entityClass) {
            $data = $this->convertToEntities($data, $response['included'] ?? []);
        }
        
        // Update the response with the converted data
        $response['data'] = $data;
        
        return new self($response, $this->entityClass, $this->fetchPageCallback);
    }

    /**
     * Fetch the previous page of results
     */
    public function previousPage(): ?self
    {
        if (!$this->hasPreviousPage() || !$this->fetchPageCallback) {
            return null;
        }

        $prevPage = $this->currentPage - 1;
        if (isset($this->pageCache[$prevPage])) {
            return new self($this->pageCache[$prevPage], $this->entityClass, $this->fetchPageCallback);
        }

        $response = ($this->fetchPageCallback)($prevPage);
        
        // Convert data to entities if needed
        $data = $response['data'] ?? [];
        if ($this->entityClass) {
            $data = $this->convertToEntities($data, $response['included'] ?? []);
        }
        
        // Update the response with the converted data
        $response['data'] = $data;
        
        return new self($response, $this->entityClass, $this->fetchPageCallback);
    }

    /**
     * Get all cached pages
     */
    public function getCachedPages(): array
    {
        return $this->pageCache;
    }

    // Iterator implementation
    public function current(): mixed
    {
        return $this->data[$this->position];
    }

    public function key(): int
    {
        return $this->position;
    }

    public function next(): void
    {
        $this->position++;
    }

    public function rewind(): void
    {
        $this->position = 0;
    }

    public function valid(): bool
    {
        return isset($this->data[$this->position]);
    }

    /**
     * Magic method to handle property access
     */
    public function __get(string $name): mixed
    {
        return match($name) {
            'data' => $this->data,
            'meta' => $this->meta,
            'links' => $this->links,
            'nextPageUrl' => $this->nextPageUrl,
            'prevPageUrl' => $this->prevPageUrl,
            'firstPageUrl' => $this->firstPageUrl,
            'lastPageUrl' => $this->lastPageUrl,
            'currentPage' => $this->currentPage,
            'lastPage' => $this->lastPage,
            'perPage' => $this->perPage,
            'total' => $this->total,
            'isFirstPage' => $this->currentPage === 1,
            'isLastPage' => $this->currentPage === $this->lastPage,
            'totalPages' => $this->lastPage,
            'totalItems' => $this->total,
            'currentPageItems' => $this->data,
            'nextPageItems' => $this->getNextPageItems(),
            'previousPageItems' => $this->getPreviousPageItems(),
            'firstPageItems' => $this->getFirstPageItems(),
            'lastPageItems' => $this->getLastPageItems(),
            'allItems' => $this->getAllItems(),
            default => throw new \InvalidArgumentException("Property {$name} does not exist"),
        };
    }

    /**
     * Check if there is a next page available
     */
    public function hasNextPage(): bool
    {
        return $this->nextPageUrl !== null;
    }

    /**
     * Check if there is a previous page available
     */
    public function hasPreviousPage(): bool
    {
        return $this->prevPageUrl !== null;
    }

    /**
     * Get items from a specific page
     */
    private function getPageItems(int $page): array
    {
        if ($page === $this->currentPage) {
            return $this->data;
        }

        if (!$this->fetchPageCallback) {
            throw new \RuntimeException('No fetch callback provided to fetch page items');
        }

        if (isset($this->pageCache[$page])) {
            return (new self($this->pageCache[$page], $this->entityClass, $this->fetchPageCallback))->data;
        }

        $response = ($this->fetchPageCallback)($page);
        return (new self($response, $this->entityClass, $this->fetchPageCallback))->data;
    }

    /**
     * Get items from the next page
     */
    private function getNextPageItems(): ?array
    {
        if (!$this->hasNextPage() || !$this->fetchPageCallback) {
            return null;
        }

        $nextPage = $this->currentPage + 1;
        return $this->getPageItems($nextPage);
    }

    /**
     * Get items from the previous page
     */
    private function getPreviousPageItems(): ?array
    {
        if (!$this->hasPreviousPage || !$this->fetchPageCallback) {
            return null;
        }

        $prevPage = $this->currentPage - 1;
        return $this->getPageItems($prevPage);
    }

    /**
     * Get items from the first page
     */
    private function getFirstPageItems(): array
    {
        return $this->getPageItems(1);
    }

    /**
     * Get items from the last page
     */
    private function getLastPageItems(): array
    {
        return $this->getPageItems($this->lastPage);
    }

    /**
     * Get all items from all pages
     */
    private function getAllItems(): array
    {
        $items = $this->data;
        $currentPage = $this->currentPage;
        $lastPage = $this->lastPage;

        while ($this->hasNextPage() && $this->fetchPageCallback) {
            $nextPage = $currentPage + 1;
            $response = ($this->fetchPageCallback)($nextPage);
            $nextPageResponse = new self($response, $this->entityClass, $this->fetchPageCallback);
            $items = array_merge($items, $nextPageResponse->data);
            
            $currentPage = $nextPageResponse->currentPage;
            $lastPage = $nextPageResponse->lastPage;
        }
        
        return $items;
    }
}
