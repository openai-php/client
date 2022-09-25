<?php

use OpenAI\ValueObjects\Transporter\BaseUri;

it('can be created from a string', function () {
    $baseUri = BaseUri::from('api.openai.com/v1');

    expect($baseUri->toString())->toBe('https://api.openai.com/v1/');
});
