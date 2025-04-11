<?php
use OpenAI\Responses\Responses\DeleteResponse;
use OpenAI\Responses\Meta\MetaInformation;

test('from', function () {
    $result = DeleteResponse::from(deleteResponseResource(), meta());

    expect($result)
        ->id->toBe('asst_SMzoVX8XmCZEg1EbMHoAm8tc')
        ->object->toBe('response.deleted')
        ->deleted->toBe(true)
        ->meta()->toBeInstanceOf(MetaInformation::class);
});

test('as array accessible', function () {
    $result = DeleteResponse::from(deleteResponseResource(), meta());

    expect($result['id'])
        ->toBe('asst_SMzoVX8XmCZEg1EbMHoAm8tc');
});

test('to array', function () {
    $result = DeleteResponse::from(deleteResponseResource(), meta());

    expect($result->toArray())
        ->toBe(deleteResponseResource());
});

test('fake', function () {
    $response = DeleteResponse::fake();

    expect($response)
        ->id->toBe('asst_SMzoVX8XmCZEg1EbMHoAm8tc')
        ->deleted->toBe(true);
});

test('fake with override', function () {
    $response = DeleteResponse::fake([
        'id' => 'asst_1234',
        'deleted' => false,
    ]);

    expect($response)
        ->id->toBe('asst_1234')
        ->deleted->toBe(false);
});
