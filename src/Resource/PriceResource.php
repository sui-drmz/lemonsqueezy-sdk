<?php

namespace Artbees\Lemonsqueezy\Resource;

use Artbees\Lemonsqueezy\Client;
use Artbees\Lemonsqueezy\Entity\Price;

class PriceResource extends Resource
{
    public function __construct(Client $client)
    {
        parent::__construct($client);
        $this->endpoint = 'prices';
        $this->entityClass = Price::class;
        $this->supportedOperations = [
            'list' => true,
            'retrieve' => true,
            'create' => true,
            'update' => true,
            'delete' => true,
        ];
    }
} 