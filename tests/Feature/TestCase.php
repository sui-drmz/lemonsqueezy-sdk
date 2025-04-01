<?php

namespace Artbees\Lemonsqueezy\Tests\Feature;

use Artbees\Lemonsqueezy\LemonsqueezyClient;
use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use PHPUnit\Framework\TestCase as BaseTestCase;

class TestCase extends BaseTestCase
{
    protected MockHandler $mockHandler;
    protected LemonsqueezyClient $client;

    protected function setUp(): void
    {
        parent::setUp();

        // Create a mock handler
        $this->mockHandler = new MockHandler();

        // Create a handler stack with the mock handler
        $handlerStack = HandlerStack::create($this->mockHandler);

        // Create a new Guzzle client with the handler stack
        $guzzleClient = new Client(['handler' => $handlerStack]);

        // Create the Lemonsqueezy client
        $this->client = new LemonsqueezyClient('fake-api-key');
    }
} 