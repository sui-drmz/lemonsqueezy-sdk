<?php

namespace Artbees\Lemonsqueezy\Http;

use Artbees\Lemonsqueezy\Config;
use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\RequestOptions;

class Client
{
    private Config $config;
    private GuzzleClient $client;

    public function __construct(Config $config)
    {
        $this->config = $config;
        $this->client = new GuzzleClient([
            'base_uri' => $config->getBaseUrl(),
            'headers' => [
                'Authorization' => 'Bearer ' . $config->getApiKey(),
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ],
        ]);
    }

    /**
     * Send a GET request
     *
     * @param string $uri
     * @param array $query
     * @return array
     * @throws GuzzleException
     */
    public function get(string $uri, array $query = []): array
    {
        $response = $this->client->get($uri, [
            RequestOptions::QUERY => $query,
        ]);

        return json_decode($response->getBody()->getContents(), true);
    }

    /**
     * Send a POST request
     *
     * @param string $uri
     * @param array $data
     * @return array
     * @throws GuzzleException
     */
    public function post(string $uri, array $data = []): array
    {
        $response = $this->client->post($uri, [
            RequestOptions::JSON => $data,
        ]);

        return json_decode($response->getBody()->getContents(), true);
    }

    /**
     * Send a PUT request
     *
     * @param string $uri
     * @param array $data
     * @return array
     * @throws GuzzleException
     */
    public function put(string $uri, array $data = []): array
    {
        $response = $this->client->put($uri, [
            RequestOptions::JSON => $data,
        ]);

        return json_decode($response->getBody()->getContents(), true);
    }

    /**
     * Send a DELETE request
     *
     * @param string $uri
     * @return array
     * @throws GuzzleException
     */
    public function delete(string $uri): array
    {
        $response = $this->client->delete($uri);

        return json_decode($response->getBody()->getContents(), true);
    }
} 