<?php

namespace Artbees\Lemonsqueezy\Resource;

use Artbees\Lemonsqueezy\Client;
use Artbees\Lemonsqueezy\Entity\Webhook;

class WebhookResource extends Resource
{
    public function __construct(Client $client)
    {
        parent::__construct($client);
        $this->endpoint = 'webhooks';
        $this->entityClass = Webhook::class;
        $this->supportedOperations = [
            'list' => true,
            'retrieve' => true,
            'create' => true,
            'update' => true,
            'delete' => true,
        ];
    }
} 