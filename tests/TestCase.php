<?php

namespace Artbees\Lemonsqueezy\Tests;

use Dotenv\Dotenv;
use PHPUnit\Framework\TestCase as BaseTestCase;

class TestCase extends BaseTestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        // Load environment variables from .env file
        if (file_exists(__DIR__ . '/../.env')) {
            $dotenv = Dotenv::createImmutable(__DIR__ . '/..');
            $dotenv->load();
        }
    }
} 