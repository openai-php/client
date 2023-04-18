<?php

use OpenAI\ValueObjects\Transporter\BaseUri;

it('can be created from a string', function () {
    $baseUri = BaseUri::from('api.openai.com/v1');

    expect($baseUri->toString())->toBe('https://api.openai.com/v1/');
});

it('can be created from a string with http protocol', function () {
    $baseUri = BaseUri::from('http://api.openai.com/v1');

    expect($baseUri->toString())->toBe('http://api.openai.com/v1/');
});

it('can be created from a string with https protocol', function () {
    $baseUri = BaseUri::from('https://api.openai.com/v1');

    expect($baseUri->toString())->toBe('https://api.openai.com/v1/');
});
