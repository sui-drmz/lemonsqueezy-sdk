# Quick Start Guide

This guide will help you get started with the Lemonsqueezy SDK quickly.

## Installation

First, install the SDK using Composer:

```bash
composer require artbees/lemonsqueezy-sdk
```

## Basic Usage

### Initialize the Client

```php
use Artbees\Lemonsqueezy\LemonsqueezyClient;

$client = new LemonsqueezyClient('your-api-key');
```

### Set Store ID

Most operations require a store ID. You can set it globally:

```php
$client->forStore('your-store-id');
```

## Common Operations

### Fetching Resources

```php
// Get all orders
$orders = $client->orders()->all();

// Get a single order
$order = $client->orders()->find('order-id');

// Get orders with related data
$orders = $client->orders()
    ->withStore()
    ->withCustomer()
    ->withOrderItems()
    ->all();
```

### Creating Resources

```php
// Create a product
$product = $client->products()->create([
    'name' => 'My Product',
    'description' => 'Product description',
    'price' => 1000, // $10.00
]);

// Create a checkout
$checkout = $client->checkouts()->create([
    'store_id' => 'store-id',
    'variant_id' => 'variant-id',
    'custom_price' => 1500, // $15.00
]);
```

### Updating Resources

```php
// Update a product
$product = $client->products()->update('product-id', [
    'name' => 'Updated Product Name',
    'description' => 'Updated description'
]);

// Update a subscription
$subscription = $client->subscriptions()->update('subscription-id', [
    'pause' => true
]);
```

### Deleting Resources

```php
// Delete a product
$client->products()->delete('product-id');

// Delete a webhook
$client->webhooks()->delete('webhook-id');
```

## Working with Relationships

### Eager Loading

```php
// Load specific relationships
$order = $client->orders()
    ->withStore()
    ->withCustomer()
    ->withOrderItems()
    ->find('order-id');

// Load all available relationships
$order = $client->orders()
    ->withAll()
    ->find('order-id');

// Use the generic include method
$order = $client->orders()
    ->include(['store', 'order-items'])
    ->find('order-id');
```

### Lazy Loading

```php
// Get order without eager loading
$order = $client->orders()->find('order-id');

// The store data will be fetched only when accessed
$store = $order->store(); // Makes an additional API request
$storeName = $store->name();
```

## Pagination

```php
// Get paginated results
$orders = $client->orders()
    ->withOrderItems()
    ->all([
        'page' => 1,
        'per_page' => 10
    ]);

// Access pagination metadata
$meta = $orders->meta();
$links = $orders->links();

// Iterate through all pages
foreach ($orders as $order) {
    // Process each order
}
```

## Error Handling

```php
try {
    $order = $client->orders()->find('non-existent-id');
} catch (\Artbees\Lemonsqueezy\Exception\ApiException $e) {
    // Handle API errors
    echo $e->getMessage();
    echo $e->getCode();
}
```

## Special Operations

### Working with Licenses

```php
// Validate a license key
$license = $client->licenses()->validate('license-key');

// Deactivate a license
$client->licenses()->deactivate('license-id');
```

### Working with Subscriptions

```php
// Cancel a subscription
$client->subscriptions()->cancel('subscription-id');

// Resume a subscription
$client->subscriptions()->resume('subscription-id');
```

### Working with Users

```php
// Get the authenticated user
$user = $client->users()->getAuthenticatedUser();
```

## Best Practices

1. **Use Eager Loading**: When you know you'll need related data, use eager loading to avoid N+1 queries:

   ```php
   // ❌ Bad: Makes N+1 queries
   $orders = $client->orders()->all();
   foreach ($orders as $order) {
       $store = $order->store(); // Makes an additional request for each order
   }

   // ✅ Good: Uses eager loading to avoid N+1
   $orders = $client->orders()
       ->withStore()
       ->all();
   foreach ($orders as $order) {
       $store = $order->store(); // No additional request needed
   }
   ```

2. **Set Store ID**: Always set the store ID when working with store-specific resources:

   ```php
   $client->forStore('your-store-id');
   ```

3. **Handle Errors**: Always wrap API calls in try-catch blocks:

   ```php
   try {
       $order = $client->orders()->find('order-id');
   } catch (\Artbees\Lemonsqueezy\Exception\ApiException $e) {
       // Handle the error appropriately
   }
   ```

4. **Use Pagination**: When working with large datasets, use pagination to avoid loading too much data at once:
   ```php
   $orders = $client->orders()->all([
       'per_page' => 50
   ]);
   ```
