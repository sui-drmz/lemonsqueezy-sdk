<?php

namespace Artbees\Lemonsqueezy;

use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Exception\GuzzleException;

class Client
{
    private string $apiKey;
    private GuzzleClient $client;
    private const BASE_URL = 'https://api.lemonsqueezy.com/v1/';
    private ?string $storeId = null;

    public function __construct(string $apiKey)
    {
        $this->apiKey = $apiKey;
        $this->client = new GuzzleClient([
            'base_uri' => self::BASE_URL,
            'headers' => [
                'Authorization' => "Bearer {$this->apiKey}",
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ],
        ]);
    }

    /**
     * Get the store ID
     *
     * @return string|null
     */
    public function getStoreId(): ?string
    {
        return $this->storeId;
    }

    /**
     * Set the store ID
     *
     * @param string $storeId
     * @return void
     */
    public function setStoreId(string $storeId): void
    {
        $this->storeId = $storeId;
    }

    /**
     * Make a GET request to the API
     *
     * @param string $endpoint
     * @param array $query
     * @return array
     * @throws GuzzleException
     */
    public function get(string $endpoint, array $query = []): array
    {
        $response = $this->client->get($endpoint, [
            'query' => $query,
        ]);

        return json_decode($response->getBody()->getContents(), true);
    }

    /**
     * Make a POST request to the API
     *
     * @param string $endpoint
     * @param array $data
     * @return array
     * @throws GuzzleException
     */
    public function post(string $endpoint, array $data = []): array
    {
        $response = $this->client->post($endpoint, [
            'json' => $data,
        ]);

        return json_decode($response->getBody()->getContents(), true);
    }

    /**
     * Make a PUT request to the API
     *
     * @param string $endpoint
     * @param array $data
     * @return array
     * @throws GuzzleException
     */
    public function put(string $endpoint, array $data = []): array
    {
        $response = $this->client->put($endpoint, [
            'json' => $data,
        ]);

        return json_decode($response->getBody()->getContents(), true);
    }

    /**
     * Make a DELETE request to the API
     *
     * @param string $endpoint
     * @return array
     * @throws GuzzleException
     */
    public function delete(string $endpoint): array
    {
        $response = $this->client->delete($endpoint);

        return json_decode($response->getBody()->getContents(), true);
    }
}
