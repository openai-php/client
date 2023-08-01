<?php

/**
 * @return array<string, mixed>
 */
function moderationResource(): array
{
    return [
        'id' => 'modr-5MWoLO',
        'model' => 'text-moderation-001',
        'results' => [
            [
                'categories' => [
                    'hate' => false,
                    'hate/threatening' => true,
                    'harassment' => false,
                    'harassment/threatening' => false,
                    'self-harm' => false,
                    'self-harm/intent' => false,
                    'self-harm/instructions' => false,
                    'sexual' => false,
                    'sexual/minors' => false,
                    'violence' => true,
                    'violence/graphic' => false,
                ],
                'category_scores' => [
                    'hate' => 0.22714105248451233,
                    'hate/threatening' => 0.4132447838783264,
                    'harassment' => 0.1602763684674149,
                    'harassment/threatening' => 0.1602763684674149,
                    'self-harm' => 0.005232391878962517,
                    'self-harm/intent' => 0.005134391873962517,
                    'self-harm/instructions' => 0.005132591874962517,
                    'sexual' => 0.01407341007143259,
                    'sexual/minors' => 0.0038522258400917053,
                    'violence' => 0.9223177433013916,
                    'violence/graphic' => 0.036865197122097015,
                ],
                'flagged' => true,
            ],
        ],
    ];
}
