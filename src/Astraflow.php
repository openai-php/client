<?php

declare(strict_types=1);

use OpenAI\Client;
use OpenAI\Factory;

/**
 * Astraflow (by UCloud / 优刻得) is an OpenAI-compatible AI model aggregation
 * platform that provides access to 200+ models through two regional endpoints.
 *
 * Global endpoint : https://api-us-ca.umodelverse.ai/v1  (env: ASTRAFLOW_API_KEY)
 * China  endpoint : https://api.modelverse.cn/v1         (env: ASTRAFLOW_CN_API_KEY)
 *
 * Sign up at https://astraflow.ucloud.cn/
 */
final class Astraflow
{
    /**
     * Global endpoint base URI.
     */
    public const BASE_URI = 'https://api-us-ca.umodelverse.ai/v1';

    /**
     * China endpoint base URI.
     */
    public const BASE_URI_CN = 'https://api.modelverse.cn/v1';

    /**
     * Creates a new Astraflow client pointed at the **global** endpoint.
     *
     * Set the ASTRAFLOW_API_KEY environment variable to your API key, then:
     *
     *   $client = Astraflow::client(getenv('ASTRAFLOW_API_KEY'));
     */
    public static function client(string $apiKey): Client
    {
        return self::factory()
            ->withApiKey($apiKey)
            ->withBaseUri(self::BASE_URI)
            ->make();
    }

    /**
     * Creates a new Astraflow client pointed at the **China** endpoint.
     *
     * Set the ASTRAFLOW_CN_API_KEY environment variable to your API key, then:
     *
     *   $client = Astraflow::clientCn(getenv('ASTRAFLOW_CN_API_KEY'));
     */
    public static function clientCn(string $apiKey): Client
    {
        return self::factory()
            ->withApiKey($apiKey)
            ->withBaseUri(self::BASE_URI_CN)
            ->make();
    }

    /**
     * Creates a new factory instance so you can fully customise the Astraflow client.
     *
     *   $client = Astraflow::factory()
     *       ->withApiKey(getenv('ASTRAFLOW_API_KEY'))
     *       ->withBaseUri(Astraflow::BASE_URI)
     *       ->withHttpHeader('X-Custom-Header', 'value')
     *       ->make();
     */
    public static function factory(): Factory
    {
        return new Factory;
    }
}
