<?php

namespace Artbees\Lemonsqueezy\Resource;

use Artbees\Lemonsqueezy\Client;
use Artbees\Lemonsqueezy\Entity\SubscriptionItem;

class SubscriptionItemResource extends Resource
{
    public function __construct(Client $client)
    {
        parent::__construct($client);
        $this->endpoint = 'subscription-items';
        $this->entityClass = SubscriptionItem::class;
        $this->supportedOperations = [
            'list' => true,
            'retrieve' => true,
            'create' => false,
            'update' => true,
            'delete' => false,
        ];
    }
} 