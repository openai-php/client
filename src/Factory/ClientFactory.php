<?php

declare(strict_types=1);

namespace OpenAI\Factory;

use GuzzleHttp\Client as GuzzleClient;
use OpenAI\Client;
use OpenAI\Transporters\HttpTransporter;
use OpenAI\ValueObjects\ApiKey;
use OpenAI\ValueObjects\Transporter\BaseUri;
use OpenAI\ValueObjects\Transporter\Headers;

final class ClientFactory
{
    public function __construct(
        private readonly string $apiKey
    ) {
    }

    private string $baseUri = 'api.openai.com/v1';

    private ?string $organization = null;

    public function make(): Client
    {
        $apiKey = ApiKey::from($this->apiKey);

        $baseUri = BaseUri::from($this->baseUri);

        $headers = Headers::withAuthorization($apiKey);

        if ($this->organization !== null) {
            $headers = $headers->withOrganization($this->organization);
        }

        $client = new GuzzleClient();

        $transporter = new HttpTransporter($client, $baseUri, $headers);

        return new Client($transporter);
    }

    public function withBaseUri(string $baseUri): self
    {
        $this->baseUri = $baseUri;

        return $this;
    }

    public function withOrganization(?string $organization): self
    {
        $this->organization = $organization;

        return $this;
    }
}
