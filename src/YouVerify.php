<?php

namespace ApiProds\ManyIntegrations;

use Exception;
use ApiProds\ManyIntegrations\Handler\Guzzle;

/**
 * YouVerify class is responsible for verifying various KYC (Know Your Customer) documents.
 * 
 * This class leverages the Guzzle HTTP client to send POST requests for the verification process.
 * It requires a base URL and a token for authentication purposes.
 * Refrence - https://doc.youverify.co/
 */
class YouVerify
{
    protected $guzzle;
    protected $token;

    /**
     * Initializes the YouVerify object with a base URL and a token.
     * 
     * @param string $baseUrl The base URL for the HTTP client.
     * @param string $token The authentication token.
     */
    public function __construct($baseUrl, $token)
    {
        $this->token = $token;
        $this->guzzle = new Guzzle($baseUrl);
    }

    /**
     * Prepares the headers for HTTP requests.
     * 
     * @return array The headers array including Accept, token, and Content-Type.
     */
    private function headers()
    {
        return [
            'Accept' => 'application/json',
            'token' => $this->token,
            'Content-Type' => 'application/json',
        ];
    }

    /**
     * Initiates the verification process for a Nigerian National Identification Number (NIN).
     * 
     * This method sends a POST request to verify the NIN with premium verification and subject consent enabled.
     * 
     * @param string $nin The NIN to verify. Defaults to null.
     * @param string $url The URL for the NIN verification endpoint. Defaults to 'identity/ng/nin'.
     * @param array $data Optional data to be sent with the request. Defaults to an empty array.
     * @return array The response from the verification request.
     */
    public function verifyNIN($nin = null, $url = 'identity/ng/nin', $data = [])
    {
        if (empty($data)) {
            $nin = $nin ?? throw new Exception('NIN is required');
            $data = [
                "id" => $nin,
                "premiumNin" => true,
                "isSubjectConsent" => true
            ];
        }

        return $this->guzzle->post($url, $this->headers(), $data);
    }

    /**
     * Initiates the verification process for a Virtual Nigerian National Identification Number (vNIN).
     * 
     * This method sends a POST request to verify the vNIN with subject consent enabled.
     * 
     * @param string $vNin The vNIN to verify. Defaults to null.
     * @param string $url The URL for the vNIN verification endpoint. Defaults to 'identity/ng/vnin'.
     * @param array $data Optional data to be sent with the request. Defaults to an empty array.
     * @return array The response from the verification request.
     */
    public function verifyVNIN($vNin = null, $url = 'identity/ng/vnin', $data = [])
    {
        if (empty($data)) {
            $vNin = $vNin ?? throw new Exception('vNIN is required');
            $data = [
                "id" => $vNin,
                "isSubjectConsent" => true,
            ];
        }

        return $this->guzzle->post($url, $this->headers(), $data);
    }

    /**
     * Initiates the verification process for a Bank Verification Number (BVN).
     * 
     * This method sends a POST request to verify the BVN with premium verification, subject consent, and a unique request ID.
     * 
     * @param string $bvn The BVN to verify. Defaults to null.
     * @param string $url The URL for the BVN verification endpoint. Defaults to 'identity/ng/bvn'.
     * @param array $data Optional data to be sent with the request. Defaults to an empty array.
     * @return array The response from the verification request.
     */
    public function verifyBVN($bvn = null, $url = 'identity/ng/bvn', $data = [])
    {
        if (empty($data)) {
            $bvn = $bvn ?? throw new Exception('BVN is required');
            $data = [
                'id' => $bvn,
                'metadata' => [
                    'requestId' => uniqid(),
                ],
                'isSubjectConsent' => true,
                'premiumBVN' => true,
            ];
        }

        return $this->guzzle->post($url, $this->headers(), $data);
    }
}
