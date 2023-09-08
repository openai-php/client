<?php

namespace OpenAI\Testing\Responses\Fixtures\FineTuning;

final class ListJobsResponseFixture
{
    public const ATTRIBUTES = [
        'object' => 'list',
        'data' => [
            RetrieveJobResponseFixture::ATTRIBUTES,
        ],
        'has_more' => false,
    ];
}
