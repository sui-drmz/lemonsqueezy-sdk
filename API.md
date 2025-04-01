# API Reference

This document provides a comprehensive reference for all available resources and their methods in the Lemonsqueezy SDK.

## Base Resource Methods

All resources inherit these base methods from the `Resource` class:

- `all(array $query = [])` - Get all resources with pagination
- `find(string $id)` - Get a single resource by ID
- `create(array $data)` - Create a new resource
- `update(string $id, array $data)` - Update an existing resource
- `delete(string $id)` - Delete a resource
- `related(string $id, string $relation, array $query = [])` - Get related resources

## Resources

### Users

```php
$client->users()
```

Methods:

- `getAuthenticatedUser()` - Get the authenticated user

### Stores

```php
$client->stores()
```

Methods:

- `products(string $id, array $query = [])` - Get all products for a store
- `customers(string $id, array $query = [])` - Get all customers for a store
- `orders(string $id, array $query = [])` - Get all orders for a store
- `subscriptions(string $id, array $query = [])` - Get all subscriptions for a store

Available includes:

- `products`
- `customers`
- `orders`
- `subscriptions`
- `subscription_invoices`
- `webhooks`

### Products

```php
$client->products()
```

Methods:

- `getVariants(string $id, array $query = [])` - Get all variants for a product

Available includes:

- `store`
- `variants`
- `files`
- `prices`

### Variants

```php
$client->variants()
```

Methods:

- `getFiles(string $id)` - Get all files for a variant

### Orders

```php
$client->orders()
```

Methods:

- `getOrderItems(string $id, array $query = [])` - Get all order items for an order
- `getOrderItem(string $orderId, string $orderItemId)` - Get a single order item

Available includes:

- `store`
- `customer`
- `order-items`
- `subscriptions`
- `license-keys`

### Subscriptions

```php
$client->subscriptions()
```

### Customers

```php
$client->customers()
```

### Discounts

```php
$client->discounts()
```

### Files

```php
$client->files()
```

### Licenses

```php
$client->licenses()
```

Methods:

- `validate(string $key)` - Validate a license key
- `deactivate(string $id)` - Deactivate a license

### Checkouts

```php
$client->checkouts()
```

### Webhooks

```php
$client->webhooks()
```

### Usage Records

```php
$client->usageRecords()
```

### Subscription Invoices

```php
$client->subscriptionInvoices()
```

### Subscription Items

```php
$client->subscriptionItems()
```

### Prices

```php
$client->prices()
```

## Entity Properties

Each entity has its own set of properties and methods. Here are some examples:

### Order Entity

```php
$order->id()              // Get order ID
$order->type()           // Get resource type
$order->identifier()     // Get order identifier
$order->orderNumber()    // Get order number
$order->status()         // Get order status
$order->total()          // Get order total
$order->currency()       // Get order currency
$order->createdAt()      // Get creation date
$order->updatedAt()      // Get last update date
$order->store()          // Get related store
$order->customer()       // Get related customer
$order->orderItems()     // Get related order items
$order->subscriptions()  // Get related subscriptions
$order->licenseKeys()    // Get related license keys
```

### Product Entity

```php
$product->id()           // Get product ID
$product->name()         // Get product name
$product->slug()         // Get product slug
$product->description()  // Get product description
$product->status()       // Get product status
$product->price()        // Get product price
$product->createdAt()    // Get creation date
$product->updatedAt()    // Get last update date
$product->store()        // Get related store
$product->variants()     // Get related variants
$product->files()        // Get related files
$product->prices()       // Get related prices
```

### Subscription Entity

```php
$subscription->id()              // Get subscription ID
$subscription->status()          // Get subscription status
$subscription->cardBrand()       // Get card brand
$subscription->cardLastFour()    // Get last four digits of card
$subscription->pause()           // Get pause status
$subscription->cancelled()       // Get cancellation status
$subscription->trialEndsAt()     // Get trial end date
$subscription->billingAnchor()   // Get billing anchor
$subscription->createdAt()       // Get creation date
$subscription->updatedAt()       // Get last update date
$subscription->store()           // Get related store
$subscription->customer()        // Get related customer
$subscription->order()           // Get related order
$subscription->orderItem()       // Get related order item
$subscription->product()         // Get related product
$subscription->variant()         // Get related variant
```

## Response Types

### PaginatedResponse

The `PaginatedResponse` class implements the `Iterator` interface and provides:

- `data()` - Get the array of resources
- `meta()` - Get pagination metadata
- `links()` - Get pagination links
- `currentPage()` - Get current page number
- `lastPage()` - Get last page number
- `perPage()` - Get items per page
- `total()` - Get total number of items

## Error Handling

The SDK throws the following exceptions:

- `ApiException` - For API errors
- `ValidationException` - For validation errors
- `AuthenticationException` - For authentication errors

Example:

```php
try {
    $order = $client->orders()->find('non-existent-id');
} catch (\Artbees\Lemonsqueezy\Exception\ApiException $e) {
    // Handle API errors
}
```
