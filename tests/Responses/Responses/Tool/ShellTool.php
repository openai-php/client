<?php

use OpenAI\Actions\Responses\ToolObjects;
use OpenAI\Responses\Responses\Tool\ShellContainerAuto;
use OpenAI\Responses\Responses\Tool\ShellContainerReference;
use OpenAI\Responses\Responses\Tool\ShellInlineSkill;
use OpenAI\Responses\Responses\Tool\ShellLocalEnvironment;
use OpenAI\Responses\Responses\Tool\ShellSkillReference;
use OpenAI\Responses\Responses\Tool\ShellTool;
use OpenAI\Testing\Responses\Fixtures\Responses\Tool\ShellContainerAutoFixture;
use OpenAI\Testing\Responses\Fixtures\Responses\Tool\ShellContainerReferenceFixture;
use OpenAI\Testing\Responses\Fixtures\Responses\Tool\ShellLocalEnvironmentFixture;
use OpenAI\Testing\Responses\Fixtures\Responses\Tool\ShellToolFixture;

test('parses shell tools and environments', function (array $attributes, ?string $environmentClass) {
    $response = ToolObjects::parse([$attributes])[0];

    expect($response)->toBeInstanceOf(ShellTool::class)
        ->toArray()->toEqual($attributes);
    expect($response['type'])->toBe('shell');

    if ($environmentClass === null) {
        expect($response->environment)->toBeNull();
    } else {
        expect($response->environment)->toBeInstanceOf($environmentClass);
    }
})->with([
    'auto with both hosted skill attachments' => [
        ['type' => 'shell', 'environment' => ShellContainerAutoFixture::ATTRIBUTES, 'allowed_callers' => ['direct', 'programmatic']],
        ShellContainerAuto::class,
    ],
    'container reference returned by hosted shell' => [
        ['type' => 'shell', 'environment' => ShellContainerReferenceFixture::ATTRIBUTES], ShellContainerReference::class,
    ],
    'local skills' => [
        ['type' => 'shell', 'environment' => ShellLocalEnvironmentFixture::ATTRIBUTES], ShellLocalEnvironment::class,
    ],
    'minimal auto' => [['type' => 'shell', 'environment' => ['type' => 'container_auto']], ShellContainerAuto::class],
    'minimal local' => [['type' => 'shell', 'environment' => ['type' => 'local']], ShellLocalEnvironment::class],
    'omitted environment' => [['type' => 'shell'], null],
]);

test('fakes shell tools with typed skill attachments', function () {
    $response = ShellTool::fake();

    expect($response->environment)->toBeInstanceOf(ShellContainerAuto::class);
    expect($response->environment->skills[0])->toBeInstanceOf(ShellSkillReference::class);
    expect($response->environment->skills[1])->toBeInstanceOf(ShellInlineSkill::class);
    expect($response->toArray())->toEqual(ShellToolFixture::ATTRIBUTES);

    $minimal = ShellTool::from(['type' => 'shell', 'environment' => null, 'allowed_callers' => null]);
    expect($minimal->environment)->toBeNull()
        ->and($minimal->allowedCallers)->toBeNull();
});
