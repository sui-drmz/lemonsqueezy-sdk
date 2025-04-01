# Lemonsqueezy SDK

A PHP SDK for interacting with the Lemonsqueezy API. This SDK provides a fluent interface for working with all Lemonsqueezy resources including orders, products, subscriptions, and more.

[![Latest Version](https://img.shields.io/packagist/v/artbees/lemonsqueezy-sdk.svg?style=flat-square)](https://packagist.org/packages/artbees/lemonsqueezy-sdk)
[![Total Downloads](https://img.shields.io/packagist/dt/artbees/lemonsqueezy-sdk.svg?style=flat-square)](https://packagist.org/packages/artbees/lemonsqueezy-sdk)
[![License](https://img.shields.io/packagist/l/artbees/lemonsqueezy-sdk.svg?style=flat-square)](https://packagist.org/packages/artbees/lemonsqueezy-sdk)

## 📚 Documentation

- [Quick Start Guide](docs/quick-start.md)
- [Resources Reference](docs/resources.md)
- [API Reference](docs/api.md)
- [Examples](docs/examples.md)

## 🚀 Quick Start

### Installation

```bash
composer require artbees/lemonsqueezy-sdk
```

### Basic Usage

```php
use Artbees\Lemonsqueezy\LemonsqueezyClient;

$client = new LemonsqueezyClient('your-api-key');

// Set the store ID for all subsequent requests
$client->forStore('your-store-id');

// Fetch orders with related data
$orders = $client->orders()
    ->withStore()
    ->withCustomer()
    ->withOrderItems()
    ->all();

// Fetch a single order
$order = $client->orders()->find('order-id');

// Create a product
$product = $client->products()->create([
    'name' => 'My Product',
    'description' => 'Product description',
    'price' => 1000, // $10.00
]);
```

## ✨ Features

- Fluent interface for all API operations
- Type-safe responses with proper entity classes
- Automatic pagination handling
- Relationship loading with includes
- Comprehensive error handling
- Full support for all Lemonsqueezy API endpoints

## 📋 Available Resources

The SDK provides access to all Lemonsqueezy resources:

- Orders
- Products
- Stores
- Subscriptions
- Licenses
- Checkouts
- Webhooks
- Customers
- Discounts
- Files
- Prices
- Subscription Invoices
- Subscription Items
- Usage Records
- Variants
- Users

For detailed information about each resource and its supported operations, see the [Resources Reference](docs/resources.md).

## 🔧 Configuration

### API Key

You can get your API key from the Lemonsqueezy dashboard under Settings > API.

### Store ID

Most operations require a store ID. You can set it globally using the `forStore()` method:

```php
$client->forStore('your-store-id');
```

## 🤝 Contributing

Contributions are welcome! Please feel free to submit a Pull Request.

## 📄 License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.
