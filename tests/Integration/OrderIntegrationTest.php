<?php

namespace Tests\Integration;

use Artbees\Lemonsqueezy\Entity\Order;
use Artbees\Lemonsqueezy\Entity\OrderItem;
use Artbees\Lemonsqueezy\Entity\Store;
use Artbees\Lemonsqueezy\Entity\Customer;
use Artbees\Lemonsqueezy\Response\PaginatedResponse;


test('can fetch all orders', function () {
    $response = $this->client->orders()->all();

    expect($response)->toBeInstanceOf(PaginatedResponse::class);
    expect($response->data)->toBeArray();
    expect($response->data)->not->toBeEmpty();
    expect($response->data[0])->toBeInstanceOf(Order::class);
    expect($response->total)->toBe($response->meta['page']['total']);
    expect($response->perPage)->toBe($response->meta['page']['perPage']);
    expect($response->currentPage)->toBe($response->meta['page']['currentPage']);
    expect($response->lastPage)->toBe($response->meta['page']['lastPage']);

    $count = 0;
    $currentResponse = $response;
    
    do {
        foreach ($currentResponse->data as $order) {
            expect($order)->toBeInstanceOf(Order::class);
            $count++;
        }
        
        $currentResponse = $currentResponse->nextPage();
    } while ($currentResponse !== null);

    // The count may be less than the total if there's an empty page
    expect($count)->toBeLessThanOrEqual($response->total);
});

test('can fetch a single order by ID', function () {
    // First get an order ID from the list
    $orders = $this->orderResource->all();
    
    // Skip test if no orders are available
    if (empty($orders->data)) {
        $this->markTestSkipped('No orders available to test with.');
        return;
    }
    
    $orderId = $orders->data[0]->id;
    
    $order = $this->orderResource->find($orderId);
    
    expect($order)->toBeInstanceOf(Order::class);
    expect($order->id())->toBe($orderId);
});

test('can fetch order items for an order', function () {
    // First get an order ID from the list
    $orders = $this->orderResource->all();
    
    // Skip test if no orders are available
    if (empty($orders->data)) {
        $this->markTestSkipped('No orders available to test with.');
        return;
    }
    
    $orderId = $orders->data[0]->id();
    
    $orderItems = $this->orderResource->getOrderItems($orderId);
    
    expect($orderItems)->toBeInstanceOf(PaginatedResponse::class);
    expect($orderItems->data)->toBeArray();
    
    // Skip additional assertions if no order items are found
    if (empty($orderItems->data)) {
        $this->markTestSkipped('No order items available for testing.');
        return;
    }
    
    expect($orderItems->data[0])->toBeInstanceOf(OrderItem::class);
});

test('can fetch a single order item', function () {
    // First get an order and its items
    $orders = $this->orderResource->all();
    
    // Skip test if no orders are available
    if (empty($orders->data)) {
        $this->markTestSkipped('No orders available to test with.');
        return;
    }
    
    $orderId = $orders->data[0]->id();
    $orderItems = $this->orderResource->getOrderItems($orderId);
    
    // Skip test if no order items are available
    if (empty($orderItems->data)) {
        $this->markTestSkipped('No order items available for testing.');
        return;
    }
    
    $orderItemId = $orderItems->data[0]->id();
    
    $orderItem = $this->orderResource->getOrderItem($orderId, $orderItemId);
    
    expect($orderItem)->toBeInstanceOf(OrderItem::class);
    expect($orderItem->id())->toBe($orderItemId);
});

test('order must contain order items', function () {
    // First get an order with order items included
    $orders = $this->orderResource->withOrderItems()->all();
    
    // Skip test if no orders are available
    if (empty($orders->data)) {
        $this->markTestSkipped('No orders available to test with.');
        return;
    }
    
    $order = $orders->data[0];
    
    // The order_items property should be accessible, but may be null if no order items exist
    if ($order->order_items === null) {
        $this->markTestSkipped('Order has no order items to test with.');
        return;
    }
    
    expect($order->order_items)->toBeArray();
    expect($order->order_items)->not->toBeEmpty();
    expect($order->order_items[0])->toBeInstanceOf(OrderItem::class);
});

test('can include store with order', function () {
    $orders = $this->orderResource->withStore()->all();
    
    // Skip test if no orders are available
    if (empty($orders->data)) {
        $this->markTestSkipped('No orders available to test with.');
        return;
    }
    
    $order = $orders->data[0];
    
    expect($order->store)->toBeInstanceOf(Store::class);
});

test('can include customer with order', function () {
    $orders = $this->orderResource->withCustomer()->all();
    
    // Skip test if no orders are available
    if (empty($orders->data)) {
        $this->markTestSkipped('No orders available to test with.');
        return;
    }
    
    $order = $orders->data[0];
    
    expect($order->customer)->toBeInstanceOf(Customer::class);
});

test('can include multiple relationships', function () {
    $orders = $this->orderResource
        ->withStore()
        ->withCustomer()
        ->withOrderItems()
        ->all();
    
    // Skip test if no orders are available
    if (empty($orders->data)) {
        $this->markTestSkipped('No orders available to test with.');
        return;
    }
    
    $order = $orders->data[0];
    
    expect($order->store)->toBeInstanceOf(Store::class);
    expect($order->customer)->toBeInstanceOf(Customer::class);
    
    // The order_items property should be accessible, but may be null if no order items exist
    if ($order->order_items === null) {
        $this->markTestSkipped('Order has no order items to test with.');
        return;
    }
    
    expect($order->order_items)->toBeArray();
    expect($order->order_items[0])->toBeInstanceOf(OrderItem::class);
});

test('can include all relationships', function () {
    $orders = $this->orderResource->withAll()->all();
    
    // Skip test if no orders are available
    if (empty($orders->data)) {
        $this->markTestSkipped('No orders available to test with.');
        return;
    }
    
    $order = $orders->data[0];
    
    expect($order->store)->toBeInstanceOf(Store::class);
    expect($order->customer)->toBeInstanceOf(Customer::class);
    
    // The order_items property should be accessible, but may be null if no order items exist
    if ($order->order_items === null) {
        $this->markTestSkipped('Order has no order items to test with.');
        return;
    }
    
    expect($order->order_items)->toBeArray();
    expect($order->order_items[0])->toBeInstanceOf(OrderItem::class);
});

