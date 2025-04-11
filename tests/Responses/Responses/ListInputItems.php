<?php
use OpenAI\Responses\Responses\ListInputItems;
use OpenAI\Responses\Meta\MetaInformation;

test('from', function () {
    $result = ListInputItems::from(listInputItemsResource(), meta());

    expect($result)
        ->toBeInstanceOf(ListInputItems::class)
        ->object->toBe('list')
        ->data->toBeArray()
        ->firstId->toBe('msg_KNsDDwE41BUAHhcPNpDkdHWZ')
        ->lastId->toBe('msg_KNsDDwE41BUAHhcPNpDkdHWZ')
        ->hasMore->toBeFalse()
        ->meta()->toBeInstanceOf(MetaInformation::class);
});

test('as array accessible', function () {
    $result = ListInputItems::from(listInputItemsResource(), meta());

    expect($result['object'])->toBe('list');
});

test('to array', function () {
    $result = ListInputItems::from(listInputItemsResource(), meta());

    expect($result->toArray())
        ->toBeArray()
        ->toBe(listInputItemsResource());
});

test('fake', function () {
    $response = ListInputItems::fake();

    expect($response)
        ->object->toBe('list')
        ->firstId->toBe('msg_KNsDDwE41BUAHhcPNpDkdHWZ')
        ->hasMore->toBeFalse();
});

test('fake with override', function () {
    $response = ListInputItems::fake([
        'object' => 'custom_list',
        'first_id' => 'msg_1234',
        'has_more' => true
    ]);

    expect($response)
        ->object->toBe('custom_list')
        ->firstId->toBe('msg_1234')
        ->hasMore->toBeTrue();
});
