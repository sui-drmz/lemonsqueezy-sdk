<?php

namespace Artbees\Lemonsqueezy\Resource;

use Artbees\Lemonsqueezy\Client;
use Artbees\Lemonsqueezy\Entity\Subscription;

class SubscriptionResource extends Resource
{
    public function __construct(Client $client)
    {
        parent::__construct($client);
        $this->endpoint = 'subscriptions';
        $this->entityClass = Subscription::class;
        $this->supportedOperations = [
            'list' => true,
            'retrieve' => true,
            'create' => false,
            'update' => true,
            'delete' => false,
        ];
    }

    /**
     * Cancel a subscription
     *
     * @param string $id
     * @return bool
     */
    public function cancel(string $id): bool
    {
        $this->client->post("/v1/subscriptions/{$id}/cancel");
        return true;
    }

    /**
     * Resume a subscription
     *
     * @param string $id
     * @return bool
     */
    public function resume(string $id): bool
    {
        $this->client->post("/v1/subscriptions/{$id}/resume");
        return true;
    }
} 