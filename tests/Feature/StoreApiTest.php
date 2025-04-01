<?php

use Artbees\Lemonsqueezy\LemonsqueezyClient;

test('can fetch a store from the API', function () {
    // Skip test if no API key is provided
    $apiKey = $_ENV['LEMON_SQUEEZY_API_KEY'];
    if (!$apiKey) {
        $this->markTestSkipped('LEMON_SQUEEZY_API_KEY environment variable is not set');
    }

    $sdk = new LemonsqueezyClient($apiKey);
    
    // Get all stores first
    $stores = $sdk->stores()->all();
    
    // Skip test if no stores are available
    if (empty($stores->data())) {
        $this->markTestSkipped('No stores available in the account');
    }

    // Get the first store's ID
    $storeId = $stores->data()[0]['id'];
    
    // Fetch the specific store
    $store = $sdk->stores()->find($storeId);

    // Assert the store has the required fields
    expect($store->id())->toBe($storeId)
        ->and($store->type())->toBe('stores')
        ->and($store->name())->toBeString()
        ->and($store->slug())->toBeString()
        ->and($store->currency())->toBeString()
        ->and($store->taxRate())->toBeFloat()
        ->and($store->createdAt())->toBeString()
        ->and($store->updatedAt())->toBeString();
}); 