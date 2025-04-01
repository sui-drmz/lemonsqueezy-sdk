<?php

namespace Artbees\Lemonsqueezy\Resource;

use Artbees\Lemonsqueezy\Client;
use Artbees\Lemonsqueezy\Entity\Customer;

class CustomerResource extends Resource
{
    public function __construct(Client $client)
    {
        parent::__construct($client);
        $this->endpoint = 'customers';
        $this->entityClass = Customer::class;
        $this->supportedOperations = [
            'list' => true,
            'retrieve' => true,
            'create' => true,
            'update' => true,
            'delete' => false,
        ];
    }
} 