<?php

use OpenAI\Resources\VectorStoresFiles;
use OpenAI\Responses\Meta\MetaInformation;
use OpenAI\Responses\VectorStores\Files\VectorStoreFileContentResponse;
use OpenAI\Responses\VectorStores\Files\VectorStoreFileContentResponseChunk;
use OpenAI\Responses\VectorStores\Files\VectorStoreFileDeleteResponse;
use OpenAI\Responses\VectorStores\Files\VectorStoreFileListResponse;
use OpenAI\Responses\VectorStores\Files\VectorStoreFileResponse;
use OpenAI\Testing\ClientFake;
use OpenAI\Testing\Responses\Fixtures\VectorStores\Files\VectorStoreFileContentResponseFixture;
use OpenAI\ValueObjects\Transporter\Response;

test('retrieves parsed contents of a vector store file', function () {
    $body = VectorStoreFileContentResponseFixture::ATTRIBUTES;
    $body['has_more'] = true;
    $body['next_page'] = 'page_opaque';
    $parameters = ['page' => 'first+/='];
    $client = mockClient(
        'GET',
        'vector_stores/vs_abc123/files/file-abc123/content',
        $parameters,
        Response::from($body, metaHeaders()),
    );

    $result = $client->vectorStores()->files()->content('vs_abc123', 'file-abc123', $parameters);

    expect($result)->toBeInstanceOf(VectorStoreFileContentResponse::class)
        ->and($result->data[0])->toBeInstanceOf(VectorStoreFileContentResponseChunk::class)
        ->and($result->data[0]->text)->toBe('Annual plans have a 14-day refund window.')
        ->and($result->hasMore)->toBeTrue()
        ->and($result->nextPage)->toBe('page_opaque')
        ->and($result->meta()->requestId)->toBe(metaHeaders()['x-request-id'][0])
        ->and($result->toArray())->toBe($body);
});

test('retrieves an empty page of parsed file contents', function () {
    $body = ['object' => 'vector_store.file_content.page', 'data' => [], 'has_more' => false];
    $client = mockClient(
        'GET',
        'vector_stores/vs_abc123/files/file-abc123/content',
        [],
        Response::from($body, metaHeaders()),
    );

    $result = $client->vectorStores()->files()->content('vs_abc123', 'file-abc123');

    expect($result->data)->toBe([])
        ->and($result->hasMore)->toBeFalse()
        ->and($result->nextPage)->toBeNull();
});

test('parses vector store file chunks with optional fields', function () {
    $chunk = VectorStoreFileContentResponseChunk::from(['type' => 'text']);
    expect($chunk->toArray())->toBe(['type' => 'text', 'text' => null]);

    $chunk = VectorStoreFileContentResponseChunk::from(['text' => 'UTF-8 text: política de devolución']);
    expect($chunk->toArray())->toBe(['type' => null, 'text' => 'UTF-8 text: política de devolución']);
});

test('fakes parsed vector store file contents', function () {
    $response = VectorStoreFileContentResponse::fake();
    $client = new ClientFake([$response]);

    expect($client->vectorStores()->files()->content('vs_abc123', 'file-abc123'))->toBe($response);

    $client->assertSent(
        VectorStoresFiles::class,
        fn (string $method, string $vectorStoreId, string $fileId): bool => $method === 'content'
            && $vectorStoreId === 'vs_abc123'
            && $fileId === 'file-abc123',
    );
});

test('create', function () {
    $client = mockClient('POST', 'vector_stores/vs_xds05V7ep0QMGI5JmYnWsJwb/files', [], Response::from(vectorStoreFileResource(), metaHeaders()));

    $result = $client->vectorStores()->files()->create('vs_xds05V7ep0QMGI5JmYnWsJwb', []);

    expect($result)
        ->toBeInstanceOf(VectorStoreFileResponse::class)
        ->id->toBe('file-HuwUghQzWasTZeX3uRRawY5R')
        ->object->toBe('vector_store.file')
        ->usageBytes->toBe(29882)
        ->createdAt->toBe(1715956697)
        ->vectorStoreId->toBe('vs_xds05V7ep0QMGI5JmYnWsJwb')
        ->status->toBe('completed')
        ->lastError->toBeNull();

    expect($result->meta())
        ->toBeInstanceOf(MetaInformation::class);
});

test('list', function () {
    $client = mockClient('GET', 'vector_stores/vs_xds05V7ep0QMGI5JmYnWsJwb/files', [], Response::from(vectorStoreFileListResource(), metaHeaders()));

    $result = $client->vectorStores()->files()->list('vs_xds05V7ep0QMGI5JmYnWsJwb');

    expect($result)
        ->toBeInstanceOf(VectorStoreFileListResponse::class)
        ->object->toBe('list')
        ->data->toBeArray()->toHaveCount(2)
        ->data->{0}->toBeInstanceOf(VectorStoreFileResponse::class)
        ->firstId->toBe('file-HuwUghQzWasTZeX3uRRawY5R')
        ->lastId->toBe('file-HuwUghQzWasTZeX3uRRawY5R')
        ->hasMore->toBe(false);

    expect($result->meta())
        ->toBeInstanceOf(MetaInformation::class);
});

test('retrieve', function () {
    $client = mockClient('GET', 'vector_stores/vs_8VE2cQq1jTFlH7FizhYCzUz0/files/file-HuwUghQzWasTZeX3uRRawY5R', [], Response::from(vectorStoreFileResource(), metaHeaders()));

    $result = $client->vectorStores()->files()->retrieve('vs_8VE2cQq1jTFlH7FizhYCzUz0', 'file-HuwUghQzWasTZeX3uRRawY5R');

    expect($result)
        ->toBeInstanceOf(VectorStoreFileResponse::class)
        ->id->toBe('file-HuwUghQzWasTZeX3uRRawY5R')
        ->object->toBe('vector_store.file')
        ->usageBytes->toBe(29882)
        ->createdAt->toBe(1715956697)
        ->vectorStoreId->toBe('vs_xds05V7ep0QMGI5JmYnWsJwb')
        ->status->toBe('completed')
        ->lastError->toBeNull();

    expect($result->meta())
        ->toBeInstanceOf(MetaInformation::class);
});

test('updateAttributes', function () {
    $client = mockClient('POST', 'vector_stores/vs_8VE2cQq1jTFlH7FizhYCzUz0/files/file-HuwUghQzWasTZeX3uRRawY5R', [
        'attributes' => [
            'key1' => 'value1',
            'key2' => 2,
        ],
    ], Response::from(vectorStoreFileResource(), metaHeaders()));

    $result = $client->vectorStores()->files()->updateAttributes('vs_8VE2cQq1jTFlH7FizhYCzUz0', 'file-HuwUghQzWasTZeX3uRRawY5R', [
        'attributes' => [
            'key1' => 'value1',
            'key2' => 2,
        ],
    ]);

    expect($result)
        ->toBeInstanceOf(VectorStoreFileResponse::class)
        ->id->toBe('file-HuwUghQzWasTZeX3uRRawY5R')
        ->object->toBe('vector_store.file')
        ->usageBytes->toBe(29882)
        ->createdAt->toBe(1715956697)
        ->vectorStoreId->toBe('vs_xds05V7ep0QMGI5JmYnWsJwb')
        ->status->toBe('completed')
        ->lastError->toBeNull();

    expect($result->meta())
        ->toBeInstanceOf(MetaInformation::class);
});

test('delete', function () {
    $client = mockClient('DELETE', 'vector_stores/vs_xzlnkCbIQE50B9A8RzmcFmtP/files/file-HuwUghQzWasTZeX3uRRawY5R', [], Response::from(vectorStoreFileDeleteResource(), metaHeaders()));

    $result = $client->vectorStores()->files()->delete('vs_xzlnkCbIQE50B9A8RzmcFmtP', 'file-HuwUghQzWasTZeX3uRRawY5R');

    expect($result)
        ->toBeInstanceOf(VectorStoreFileDeleteResponse::class)
        ->id->toBe('file-HuwUghQzWasTZeX3uRRawY5R')
        ->object->toBe('vector_store.file.deleted')
        ->deleted->toBe(true);

    expect($result->meta())
        ->toBeInstanceOf(MetaInformation::class);
});
