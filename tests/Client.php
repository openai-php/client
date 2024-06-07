<?php

use OpenAI\Resources\Batches;
use OpenAI\Resources\Completions;
use OpenAI\Resources\Models;

it('has models', function () {
    $openAI = OpenAI::client('foo');

    expect($openAI->models())->toBeInstanceOf(Models::class);
});

it('has completions', function () {
    $openAI = OpenAI::client('foo');

    expect($openAI->completions())->toBeInstanceOf(Completions::class);
});

it('has batches', function () {
    $openAI = OpenAI::client('foo');

    expect($openAI->batches())->toBeInstanceOf(Batches::class);
});
