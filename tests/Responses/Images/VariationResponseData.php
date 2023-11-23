<?php

use OpenAI\Responses\Images\VariationResponseData;

test('from with url', function () {
    $response = VariationResponseData::from(imageVariationWithUrl()['data'][0]);

    expect($response)
        ->url->toBe('https://openai.com/image.png')
        ->b64_json->toBeEmpty();
});

test('to array with url', function () {
    $result = VariationResponseData::from(imageVariationWithUrl()['data'][0]);

    expect($result->toArray())
        ->toBe(imageVariationWithUrl()['data'][0]);
});

test('from with b64_json', function () {
    $response = VariationResponseData::from(imageVariationWithB46Json()['data'][0]);

    expect($response)
        ->url->toBeEmpty()
        ->b64_json->toBe('iVBORw0KGgoAAAAN...');
});

test('to array with b64_json', function () {
    $result = VariationResponseData::from(imageVariationWithB46Json()['data'][0]);

    expect($result->toArray())
        ->toBe(imageVariationWithB46Json()['data'][0]);
});

test('to array with b64_json when url is zero as string', function () {
    $data = imageVariationWithB46Json()['data'][0];
    $data['url'] = '0';

    $result = VariationResponseData::from($data);

    expect($result->toArray())
        ->toBe(imageVariationWithB46Json()['data'][0]);
});
