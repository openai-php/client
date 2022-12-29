<?php

declare(strict_types=1);

use OpenAI\Client;
use OpenAI\Factory\ClientFactory;

final class OpenAI
{
    /**
     * Creates a new Open AI Client with the given API key.
     */
    public static function client(string $apiKey, string $organization = null): Client
    {
        return self::factory($apiKey)
            ->withOrganization($organization)
            ->make();
    }

    /**
     * Creates a new Open AI Client factory with the given API key.
     */
    public static function factory(string $apiKey): ClientFactory
    {
        return new ClientFactory($apiKey);
    }
}
