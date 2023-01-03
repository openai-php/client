<?php

use OpenAI\Client;
use OpenAI\Factory\ClientFactory;

it('may create a client', function () {
    $openAI = OpenAI::client('foo');

    expect($openAI)->toBeInstanceOf(Client::class);
});

it('sets organization when provided', function () {
    $openAI = OpenAI::client('foo', 'nunomaduro');

    expect($openAI)->toBeInstanceOf(Client::class);
});

it('may create a client factory', function () {
    $openAI = OpenAI::factory('foo');

    expect($openAI)->toBeInstanceOf(ClientFactory::class);
});
