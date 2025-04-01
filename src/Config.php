<?php

namespace Artbees\Lemonsqueezy;

class Config
{
    private string $apiKey;
    private string $baseUrl = 'https://api.lemonsqueezy.com/v1';

    public function __construct(string $apiKey)
    {
        $this->apiKey = $apiKey;
    }

    public function getApiKey(): string
    {
        return $this->apiKey;
    }

    public function getBaseUrl(): string
    {
        return $this->baseUrl;
    }

    public function setBaseUrl(string $baseUrl): self
    {
        $this->baseUrl = $baseUrl;
        return $this;
    }
} 