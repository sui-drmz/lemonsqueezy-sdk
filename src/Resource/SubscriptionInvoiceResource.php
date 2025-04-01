<?php

namespace Artbees\Lemonsqueezy\Resource;

use Artbees\Lemonsqueezy\Client;
use Artbees\Lemonsqueezy\Entity\SubscriptionInvoice;

class SubscriptionInvoiceResource extends Resource
{
    public function __construct(Client $client)
    {
        parent::__construct($client);
        $this->endpoint = 'subscription-invoices';
        $this->entityClass = SubscriptionInvoice::class;
        $this->supportedOperations = [
            'list' => true,
            'retrieve' => true,
            'create' => false,
            'update' => false,
            'delete' => false,
        ];
    }
} 