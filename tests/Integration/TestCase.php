<?php

namespace Artbees\Lemonsqueezy\Tests\Integration;

use Artbees\Lemonsqueezy\LemonsqueezyClient;
use Artbees\Lemonsqueezy\Resource\OrderResource;
use Dotenv\Dotenv;
use PHPUnit\Framework\TestCase as BaseTestCase;

class TestCase extends BaseTestCase
{
    protected LemonsqueezyClient $client;
    protected OrderResource $orderResource;

    protected function setUp(): void
    {
        parent::setUp();

        // Load environment variables from .env file
        if (file_exists(__DIR__ . '/../../.env')) {
            $dotenv = Dotenv::createImmutable(__DIR__ . '/../..');
            $dotenv->load();
        }

        // Skip test if no API key is provided
        if (!isset($_ENV['LEMON_SQUEEZY_API_KEY'])) {
            $this->markTestSkipped('LEMON_SQUEEZY_API_KEY environment variable is not set.');
        }

        // Create the Lemonsqueezy client with real API key
        $this->client = new LemonsqueezyClient($_ENV['LEMON_SQUEEZY_API_KEY']);
        
        // Set store ID if available
        if (isset($_ENV['LEMON_SQUEEZY_STORE_ID'])) {
            $this->client->forStore($_ENV['LEMON_SQUEEZY_STORE_ID']);
        }
        
        // Initialize the OrderResource
        $orderResource = $this->client->orders();
        if ($orderResource === null) {
            $this->markTestSkipped('Failed to initialize OrderResource. Check client implementation.');
        }
        $this->orderResource = $orderResource;
    }
} 