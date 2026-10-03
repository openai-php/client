<?php

use OpenAI\Responses\Responses\Output\OutputShellCall;
use OpenAI\Responses\Responses\Tool\ShellContainerReference;
use OpenAI\Responses\Responses\Tool\ShellLocalEnvironment;
use OpenAI\Testing\Responses\Fixtures\Responses\Output\OutputShellCallFixture;

test('parses shell calls with optional execution limits and environments', function (array $attributes) {
    $response = OutputShellCall::from($attributes);

    expect($response->toArray())->toEqual($attributes);
    expect($response['call_id'])->toBe('call_123');
})->with([
    'hosted call' => [OutputShellCallFixture::ATTRIBUTES],
    'minimal input call' => [['type' => 'shell_call', 'call_id' => 'call_123', 'action' => ['commands' => ['echo hello']]]],
]);

test('fakes shell calls and parses nullable limits and caller metadata', function () {
    $hosted = OutputShellCall::fake();
    expect($hosted->environment)->toBeInstanceOf(ShellContainerReference::class);
    expect($hosted->toArray())->toEqual(OutputShellCallFixture::ATTRIBUTES);

    $attributes = OutputShellCallFixture::ATTRIBUTES;
    $attributes['environment'] = ['type' => 'local'];
    $attributes['action']['timeout_ms'] = null;
    $attributes['action']['max_output_length'] = null;
    $attributes['caller'] = ['type' => 'program', 'caller_id' => 'call_prog_123'];
    $attributes['created_by'] = 'agent_123';
    $response = OutputShellCall::from($attributes);

    expect($response->environment)->toBeInstanceOf(ShellLocalEnvironment::class);
    expect($response->action->timeoutMs)->toBeNull();
    expect($response->action->maxOutputLength)->toBeNull();
    expect($response->caller->callerId)->toBe('call_prog_123');
    expect($response->toArray()['created_by'])->toBe('agent_123');
});
