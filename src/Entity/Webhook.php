<?php

namespace Artbees\Lemonsqueezy\Entity;

class Webhook extends Entity
{
    protected string $type = 'webhooks';

    public function __construct(array $data = [])
    {
        parent::__construct($data);
    }

    public function getStoreId(): ?int
    {
        return $this->getAttribute('store_id');
    }

    public function getUrl(): ?string
    {
        return $this->getAttribute('url');
    }

    public function getEvents(): ?array
    {
        return $this->getAttribute('events');
    }

    public function getSecret(): ?string
    {
        return $this->getAttribute('secret');
    }

    public function getLastFiredAt(): ?string
    {
        return $this->getAttribute('last_fired_at');
    }

    public function getCreatedAt(): ?string
    {
        return $this->getAttribute('created_at');
    }

    public function getUpdatedAt(): ?string
    {
        return $this->getAttribute('updated_at');
    }

    public function store(): ?Store
    {
        return $this->getRelationship('store');
    }

    /**
     * Define the relationships for this entity
     */
    protected function getRelatedEntityClass(string $relation): ?string
    {
        return null;
    }
} 