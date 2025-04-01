<?php

use Artbees\Lemonsqueezy\Entity\Order;
use Artbees\Lemonsqueezy\LemonsqueezyClient;
use Artbees\Lemonsqueezy\Tests\Helpers\OrderDataHelper;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Client as GuzzleClient;


uses(OrderDataHelper::class);

beforeEach(function () {
    $this->mockHandler = new \GuzzleHttp\Handler\MockHandler();
    $handlerStack = \GuzzleHttp\HandlerStack::create($this->mockHandler);
    $guzzleClient = new \GuzzleHttp\Client(['handler' => $handlerStack]);
    $this->client = new \Artbees\Lemonsqueez\LemonsqueezyClient('fake-api-key');
});

test('can get all orders', function () {
    // Add the mock response to the handler
    $this->mockHandler->append(
        new Response(200, [], json_encode($this->getOrdersData()))
    );

    // Make the request
    $orders = $this->client->getOrders();

    // Assert response
    expect($orders)->toBeArray()
        ->and($orders)->toHaveCount(2)
        ->and($orders)->each->toBeInstanceOf(Order::class);

    // Assert first order
    $firstOrder = $orders[0];
    expect($firstOrder->id())->toBe('1')
        ->and($firstOrder->type())->toBe('orders')
        ->and($firstOrder->identifier())->toBe('order_123')
        ->and($firstOrder->orderNumber())->toBe(1)
        ->and($firstOrder->status())->toBe('paid')
        ->and($firstOrder->statusFormatted())->toBe('Paid')
        ->and($firstOrder->total())->toBe(1000)
        ->and($firstOrder->totalFormatted())->toBe('$10.00')
        ->and($firstOrder->subtotal())->toBe(900)
        ->and($firstOrder->subtotalFormatted())->toBe('$9.00')
        ->and($firstOrder->tax())->toBe(100)
        ->and($firstOrder->taxFormatted())->toBe('$1.00')
        ->and($firstOrder->currency())->toBe('USD')
        ->and($firstOrder->currencyRate())->toBe(1.0)
        ->and($firstOrder->createdAt())->toBe('2024-03-30T12:00:00Z')
        ->and($firstOrder->updatedAt())->toBe('2024-03-30T12:00:00Z');

    // Assert second order
    $secondOrder = $orders[1];
    expect($secondOrder->id())->toBe('2')
        ->and($secondOrder->type())->toBe('orders')
        ->and($secondOrder->identifier())->toBe('order_456')
        ->and($secondOrder->orderNumber())->toBe(2)
        ->and($secondOrder->status())->toBe('paid')
        ->and($secondOrder->statusFormatted())->toBe('Paid')
        ->and($secondOrder->total())->toBe(2000)
        ->and($secondOrder->totalFormatted())->toBe('$20.00')
        ->and($secondOrder->subtotal())->toBe(1800)
        ->and($secondOrder->subtotalFormatted())->toBe('$18.00')
        ->and($secondOrder->tax())->toBe(200)
        ->and($secondOrder->taxFormatted())->toBe('$2.00')
        ->and($secondOrder->currency())->toBe('USD')
        ->and($secondOrder->currencyRate())->toBe(1.0)
        ->and($secondOrder->createdAt())->toBe('2024-03-30T13:00:00Z')
        ->and($secondOrder->updatedAt())->toBe('2024-03-30T13:00:00Z');
}); 