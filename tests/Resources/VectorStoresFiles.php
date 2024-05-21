<?php

use OpenAI\Responses\Meta\MetaInformation;
use OpenAI\Responses\VectorStores\Files\VectorStoreFileDeleteResponse;
use OpenAI\Responses\VectorStores\Files\VectorStoreFileListResponse;
use OpenAI\Responses\VectorStores\Files\VectorStoreFileResponse;
use OpenAI\ValueObjects\Transporter\Response;

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
