<?php

namespace Artbees\Lemonsqueezy\Entity;

class User extends Entity
{
    protected string $type = 'users';

    public function __construct(array $data = [])
    {
        parent::__construct($data);
    }

    public function getName(): ?string
    {
        return $this->getAttribute('name');
    }

    public function getEmail(): ?string
    {
        return $this->getAttribute('email');
    }

    public function getColor(): ?string
    {
        return $this->getAttribute('color');
    }

    public function getAvatarUrl(): ?string
    {
        return $this->getAttribute('avatar_url');
    }

    public function hasCustomAvatar(): ?bool
    {
        return $this->getAttribute('has_custom_avatar');
    }

    public function getCreatedAt(): ?string
    {
        return $this->getAttribute('created_at');
    }

    public function getUpdatedAt(): ?string
    {
        return $this->getAttribute('updated_at');
    }

    /**
     * Define the relationships for this entity
     */
    protected function getRelatedEntityClass(string $relation): ?string
    {
        return null;
    }
} 