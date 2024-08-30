<?php

namespace ApiProds\ManyIntegrations\Handler;

class Curl
{
    /**
     * Makes an HTTP request to the specified URL with the given parameters and headers.
     *
     * This method allows you to make HTTP requests using different methods such as GET, POST, PUT, and PATCH.
     * The headers and parameters for the request can be specified, and the response is returned as a string.
     * If the request encounters an error, an exception is thrown.
     *
     * @param  string  $url       The URL to which the request is made.
     * @param  array   $headers   Optional. An array of headers to include in the request. Defaults to ['Content-Type: application/json'].
     * @param  array   $params    Optional. An array of parameters to include in the request body for POST, PUT, or PATCH methods. Defaults to an empty array.
     * @param  string  $method    Optional. The HTTP method to use for the request. Defaults to 'GET'.
     * @return string             The response from the server.
     * @throws \Exception         If there is an error making the request.
     */
    public function request($url, $headers = ['Content-Type: application/json'], $params = [], $method = 'GET')
    {
        $ch = curl_init($url);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);

        if ($method === 'POST' || $method === 'PUT' || $method === 'PATCH') {
            $data = json_encode($params);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        }

        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        try {
            $response = curl_exec($ch);
            if (curl_errno($ch)) {
                throw new \Exception('Curl error: ' . curl_error($ch));
            }
            return $response;
        } catch (\Exception $e) {
            throw new \Exception('Request error: ' . $e->getMessage());
        } finally {
            curl_close($ch);
        }
    }
}
