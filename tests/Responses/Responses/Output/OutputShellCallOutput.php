<?php

use OpenAI\Responses\Responses\Output\OutputShellCallOutput;
use OpenAI\Responses\Responses\Output\ShellCallOutcome\OutputShellCallOutcomeExit;
use OpenAI\Responses\Responses\Output\ShellCallOutcome\OutputShellCallOutcomeTimeout;
use OpenAI\Testing\Responses\Fixtures\Responses\Output\OutputShellCallOutputFixture;

test('parses shell exit and timeout outcomes without losing empty output', function () {
    $attributes = OutputShellCallOutputFixture::ATTRIBUTES;
    $attributes['output'][] = ['stdout' => '', 'stderr' => 'failed', 'outcome' => ['type' => 'exit', 'exit_code' => 1], 'created_by' => 'agent_123'];
    $attributes['output'][] = ['stdout' => '', 'stderr' => '', 'outcome' => ['type' => 'timeout']];
    $attributes['caller'] = ['type' => 'direct'];
    $attributes['created_by'] = 'agent_123';
    $response = OutputShellCallOutput::from($attributes);

    expect($response->output[0]->outcome)->toBeInstanceOf(OutputShellCallOutcomeExit::class);
    expect($response->output[0]->outcome->exitCode)->toBe(0);
    expect($response->output[1]->outcome->exitCode)->toBe(1);
    expect($response->output[2]->outcome)->toBeInstanceOf(OutputShellCallOutcomeTimeout::class);
    expect($response['call_id'])->toBe('call_123');
    expect($response->toArray())->toEqual($attributes);
});

test('fakes shell output and supports minimal input output items', function () {
    expect(OutputShellCallOutput::fake()->toArray())->toEqual(OutputShellCallOutputFixture::ATTRIBUTES);

    $attributes = ['type' => 'shell_call_output', 'call_id' => 'call_123', 'output' => []];
    expect(OutputShellCallOutput::from($attributes)->toArray())->toBe($attributes);
});
