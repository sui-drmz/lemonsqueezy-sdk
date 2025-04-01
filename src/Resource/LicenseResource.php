<?php

namespace Artbees\Lemonsqueezy\Resource;

use Artbees\Lemonsqueezy\Client;
use Artbees\Lemonsqueezy\Entity\License;

class LicenseResource extends Resource
{
    public function __construct(Client $client)
    {
        parent::__construct($client);
        $this->endpoint = 'licenses';
        $this->entityClass = License::class;
        $this->supportedOperations = [
            'list' => true,
            'retrieve' => true,
            'create' => false,
            'update' => true,
            'delete' => false,
        ];
    }

    /**
     * Validate a license key
     *
     * @param string $key
     * @return License
     */
    public function validate(string $key): License
    {
        $response = $this->client->post('/v1/licenses/validate', ['key' => $key]);
        return new License($response['data']);
    }

    /**
     * Deactivate a license
     *
     * @param string $id
     * @return bool
     */
    public function deactivate(string $id): bool
    {
        $this->client->post("/v1/licenses/{$id}/deactivate");
        return true;
    }
} 