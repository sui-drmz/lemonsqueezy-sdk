<?php

namespace Artbees\Lemonsqueezy\Resource;

use Artbees\Lemonsqueezy\Client;
use Artbees\Lemonsqueezy\Entity\User;

class UserResource extends Resource
{
    public function __construct(Client $client)
    {
        parent::__construct($client);
        $this->endpoint = 'users';
        $this->entityClass = User::class;
        $this->supportedOperations = [
            'list' => false,
            'retrieve' => true,
            'create' => false,
            'update' => false,
            'delete' => false,
        ];
    }

    /**
     * Get the authenticated user
     *
     * @return User
     */
    public function getAuthenticatedUser(): User
    {
        $response = $this->client->get('/v1/users/me');
        return new User($response['data']);
    }
} 