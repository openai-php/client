<?php

use OpenAI\Responses\Images\CreateResponseData;

test('from with url', function () {
    $response = CreateResponseData::from(imageCreateWithUrl()['data'][0]);

    expect($response)
        ->url->toBe('https://openai.com/image.png')
        ->b64_json->toBeEmpty();
});

test('to array with url', function () {
    $result = CreateResponseData::from(imageCreateWithUrl()['data'][0]);

    expect($result->toArray())
        ->toBe(imageCreateWithUrl()['data'][0]);
});

test('from with url from dall-e 3', function () {
    $response = CreateResponseData::from(imageCreateWithUrlDallE3()['data'][0]);

    expect($response)
        ->url->toBe('https://openai.com/image.png')
        ->revisedPrompt->toBe('This is a revised prompt.')
        ->b64_json->toBeEmpty();
});

test('to array with url from dall-e 3', function () {
    $result = CreateResponseData::from(imageCreateWithUrlDallE3()['data'][0]);

    expect($result->toArray())
        ->toBe(imageCreateWithUrlDallE3()['data'][0]);
});

test('from with b64_json', function () {
    $response = CreateResponseData::from(imageCreateWithB46Json()['data'][0]);

    expect($response)
        ->url->toBeEmpty()
        ->b64_json->toBe('iVBORw0KGgoAAAAN...');
});

test('to array with b64_json', function () {
    $result = CreateResponseData::from(imageCreateWithB46Json()['data'][0]);

    expect($result->toArray())
        ->toBe(imageCreateWithB46Json()['data'][0]);
});

test('to array with b64_json when url is zero as string', function () {
    $data = imageCreateWithB46Json()['data'][0];
    $data['url'] = '0';

    $result = CreateResponseData::from($data);

    expect($result->toArray())
        ->toBe(imageCreateWithB46Json()['data'][0]);
});
