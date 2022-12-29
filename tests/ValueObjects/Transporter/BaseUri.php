<?php

use OpenAI\ValueObjects\Transporter\BaseUri;

it('can be created from a string', function (string $expected, string $string) {
    $baseUri = BaseUri::from($string);

    expect($baseUri->toString())->toBe($expected);
})->with([
    'without protocol' => [
        'expected' => 'https://api.openai.com/v1/',
        'string' => 'api.openai.com/v1',
    ],
    'with https protocol' => [
        'expected' => 'https://api.openai.com/v1/',
        'string' => 'https://api.openai.com/v1',
    ],
    'with http protocol' => [
        'expected' => 'http://api.openai.com/v1/',
        'string' => 'http://api.openai.com/v1',
    ],
]);
