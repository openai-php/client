<?php

declare(strict_types=1);

use OpenAI\Client;
use OpenAI\Factory;

final class OpenAI
{
    /**
     * Creates a new Open AI Client with the given API token.
     */
    public static function client(string $apiKey, ?string $organization = null, ?string $project = null): Client
    {
        return self::factory()
            ->withApiKey($apiKey)
            ->withOrganization($organization)
            ->withProject($project)
            ->make();
    }

    /**
     * Creates a new Astraflow Client (global endpoint) with the given API key.
     *
     * Astraflow by UCloud — OpenAI-compatible platform supporting 200+ models (global endpoint).
     * Sign up at https://astraflow.ucloud-global.com
     */
    public static function astraflow(string $apiKey): Client
    {
        return self::factory()
            ->withApiKey($apiKey)
            ->withBaseUri('api-us-ca.umodelverse.ai/v1')
            ->make();
    }

    /**
     * Creates a new Astraflow Client (China endpoint) with the given API key.
     *
     * Astraflow by UCloud — OpenAI-compatible platform supporting 200+ models (China endpoint).
     * Sign up at https://astraflow.ucloud.cn
     */
    public static function astraflowCn(string $apiKey): Client
    {
        return self::factory()
            ->withApiKey($apiKey)
            ->withBaseUri('api.modelverse.cn/v1')
            ->make();
    }

    /**
     * Creates a new factory instance to configure a custom Open AI Client
     */
    public static function factory(): Factory
    {
        return new Factory;
    }
}
