<?php

namespace OpenAI\Testing\Responses\Fixtures\Responses\Tool;

final class ShellContainerAutoFixture
{
    public const ATTRIBUTES = [
        'type' => 'container_auto',
        'file_ids' => [
            'file_123',
        ],
        'memory_limit' => '4g',
        'network_policy' => [
            'type' => 'allowlist',
            'allowed_domains' => [
                'example.com',
            ],
            'domain_secrets' => [
                [
                    'domain' => 'example.com',
                    'name' => 'api_key',
                    'value' => 'test-secret',
                ],
            ],
        ],
        'skills' => [
            [
                'type' => 'skill_reference',
                'skill_id' => 'skill_123',
                'version' => 'latest',
            ],
            [
                'type' => 'inline',
                'name' => 'sandbox-word-count',
                'description' => 'Count words in a supplied text.',
                'source' => [
                    'type' => 'base64',
                    'media_type' => 'application/zip',
                    'data' => 'UEsFBgAAAAAAAAAAAAAAAAAAAAAAAA==',
                ],
            ],
        ],
    ];
}
