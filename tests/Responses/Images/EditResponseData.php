<?php

use OpenAI\Responses\Images\EditResponseData;

test('from with url', function () {
    $response = EditResponseData::from(imageEditWithUrl()['data'][0]);

    expect($response)
        ->url->toBe('https://openai.com/image.png')
        ->b64_json->toBeEmpty();
});

test('to array with url', function () {
    $result = EditResponseData::from(imageEditWithUrl()['data'][0]);

    expect($result->toArray())
        ->toBe(imageEditWithUrl()['data'][0]);
});

test('from with b64_json', function () {
    $response = EditResponseData::from(imageEditWithB46Json()['data'][0]);

    expect($response)
        ->url->toBeEmpty()
        ->b64_json->toBe('iVBORw0KGgoAAAAN...');
});

test('to array with b64_json', function () {
    $result = EditResponseData::from(imageEditWithB46Json()['data'][0]);

    expect($result->toArray())
        ->toBe(imageEditWithB46Json()['data'][0]);
});

test('to array with b64_json when url is zero as string', function () {
    $data = imageEditWithB46Json()['data'][0];
    $data['url'] = '0';

    $result = EditResponseData::from($data);

    expect($result->toArray())
        ->toBe(imageEditWithB46Json()['data'][0]);
});
