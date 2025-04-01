<?php

/**
 * Base entity class for the Lemonsqueezy SDK
 *
 * @category Entity
 * @package  Artbees\Lemonsqueezy\Entity
 * @author   Farshid Rahimi <suidrmz@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     https://github.com/suidrmz/lemonsqueezy-sdk
 */

namespace Artbees\Lemonsqueezy\Entity;

/**
 * Abstract base class for all Lemonsqueezy entities.
 *
 * Provides common functionality for working with entity attributes and relationships
 * as returned by the Lemonsqueezy API.
 *
 * @category Entity
 * @package  Artbees\Lemonsqueezy\Entity
 * @author   Farshid Rahimi <suidrmz@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     https://github.com/suidrmz/lemonsqueezy-sdk
 */
abstract class Entity
{
    /** @var array */
    private readonly array $attributes;

    /** @var array */
    private readonly array $relations;

    /** @var string */
    protected string $type;

    /**
     * Create a new entity instance.
     *
     * @param array $data The entity data from the API.
     *
     * @return void
     */
    public function __construct(array $data = [])
    {
        $this->attributes = $data['attributes'] ?? [];
        $this->relations = $data['relationships'] ?? [];
    }

    /**
     * Magic method to get attributes and relations
     */
    public function __get(string $name)
    {
        // Check if it's a relation
        if ($this->hasRelation($name)) {
            return $this->getRelatedEntity($name);
        }

        // Check if it's an attribute
        if (isset($this->attributes[$name])) {
            return $this->attributes[$name];
        }

        return null;
    }

    /**
     * Magic method to check if attribute or relation exists
     */
    public function __isset(string $name): bool
    {
        return $this->hasRelation($name) || isset($this->attributes[$name]);
    }

    /**
     * Prevent modification of attributes and relations
     */
    public function __set(string $name, mixed $value): void
    {
        throw new \RuntimeException('Entities are immutable. Cannot modify attributes or relations.');
    }

    /**
     * Get the entity ID.
     *
     * @return string|null
     */
    public function id(): ?string
    {
        return $this->attributes['id'] ?? null;
    }

    /**
     * Get the entity type.
     *
     * @return string
     */
    public function type(): string
    {
        return $this->type;
    }

    /**
     * Check if a relation exists.
     *
     * @param string $key The relation key.
     *
     * @return bool
     */
    protected function hasRelation(string $key): bool
    {
        return isset($this->relations[$key]);
    }

    /**
     * Get a relation value.
     *
     * @param string $key The relation key.
     *
     * @return array|null
     */
    protected function getRelation(string $key)
    {
        return $this->relations[$key] ?? null;
    }

    /**
     * Get a related entity.
     *
     * @param string $relation The relation key.
     *
     * @return Entity|null
     */
    protected function getRelatedEntity(string $relation): ?Entity
    {
        if (!$this->hasRelation($relation)) {
            return null;
        }

        $relatedClass = $this->getRelatedEntityClass($relation);
        if (!$relatedClass || !class_exists($relatedClass)) {
            return null;
        }

        return new $relatedClass($this->getRelation($relation));
    }

    /**
     * Get the related entity class for a relationship
     */
    abstract protected function getRelatedEntityClass(string $relation): ?string;

    /**
     * Convert the entity to an array.
     *
     * @return array
     */
    public function toArray(): array
    {
        return [
            'id' => $this->id(),
            'type' => $this->type(),
            'attributes' => $this->attributes,
            'relationships' => $this->relations,
        ];
    }
}
