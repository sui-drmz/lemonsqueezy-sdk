<?php

namespace Artbees\Lemonsqueezy\Tests\Helpers;

trait OrderDataHelper
{
    protected function getOrderData(
        string $id = '1',
        string $identifier = 'order_123',
        int $orderNumber = 1,
        string $status = 'paid',
        int $total = 1000,
        int $subtotal = 900,
        int $tax = 100
    ): array {
        return [
            'id' => $id,
            'type' => 'orders',
            'attributes' => [
                'identifier' => $identifier,
                'order_number' => $orderNumber,
                'status' => $status,
                'status_formatted' => ucfirst($status),
                'total' => $total,
                'total_formatted' => '$' . number_format($total / 100, 2),
                'subtotal' => $subtotal,
                'subtotal_formatted' => '$' . number_format($subtotal / 100, 2),
                'tax' => $tax,
                'tax_formatted' => '$' . number_format($tax / 100, 2),
                'currency' => 'USD',
                'currency_rate' => 1.0,
                'created_at' => '2024-03-30T12:00:00Z',
                'updated_at' => '2024-03-30T12:00:00Z'
            ]
        ];
    }

    protected function getOrdersData(): array
    {
        return [
            'data' => [
                $this->getOrderData('1', 'order_123', 1, 'paid', 1000, 900, 100),
                $this->getOrderData('2', 'order_456', 2, 'paid', 2000, 1800, 200)
            ]
        ];
    }
} 