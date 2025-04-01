<?php

namespace Artbees\Lemonsqueezy\Resource;

use Artbees\Lemonsqueezy\Client;
use Artbees\Lemonsqueezy\Entity\Discount;

class DiscountResource extends Resource
{
    public function __construct(Client $client)
    {
        parent::__construct($client);
        $this->endpoint = 'discounts';
        $this->entityClass = Discount::class;
        $this->supportedOperations = [
            'list' => true,
            'retrieve' => true,
            'create' => true,
            'update' => false,
            'delete' => true,
        ];
    }
}