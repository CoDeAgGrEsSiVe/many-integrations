<?php

namespace ApiProds\ManyIntegrations\Handler;

use GuzzleHttp\Client;

class Guzzle
{
    protected $client;

    /**
     * Initializes the HTTP client with the given base URI.
     *
     * This constructor sets up the HTTP client with the specified base URI for all subsequent requests.
     *
     * @param string $baseUri The base URI for the HTTP client.
     */
    public function __construct($baseUri)
    {
        $this->client = new Client([
            'base_uri' => $baseUri
        ]);
    }

    /**
     * Sends a GET request to the specified URL with optional headers and query parameters.
     *
     * This method sends a GET request and returns the response body as an associative array.
     *
     * @param string $url     The URL to send the GET request to.
     * @param array  $headers Optional. An array of headers to include in the request. Defaults to an empty array.
     * @param array  $params  Optional. An array of query parameters to include in the request. Defaults to an empty array.
     * @return array          The response body decoded as an associative array.
     */
    public function get($url, $headers = [], $params = []): array
    {
        $response = $this->client->request('GET', $url, [
            'headers' => $headers,
            'query' => $params
        ]);

        return json_decode($response->getBody()->getContents(), true);
    }

    /**
     * Sends a POST request to the specified URL with optional headers and JSON data.
     *
     * This method sends a POST request and returns the response body as an associative array.
     *
     * @param string $url     The URL to send the POST request to.
     * @param array  $headers Optional. An array of headers to include in the request. Defaults to an empty array.
     * @param array  $data    Optional. An array of data to include in the request body. Defaults to an empty array.
     * @return array          The response body decoded as an associative array.
     */
    public function post($url, $headers = [], $data = []): array
    {
        $response = $this->client->request('POST', $url, [
            'headers' => $headers,
            'json' => $data
        ]);

        return json_decode($response->getBody()->getContents(), true);
    }

    /**
     * Sends a PUT request to the specified URL with optional headers and JSON data.
     *
     * This method sends a PUT request and returns the response body as an associative array.
     *
     * @param string $url     The URL to send the PUT request to.
     * @param array  $headers Optional. An array of headers to include in the request. Defaults to an empty array.
     * @param array  $data    Optional. An array of data to include in the request body. Defaults to an empty array.
     * @return array          The response body decoded as an associative array.
     */
    public function put($url, $headers = [], $data = []): array
    {
        $response = $this->client->request('PUT', $url, [
            'headers' => $headers,
            'json' => $data
        ]);

        return json_decode($response->getBody()->getContents(), true);
    }

    /**
     * Sends a PATCH request to the specified URL with optional headers and JSON data.
     *
     * This method sends a PATCH request and returns the response body as an associative array.
     *
     * @param string $url     The URL to send the PATCH request to.
     * @param array  $headers Optional. An array of headers to include in the request. Defaults to an empty array.
     * @param array  $data    Optional. An array of data to include in the request body. Defaults to an empty array.
     * @return array          The response body decoded as an associative array.
     */
    public function patch($url, $headers = [], $data = []): array
    {
        $response = $this->client->request('PATCH', $url, [
            'headers' => $headers,
            'json' => $data
        ]);

        return json_decode($response->getBody()->getContents(), true);
    }

    /**
     * Sends a DELETE request to the specified URL with optional headers.
     *
     * This method sends a DELETE request and returns the status code of the response.
     *
     * @param string $url     The URL to send the DELETE request to.
     * @param array  $headers Optional. An array of headers to include in the request. Defaults to an empty array.
     * @return int            The status code of the response.
     */
    public function delete($url, $headers = []): int
    {
        $response = $this->client->request('DELETE', $url, [
            'headers' => $headers,
        ]);

        return $response->getStatusCode();
    }
}
