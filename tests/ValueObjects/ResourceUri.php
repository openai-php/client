<?php

use OpenAI\Exceptions\InvalidArgumentException;
use OpenAI\ValueObjects\ResourceUri;

it('rejects a traversal sequence in the resource id', function () {
    expect(fn () => ResourceUri::delete('models', '../../organization/invites'))
        ->toThrow(InvalidArgumentException::class, 'Resource URI segments must not contain relative path references.');
});

it('rejects a traversal sequence for every id bearing factory', function (string $factory) {
    expect(fn () => ResourceUri::{$factory}('files', '..'))
        ->toThrow(InvalidArgumentException::class);
})->with(['modify', 'retrieveContent', 'cancel', 'delete']);

it('rejects a traversal sequence passed to retrieve', function () {
    expect(fn () => ResourceUri::retrieve('files', '..', ''))
        ->toThrow(InvalidArgumentException::class);
});

it('rejects a traversal sequence in an interpolated parent id', function () {
    $vectorStoreId = '../..';

    expect(fn () => ResourceUri::retrieve("vector_stores/{$vectorStoreId}/files", 'file-123', ''))
        ->toThrow(InvalidArgumentException::class);
});

it('rejects a traversal sequence in the resource itself', function (string $factory) {
    expect(fn () => ResourceUri::{$factory}('threads/../models'))
        ->toThrow(InvalidArgumentException::class);
})->with(['create', 'upload', 'list']);

it('rejects a single dot segment', function () {
    expect(fn () => ResourceUri::delete('models', '.'))
        ->toThrow(InvalidArgumentException::class);
});

it('leaves a fine tuned model id untouched', function () {
    expect(ResourceUri::delete('models', 'ft:gpt-4o-mini-2024-07-18:acme::ABC123')->toString())
        ->toBe('models/ft:gpt-4o-mini-2024-07-18:acme::ABC123');
});

it('leaves a suffix carrying a query string untouched', function () {
    expect(ResourceUri::retrieve('fine-tunes', 'ft-AF1WoRqd3aJ', '/events?stream=true')->toString())
        ->toBe('fine-tunes/ft-AF1WoRqd3aJ/events?stream=true');
});

it('allows dots inside a segment', function () {
    expect(ResourceUri::retrieve('models', 'gpt-3.5-turbo', '')->toString())
        ->toBe('models/gpt-3.5-turbo');
});

it('allows a nested resource', function () {
    expect(ResourceUri::retrieve('vector_stores/vs-123/files', 'file-456', '')->toString())
        ->toBe('vector_stores/vs-123/files/file-456');
});
