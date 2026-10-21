<?php

use OpenAI\Responses\Agents\Environments\Objects\Network;

test('from', function () {
    $result = Network::from(['access' => 'restricted', 'allowed_domains' => ['pypi.org']]);

    expect($result)
        ->access->toBe('restricted')
        ->allowedDomains->toBe(['pypi.org']);
});

test('to array', function () {
    $result = Network::from(['access' => 'enabled', 'allowed_domains' => []]);

    expect($result->toArray())
        ->toBe(['access' => 'enabled', 'allowed_domains' => []]);
});
