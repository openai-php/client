<?php

use OpenAI\Responses\Meta\MetaInformation;
use OpenAI\Responses\Responses\DeleteResponse;

test('from', function () {
    $result = DeleteResponse::from(deleteResponseResource(), meta());

    expect($result)
        ->id->toBe('resp_67ccf18ef5fc8190b16dbee19bc54e5f087bb177ab789d5c')
        ->object->toBe('response.deleted')
        ->deleted->toBe(true)
        ->meta()->toBeInstanceOf(MetaInformation::class);
});

test('as array accessible', function () {
    $result = DeleteResponse::from(deleteResponseResource(), meta());

    expect($result['id'])
        ->toBe('resp_67ccf18ef5fc8190b16dbee19bc54e5f087bb177ab789d5c');
});

test('to array', function () {
    $result = DeleteResponse::from(deleteResponseResource(), meta());

    expect($result->toArray())
        ->toBe(deleteResponseResource());
});

test('fake', function () {
    $response = DeleteResponse::fake();

    expect($response)
        ->id->toBe('resp_67ccf18ef5fc8190b16dbee19bc54e5f087bb177ab789d5c')
        ->deleted->toBe(true);
});

test('fake with override', function () {
    $response = DeleteResponse::fake([
        'id' => 'resp_1234',
        'deleted' => false,
    ]);

    expect($response)
        ->id->toBe('resp_1234')
        ->deleted->toBe(false);
});
