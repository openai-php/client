<?php

use OpenAI\Resources\AssistantsFiles;
use OpenAI\Responses\Assistants\Files\AssistantFileDeleteResponse;
use OpenAI\Responses\Assistants\Files\AssistantFileListResponse;
use OpenAI\Responses\Assistants\Files\AssistantFileResponse;
use OpenAI\Testing\ClientFake;

it('records an assistant file create request', function () {
    $fake = new ClientFake([
        AssistantFileResponse::fake(),
    ]);

    $fake->assistants()->files()->create('asst_gxzBkD1wkKEloYqZ410pT5pd', [
        'file_id' => 'file-wB6RM6wHdA49HfS2DJ9fEyrH',
    ]);

    $fake->assertSent(AssistantsFiles::class, function ($method, $assistantId, $parameters) {
        return $method === 'create' &&
            $assistantId === 'asst_gxzBkD1wkKEloYqZ410pT5pd' &&
            $parameters['file_id'] === 'file-wB6RM6wHdA49HfS2DJ9fEyrH';
    });
});

it('records an assistant file retrieve request', function () {
    $fake = new ClientFake([
        AssistantFileResponse::fake(),
    ]);

    $fake->assistants()->files()->retrieve(
        assistantId: 'asst_gxzBkD1wkKEloYqZ410pT5pd',
        fileId: 'file-wB6RM6wHdA49HfS2DJ9fEyrH'
    );

    $fake->assertSent(AssistantsFiles::class, function ($method, $assistantId, $fileId) {
        return $method === 'retrieve' &&
            $assistantId === 'asst_gxzBkD1wkKEloYqZ410pT5pd' &&
            $fileId === 'file-wB6RM6wHdA49HfS2DJ9fEyrH';
    });
});

it('records an assistant file delete request', function () {
    $fake = new ClientFake([
        AssistantFileDeleteResponse::fake(),
    ]);

    $fake->assistants()->files()->delete(
        assistantId: 'asst_gxzBkD1wkKEloYqZ410pT5pd',
        fileId: 'file-wB6RM6wHdA49HfS2DJ9fEyrH'
    );

    $fake->assertSent(AssistantsFiles::class, function ($method, $assistantId, $fileId) {
        return $method === 'delete' &&
            $assistantId === 'asst_gxzBkD1wkKEloYqZ410pT5pd' &&
            $fileId === 'file-wB6RM6wHdA49HfS2DJ9fEyrH';
    });
});

it('records an assistant file list request', function () {
    $fake = new ClientFake([
        AssistantFileListResponse::fake(),
    ]);

    $fake->assistants()->files()->list('asst_gxzBkD1wkKEloYqZ410pT5pd', [
        'limit' => 2,
    ]);

    $fake->assertSent(AssistantsFiles::class, function ($method, $assistantId) {
        return $method === 'list' &&
            $assistantId === 'asst_gxzBkD1wkKEloYqZ410pT5pd';
    });
});
