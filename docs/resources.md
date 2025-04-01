# Lemonsqueezy SDK Resources

This document provides a comprehensive overview of all available resources in the Lemonsqueezy SDK and their supported operations.

## Available Resources

### Orders

- **Endpoint**: `orders`
- **Supported Operations**:
  - List orders (GET /v1/orders)
  - Retrieve order (GET /v1/orders/{id})
- **Available Includes**:
  - `store`
  - `customer`
  - `order-items`
  - `subscriptions`
  - `license-keys`
- **Special Methods**:
  - `withStore()`
  - `withCustomer()`
  - `withOrderItems()`
  - `withSubscriptions()`
  - `withLicenseKeys()`
  - `withAll()`
  - `getOrderItems(string $id)`
  - `getOrderItem(string $orderId, string $orderItemId)`

### Products

- **Endpoint**: `products`
- **Supported Operations**:
  - List products (GET /v1/products)
  - Retrieve product (GET /v1/products/{id})
  - Create product (POST /v1/products)
  - Update product (PUT /v1/products/{id})
  - Delete product (DELETE /v1/products/{id})
- **Available Includes**:
  - `store`
  - `variants`
  - `files`
  - `prices`
- **Special Methods**:
  - `getVariants(string $id)`

### Stores

- **Endpoint**: `stores`
- **Supported Operations**:
  - List stores (GET /v1/stores)
  - Retrieve store (GET /v1/stores/{id})
- **Available Includes**:
  - `products`
  - `customers`
  - `orders`
  - `subscriptions`
  - `subscription_invoices`
  - `webhooks`
- **Special Methods**:
  - `products(string $id)`
  - `customers(string $id)`
  - `orders(string $id)`
  - `subscriptions(string $id)`

### Subscriptions

- **Endpoint**: `subscriptions`
- **Supported Operations**:
  - List subscriptions (GET /v1/subscriptions)
  - Retrieve subscription (GET /v1/subscriptions/{id})
  - Update subscription (PUT /v1/subscriptions/{id})
- **Special Methods**:
  - `cancel(string $id)`
  - `resume(string $id)`

### Licenses

- **Endpoint**: `licenses`
- **Supported Operations**:
  - List licenses (GET /v1/licenses)
  - Retrieve license (GET /v1/licenses/{id})
  - Update license (PUT /v1/licenses/{id})
- **Special Methods**:
  - `validate(string $key)`
  - `deactivate(string $id)`

### Checkouts

- **Endpoint**: `checkouts`
- **Supported Operations**:
  - List checkouts (GET /v1/checkouts)
  - Retrieve checkout (GET /v1/checkouts/{id})
  - Create checkout (POST /v1/checkouts)

### Webhooks

- **Endpoint**: `webhooks`
- **Supported Operations**:
  - List webhooks (GET /v1/webhooks)
  - Retrieve webhook (GET /v1/webhooks/{id})
  - Create webhook (POST /v1/webhooks)
  - Update webhook (PUT /v1/webhooks/{id})
  - Delete webhook (DELETE /v1/webhooks/{id})

### Customers

- **Endpoint**: `customers`
- **Supported Operations**:
  - List customers (GET /v1/customers)
  - Retrieve customer (GET /v1/customers/{id})
  - Create customer (POST /v1/customers)
  - Update customer (PUT /v1/customers/{id})

### Discounts

- **Endpoint**: `discounts`
- **Supported Operations**:
  - List discounts (GET /v1/discounts)
  - Retrieve discount (GET /v1/discounts/{id})
  - Create discount (POST /v1/discounts)
  - Delete discount (DELETE /v1/discounts/{id})

### Files

- **Endpoint**: `files`
- **Supported Operations**:
  - List files (GET /v1/files)
  - Retrieve file (GET /v1/files/{id})

### Prices

- **Endpoint**: `prices`
- **Supported Operations**:
  - List prices (GET /v1/prices)
  - Retrieve price (GET /v1/prices/{id})
  - Create price (POST /v1/prices)
  - Update price (PUT /v1/prices/{id})
  - Delete price (DELETE /v1/prices/{id})

### Subscription Invoices

- **Endpoint**: `subscription-invoices`
- **Supported Operations**:
  - List subscription invoices (GET /v1/subscription-invoices)
  - Retrieve subscription invoice (GET /v1/subscription-invoices/{id})

### Subscription Items

- **Endpoint**: `subscription-items`
- **Supported Operations**:
  - List subscription items (GET /v1/subscription-items)
  - Retrieve subscription item (GET /v1/subscription-items/{id})
  - Update subscription item (PUT /v1/subscription-items/{id})

### Usage Records

- **Endpoint**: `usage-records`
- **Supported Operations**:
  - List usage records (GET /v1/usage-records)
  - Retrieve usage record (GET /v1/usage-records/{id})
  - Create usage record (POST /v1/usage-records)

### Variants

- **Endpoint**: `variants`
- **Supported Operations**:
  - List variants (GET /v1/variants)
  - Retrieve variant (GET /v1/variants/{id})
  - Create variant (POST /v1/variants)
  - Update variant (PUT /v1/variants/{id})
  - Delete variant (DELETE /v1/variants/{id})
- **Special Methods**:
  - `getFiles(string $id)`

### Users

- **Endpoint**: `users`
- **Supported Operations**:
  - Retrieve user (GET /v1/users/{id})
- **Special Methods**:
  - `getAuthenticatedUser()`

## Common Operations

All resources support the following common operations (if enabled):

### List Resources

```php
$client->{resource}()->all();
```

### Retrieve Resource

```php
$client->{resource}()->find($id);
```

### Create Resource

```php
$client->{resource}()->create($data);
```

### Update Resource

```php
$client->{resource}()->update($id, $data);
```

### Delete Resource

```php
$client->{resource}()->delete($id);
```

### Include Related Resources

```php
$client->{resource}()->include('relation1,relation2');
```

### Get Related Resources

```php
$client->{resource}()->related($id, 'relation');
```

## Error Handling

If an unsupported operation is attempted, the SDK will throw a `RuntimeException` with a descriptive message indicating that the operation is not supported for the specific resource.

## Pagination

All list operations return a `PaginatedResponse` object that can be used to navigate through the results:

```php
$response = $client->{resource}()->all();
$data = $response->data();
$meta = $response->meta();
$links = $response->links();
```
