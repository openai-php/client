<?php

use OpenAI\Responses\Meta\MetaInformation;
use OpenAI\Responses\VectorStores\FileBatches\VectorStoreFileBatchResponse;
use OpenAI\Responses\VectorStores\Files\VectorStoreFileListResponse;
use OpenAI\Responses\VectorStores\Files\VectorStoreFileResponse;
use OpenAI\Responses\VectorStores\VectorStoreResponseFileCounts;
use OpenAI\ValueObjects\Transporter\Response;

test('create', function () {
    $client = mockClient('POST', 'vector_stores/vs_abc123/file_batches', [], Response::from(vectorStoreFileBatchResource(), metaHeaders()));

    $result = $client->vectorStores()->batches()->create('vs_abc123', []);

    expect($result)
        ->toBeInstanceOf(VectorStoreFileBatchResponse::class)
        ->id->toBe('vsfb_abc123')
        ->object->toBe('vector_store.file_batch')
        ->createdAt->toBe(1699061776)
        ->vectorStoreId->toBe('vs_abc123')
        ->status->toBe('cancelling')
        ->fileCounts->toBeInstanceOf(VectorStoreResponseFileCounts::class);

    expect($result->meta())
        ->toBeInstanceOf(MetaInformation::class);
});

test('retrieve', function () {
    $client = mockClient('GET', 'vector_stores/vs_abc123/file_batches/vsfb_abc123', [], Response::from(vectorStoreFileBatchResource(), metaHeaders()));

    $result = $client->vectorStores()->batches()->retrieve('vs_abc123', 'vsfb_abc123');

    expect($result)
        ->toBeInstanceOf(VectorStoreFileBatchResponse::class)
        ->id->toBe('vsfb_abc123')
        ->object->toBe('vector_store.file_batch')
        ->createdAt->toBe(1699061776)
        ->vectorStoreId->toBe('vs_abc123')
        ->status->toBe('cancelling')
        ->fileCounts->toBeInstanceOf(VectorStoreResponseFileCounts::class);

    expect($result->meta())
        ->toBeInstanceOf(MetaInformation::class);
});

test('cancel', function () {
    $client = mockClient('DELETE', 'vector_stores/vs_abc123/file_batches/vsfb_abc123', [], Response::from(vectorStoreFileBatchResource(), metaHeaders()));

    $result = $client->vectorStores()->batches()->cancel('vs_abc123', 'vsfb_abc123');

    expect($result)
        ->toBeInstanceOf(VectorStoreFileBatchResponse::class)
        ->id->toBe('vsfb_abc123')
        ->object->toBe('vector_store.file_batch')
        ->createdAt->toBe(1699061776)
        ->vectorStoreId->toBe('vs_abc123')
        ->status->toBe('cancelling')
        ->fileCounts->toBeInstanceOf(VectorStoreResponseFileCounts::class);

    expect($result->meta())
        ->toBeInstanceOf(MetaInformation::class);
});

test('list', function () {
    $client = mockClient('GET', 'vector_stores/vs_abc123/file_batches/vsfb_abc123/files', [], Response::from(vectorStoreFileListResource(), metaHeaders()));

    $result = $client->vectorStores()->batches()->listFiles('vs_abc123', 'vsfb_abc123');

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
