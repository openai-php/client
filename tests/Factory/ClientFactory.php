<?php

use GuzzleHttp\Client as GuzzleClient;
use OpenAI\Client;
use OpenAI\Factory\ClientFactory;
use OpenAI\Transporters\HttpTransporter;
use OpenAI\ValueObjects\ApiKey;
use OpenAI\ValueObjects\Transporter\BaseUri;
use OpenAI\ValueObjects\Transporter\Headers;

it('may create a client', function () {
    $openAI = (new ClientFactory('foo'))
        ->make();

    $expected = new Client(
        new HttpTransporter(
            new GuzzleClient(),
            BaseUri::from('api.openai.com/v1'),
            Headers::withAuthorization(ApiKey::from('foo'))
        )
    );

    expect($openAI)->toEqual($expected);
});

it('may create a client with base URI', function () {
    $openAI = (new ClientFactory('foo'))
        ->withBaseUri('http://api.custom-domain.com/v1')
        ->make();

    $expected = new Client(
        new HttpTransporter(
            new GuzzleClient(),
            BaseUri::from('http://api.custom-domain.com/v1'),
            Headers::withAuthorization(ApiKey::from('foo'))
        )
    );

    expect($openAI)->toEqual($expected);
});

it('may create a client with organization', function () {
    $openAI = (new ClientFactory('foo'))
        ->withOrganization('bar')
        ->make();

    $expected = new Client(
        new HttpTransporter(
            new GuzzleClient(),
            BaseUri::from('api.openai.com/v1'),
            Headers::withAuthorization(ApiKey::from('foo'))
                ->withOrganization('bar')
        )
    );

    expect($openAI)->toEqual($expected);
});
