<?php

namespace Artbees\Lemonsqueezy\Entity;

class File extends Entity
{
    protected string $type = 'files';

    /**
     * Define the relationships for this entity
     */
    protected function getRelatedEntityClass(string $relation): ?string
    {
        return match($relation) {
            'product' => Product::class,
            'variant' => Variant::class,
            default => null,
        };
    }

    /**
     * Get the file name
     */
    public function name(): ?string
    {
        return $this->name;
    }

    /**
     * Get the file extension
     */
    public function extension(): ?string
    {
        return $this->extension;
    }

    /**
     * Get the file size
     */
    public function size(): ?int
    {
        return $this->size;
    }

    /**
     * Get the file mime type
     */
    public function mimeType(): ?string
    {
        return $this->mime_type;
    }

    /**
     * Get the file kind
     */
    public function kind(): ?string
    {
        return $this->kind;
    }

    /**
     * Get the file kind formatted
     */
    public function kindFormatted(): ?string
    {
        return $this->kind_formatted;
    }

    /**
     * Get the file URL
     */
    public function url(): ?string
    {
        return $this->url;
    }

    /**
     * Get the file download URL
     */
    public function downloadUrl(): ?string
    {
        return $this->download_url;
    }

    /**
     * Get the file variant ID
     */
    public function variantId(): ?int
    {
        return $this->variant_id;
    }

    /**
     * Get the file creation date
     */
    public function createdAt(): ?string
    {
        return $this->created_at;
    }

    /**
     * Get the file last update date
     */
    public function updatedAt(): ?string
    {
        return $this->updated_at;
    }

    /**
     * Get the product
     */
    public function product(): ?Product
    {
        return $this->getRelationship('product');
    }

    /**
     * Get the variant
     */
    public function variant(): ?Variant
    {
        return $this->getRelatedEntity('variant');
    }
} 