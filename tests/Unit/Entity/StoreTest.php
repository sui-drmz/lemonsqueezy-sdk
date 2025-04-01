<?php

use Artbees\Lemonsqueezy\Entity\Store;

$storeData = [
    'id' => '123',
    'type' => 'stores',
    'attributes' => [
        'name' => 'Test Store',
        'slug' => 'test-store',
        'description' => 'A test store description',
        'logo_url' => 'https://example.com/logo.png',
        'banner_url' => 'https://example.com/banner.png',
        'currency' => 'USD',
        'tax_rate' => 0.2,
        'tax_number' => 'TAX123',
        'tax_name' => 'Test Tax Name',
        'tax_address' => '123 Test St',
        'tax_country' => 'US',
        'tax_state' => 'CA',
        'tax_city' => 'San Francisco',
        'tax_zip' => '94105',
        'created_at' => '2024-03-30T12:00:00Z',
        'updated_at' => '2024-03-30T12:00:00Z',
    ],
    'relationships' => []
];

test('store can be created with complete data', function () use ($storeData) {
    $store = new Store($storeData);
    
    expect($store->id())->toBe('123')
        ->and($store->type())->toBe('stores')
        ->and($store->name())->toBe('Test Store')
        ->and($store->slug())->toBe('test-store')
        ->and($store->description())->toBe('A test store description')
        ->and($store->logoUrl())->toBe('https://example.com/logo.png')
        ->and($store->bannerUrl())->toBe('https://example.com/banner.png')
        ->and($store->currency())->toBe('USD')
        ->and($store->taxRate())->toBe(0.2)
        ->and($store->taxNumber())->toBe('TAX123')
        ->and($store->taxName())->toBe('Test Tax Name')
        ->and($store->taxAddress())->toBe('123 Test St')
        ->and($store->taxCountry())->toBe('US')
        ->and($store->taxState())->toBe('CA')
        ->and($store->taxCity())->toBe('San Francisco')
        ->and($store->taxZip())->toBe('94105')
        ->and($store->createdAt())->toBe('2024-03-30T12:00:00Z')
        ->and($store->updatedAt())->toBe('2024-03-30T12:00:00Z');
});

test('store handles missing optional fields', function () use ($storeData) {
    $data = $storeData;
    unset($data['attributes']['description']);
    unset($data['attributes']['logo_url']);
    unset($data['attributes']['banner_url']);
    unset($data['attributes']['tax_number']);
    unset($data['attributes']['tax_name']);
    unset($data['attributes']['tax_address']);
    unset($data['attributes']['tax_country']);
    unset($data['attributes']['tax_state']);
    unset($data['attributes']['tax_city']);
    unset($data['attributes']['tax_zip']);

    $store = new Store($data);

    expect($store->description())->toBeNull()
        ->and($store->logoUrl())->toBeNull()
        ->and($store->bannerUrl())->toBeNull()
        ->and($store->taxNumber())->toBeNull()
        ->and($store->taxName())->toBeNull()
        ->and($store->taxAddress())->toBeNull()
        ->and($store->taxCountry())->toBeNull()
        ->and($store->taxState())->toBeNull()
        ->and($store->taxCity())->toBeNull()
        ->and($store->taxZip())->toBeNull();
});

test('store can be converted to array', function () use ($storeData) {
    $store = new Store($storeData);
    $array = $store->toArray();

    expect($array)->toHaveKeys(['id', 'type', 'attributes', 'relationships'])
        ->and($array['id'])->toBe('123')
        ->and($array['type'])->toBe('stores')
        ->and($array['attributes'])->toBe($storeData['attributes'])
        ->and($array['relationships'])->toBe($storeData['relationships']);
});