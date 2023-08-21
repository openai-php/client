<p align="center">
    <img src="https://raw.githubusercontent.com/openai-php/client/main/art/example.png" width="600" alt="OpenAI PHP">
    <p align="center">
        <a href="https://github.com/openai-php/client/actions"><img alt="GitHub Workflow Status (main)" src="https://img.shields.io/github/actions/workflow/status/openai-php/client/tests.yml?branch=main&label=tests&style=round-square"></a>
        <a href="https://packagist.org/packages/openai-php/client"><img alt="Total Downloads" src="https://img.shields.io/packagist/dt/openai-php/client"></a>
        <a href="https://packagist.org/packages/openai-php/client"><img alt="Latest Version" src="https://img.shields.io/packagist/v/openai-php/client"></a>
        <a href="https://packagist.org/packages/openai-php/client"><img alt="License" src="https://img.shields.io/github/license/openai-php/client"></a>
    </p>
</p>

------
**OpenAI PHP** is a community-maintained PHP API client that allows you to interact with the [Open AI API](https://platform.openai.com/docs/api-reference/introduction). If you or your business relies on this package, it's important to support the developers who have contributed their time and effort to create and maintain this valuable tool:

- Nuno Maduro: **[github.com/sponsors/nunomaduro](https://github.com/sponsors/nunomaduro)**
- Sandro Gehri: **[github.com/sponsors/gehrisandro](https://github.com/sponsors/gehrisandro)**

## Table of Contents
- [Get Started](#get-started)
- [Usage](#usage)
  - [Models Resource](#models-resource)
  - [Completions Resource](#completions-resource)
  - [Chat Resource](#chat-resource)
  - [Audio Resource](#audio-resource)
  - [Edits Resource](#edits-resource)
  - [Embeddings Resource](#embeddings-resource)
  - [Files Resource](#files-resource)
  - [FineTunes Resource](#finetunes-resource)
  - [Moderations Resource](#moderations-resource)
  - [Images Resource](#images-resource)
- [Testing](#testing)
- [Services](#services)
  - [Azure](#azure)

## Get Started

> **Requires [PHP 8.1+](https://php.net/releases/)**

First, install OpenAI via the [Composer](https://getcomposer.org/) package manager:

```bash
composer require openai-php/client
```

Ensure that the `php-http/discovery` composer plugin is allowed to run or install a client manually if your project does not already have a PSR-18 client integrated.
```bash
composer require guzzlehttp/guzzle
```

Then, interact with OpenAI's API:

```php
$yourApiKey = getenv('YOUR_API_KEY');
$client = OpenAI::client($yourApiKey);

$result = $client->completions()->create([
    'model' => 'text-davinci-003',
    'prompt' => 'PHP is',
]);

echo $result['choices'][0]['text']; // an open-source, widely-used, server-side scripting language.
```

If necessary, it is possible to configure and create a separate client.

```php
$yourApiKey = getenv('YOUR_API_KEY');

$client = OpenAI::factory()
    ->withApiKey($yourApiKey)
    ->withOrganization('your-organization') // default: null
    ->withBaseUri('openai.example.com/v1') // default: api.openai.com/v1
    ->withHttpClient($client = new \GuzzleHttp\Client([])) // default: HTTP client found using PSR-18 HTTP Client Discovery
    ->withHttpHeader('X-My-Header', 'foo')
    ->withQueryParam('my-param', 'bar')
    ->withStreamHandler(fn (RequestInterface $request): ResponseInterface => $client->send($request, [
        'stream' => true // Allows to provide a custom stream handler for the http client.
    ]))
    ->make();
```

## Usage

### `Models` Resource

#### `list`

Lists the currently available models, and provides basic information about each one such as the owner and availability.

```php
$response = $client->models()->list();

$response->object; // 'list'

foreach ($response->data as $result) {
    $result->id; // 'text-davinci-003'
    $result->object; // 'model'
    // ...
}

$response->toArray(); // ['object' => 'list', 'data' => [...]]
```

#### `retrieve`

Retrieves a model instance, providing basic information about the model such as the owner and permissioning.

```php
$response = $client->models()->retrieve('text-davinci-003');

$response->id; // 'text-davinci-003'
$response->object; // 'model'
$response->created; // 1642018370
$response->ownedBy; // 'openai'
$response->root; // 'text-davinci-003'
$response->parent; // null

foreach ($response->permission as $result) {
    $result->id; // 'modelperm-7E53j9OtnMZggjqlwMxW4QG7' 
    $result->object; // 'model_permission' 
    $result->created; // 1664307523 
    $result->allowCreateEngine; // false 
    $result->allowSampling; // true 
    $result->allowLogprobs; // true 
    $result->allowSearchIndices; // false 
    $result->allowView; // true 
    $result->allowFineTuning; // false 
    $result->organization; // '*' 
    $result->group; // null 
    $result->isBlocking; // false 
}

$response->toArray(); // ['id' => 'text-davinci-003', ...]
```

#### `delete`

Delete a fine-tuned model.

```php
$response = $client->models()->delete('curie:ft-acmeco-2021-03-03-21-44-20');

$response->id; // 'curie:ft-acmeco-2021-03-03-21-44-20'
$response->object; // 'model'
$response->deleted; // true

$response->toArray(); // ['id' => 'curie:ft-acmeco-2021-03-03-21-44-20', ...]
```

### `Completions` Resource

#### `create`

Creates a completion for the provided prompt and parameters.

```php
$response = $client->completions()->create([
    'model' => 'text-davinci-003',
    'prompt' => 'Say this is a test',
    'max_tokens' => 6,
    'temperature' => 0
]);

$response->id; // 'cmpl-uqkvlQyYK7bGYrRHQ0eXlWi7'
$response->object; // 'text_completion'
$response->created; // 1589478378
$response->model; // 'text-davinci-003'

foreach ($response->choices as $result) {
    $result->text; // '\n\nThis is a test'
    $result->index; // 0
    $result->logprobs; // null
    $result->finishReason; // 'length' or null
}

$response->usage->promptTokens; // 5,
$response->usage->completionTokens; // 6,
$response->usage->totalTokens; // 11

$response->toArray(); // ['id' => 'cmpl-uqkvlQyYK7bGYrRHQ0eXlWi7', ...]
```

#### `create streamed`

Creates a streamed completion for the provided prompt and parameters.

```php
$stream = $client->completions()->createStreamed([
        'model' => 'text-davinci-003',
        'prompt' => 'Hi',
        'max_tokens' => 10,
    ]);

foreach($stream as $response){
    $response->choices[0]->text;
}
// 1. iteration => 'I'
// 2. iteration => ' am'
// 3. iteration => ' very'
// 4. iteration => ' excited'
// ...
```

### `Chat` Resource

#### `create`

Creates a completion for the chat message.

```php
$response = $client->chat()->create([
    'model' => 'gpt-3.5-turbo',
    'messages' => [
        ['role' => 'user', 'content' => 'Hello!'],
    ],
]);

$response->id; // 'chatcmpl-6pMyfj1HF4QXnfvjtfzvufZSQq6Eq'
$response->object; // 'chat.completion'
$response->created; // 1677701073
$response->model; // 'gpt-3.5-turbo-0301'

foreach ($response->choices as $result) {
    $result->index; // 0
    $result->message->role; // 'assistant'
    $result->message->content; // '\n\nHello there! How can I assist you today?'
    $result->finishReason; // 'stop'
}

$response->usage->promptTokens; // 9,
$response->usage->completionTokens; // 12,
$response->usage->totalTokens; // 21

$response->toArray(); // ['id' => 'chatcmpl-6pMyfj1HF4QXnfvjtfzvufZSQq6Eq', ...]
```

Creates a completion for the chat message with a function call.

```php
$response = $client->chat()->create([
    'model' => 'gpt-3.5-turbo-0613',
    'messages' => [
        ['role' => 'user', 'content' => 'What\'s the weather like in Boston?'],
    ],
    'functions' => [
        [
            'name' => 'get_current_weather',
            'description' => 'Get the current weather in a given location',
            'parameters' => [
                'type' => 'object',
                'properties' => [
                    'location' => [
                        'type' => 'string',
                        'description' => 'The city and state, e.g. San Francisco, CA',
                    ],
                    'unit' => [
                        'type' => 'string',
                        'enum' => ['celsius', 'fahrenheit']
                    ],
                ],
                'required' => ['location'],
            ],
        ]
    ]
]);

$response->id; // 'chatcmpl-6pMyfj1HF4QXnfvjtfzvufZSQq6Eq'
$response->object; // 'chat.completion'
$response->created; // 1677701073
$response->model; // 'gpt-3.5-turbo-0613'

foreach ($response->choices as $result) {
    $result->index; // 0
    $result->message->role; // 'assistant'
    $result->message->content; // null
    $result->message->functionCall->name; // 'get_current_weather'
    $result->message->functionCall->arguments; // "{\n  \"location\": \"Boston, MA\"\n}"
    $result->finishReason; // 'function_call'
}

$response->usage->promptTokens; // 82,
$response->usage->completionTokens; // 18,
$response->usage->totalTokens; // 100
```

#### `created streamed`

Creates a streamed completion for the chat message.

```php
$stream = $client->chat()->createStreamed([
    'model' => 'gpt-4',
    'messages' => [
        ['role' => 'user', 'content' => 'Hello!'],
    ],
]);

foreach($stream as $response){
    $response->choices[0]->toArray();
}
// 1. iteration => ['index' => 0, 'delta' => ['role' => 'assistant'], 'finish_reason' => null]
// 2. iteration => ['index' => 0, 'delta' => ['content' => 'Hello'], 'finish_reason' => null]
// 3. iteration => ['index' => 0, 'delta' => ['content' => '!'], 'finish_reason' => null]
// ...
```

### `Audio` Resource

#### `transcribe`

Transcribes audio into the input language.

```php
$response = $client->audio()->transcribe([
    'model' => 'whisper-1',
    'file' => fopen('audio.mp3', 'r'),
    'response_format' => 'verbose_json',
]);

$response->task; // 'transcribe'
$response->language; // 'english'
$response->duration; // 2.95
$response->text; // 'Hello, how are you?'

foreach ($response->segments as $segment) {
    $segment->index; // 0
    $segment->seek; // 0
    $segment->start; // 0.0
    $segment->end; // 4.0
    $segment->text; // 'Hello, how are you?'
    $segment->tokens; // [50364, 2425, 11, 577, 366, 291, 30, 50564]
    $segment->temperature; // 0.0
    $segment->avgLogprob; // -0.45045216878255206
    $segment->compressionRatio; // 0.7037037037037037
    $segment->noSpeechProb; // 0.1076972484588623
    $segment->transient; // false
}

$response->toArray(); // ['task' => 'transcribe', ...]
```

#### `translate`

Translates audio into English.

```php
$response = $client->audio()->translate([
    'model' => 'whisper-1',
    'file' => fopen('german.mp3', 'r'),
    'response_format' => 'verbose_json',
]);

$response->task; // 'translate'
$response->language; // 'english'
$response->duration; // 2.95
$response->text; // 'Hello, how are you?'

foreach ($response->segments as $segment) {
    $segment->index; // 0
    $segment->seek; // 0
    $segment->start; // 0.0
    $segment->end; // 4.0
    $segment->text; // 'Hello, how are you?'
    $segment->tokens; // [50364, 2425, 11, 577, 366, 291, 30, 50564]
    $segment->temperature; // 0.0
    $segment->avgLogprob; // -0.45045216878255206
    $segment->compressionRatio; // 0.7037037037037037
    $segment->noSpeechProb; // 0.1076972484588623
    $segment->transient; // false
}

$response->toArray(); // ['task' => 'translate', ...]
```

### `Edits` Resource

#### `create`

Creates a new edit for the provided input, instruction, and parameters.

```php
$response = $client->edits()->create([
    'model' => 'text-davinci-edit-001',
    'input' => 'What day of the wek is it?',
    'instruction' => 'Fix the spelling mistakes',
]);

$response->object; // 'edit'
$response->created; // 1589478378

foreach ($response->choices as $result) {
    $result->text; // 'What day of the week is it?'
    $result->index; // 0
}

$response->usage->promptTokens; // 25,
$response->usage->completionTokens; // 32,
$response->usage->totalTokens; // 57

$response->toArray(); // ['object' => 'edit', ...]
```

### `Embeddings` Resource

#### `create`

Creates an embedding vector representing the input text.

```php
$response = $client->embeddings()->create([
    'model' => 'text-similarity-babbage-001',
    'input' => 'The food was delicious and the waiter...',
]);

$response->object; // 'list'

foreach ($response->embeddings as $embedding) {
    $embedding->object; // 'embedding'
    $embedding->embedding; // [0.018990106880664825, -0.0073809814639389515, ...]
    $embedding->index; // 0
}

$response->usage->promptTokens; // 8,
$response->usage->totalTokens; // 8

$response->toArray(); // ['data' => [...], ...]
```

### `Files` Resource

#### `list`

Returns a list of files that belong to the user's organization.

```php
$response = $client->files()->list();

$response->object; // 'list'

foreach ($response->data as $result) {
    $result->id; // 'file-XjGxS3KTG0uNmNOK362iJua3'
    $result->object; // 'file'
    // ...
}

$response->toArray(); // ['object' => 'list', 'data' => [...]]
```

#### `delete`

Delete a file.

```php
$response = $client->files()->delete($file);

$response->id; // 'file-XjGxS3KTG0uNmNOK362iJua3'
$response->object; // 'file'
$response->deleted; // true

$response->toArray(); // ['id' => 'file-XjGxS3KTG0uNmNOK362iJua3', ...]
```

#### `retrieve`

Returns information about a specific file.

```php
$response = $client->files()->retrieve('file-XjGxS3KTG0uNmNOK362iJua3');

$response->id; // 'file-XjGxS3KTG0uNmNOK362iJua3'
$response->object; // 'file'
$response->bytes; // 140
$response->createdAt; // 1613779657
$response->filename; // 'mydata.jsonl'
$response->purpose; // 'fine-tune'
$response->status; // 'succeeded'
$response->status_details; // null

$response->toArray(); // ['id' => 'file-XjGxS3KTG0uNmNOK362iJua3', ...]
```

#### `upload`

Upload a file that contains document(s) to be used across various endpoints/features.

```php
$response = $client->files()->upload([
        'purpose' => 'fine-tune',
        'file' => fopen('my-file.jsonl', 'r'),
    ]);

$response->id; // 'file-XjGxS3KTG0uNmNOK362iJua3'
$response->object; // 'file'
$response->bytes; // 140
$response->createdAt; // 1613779657
$response->filename; // 'mydata.jsonl'
$response->purpose; // 'fine-tune'
$response->status; // 'succeeded'
$response->status_details; // null

$response->toArray(); // ['id' => 'file-XjGxS3KTG0uNmNOK362iJua3', ...]
```

#### `download`

Returns the contents of the specified file.

```php
$client->files()->download($file); // '{"prompt": "<prompt text>", ...'
```

### `FineTunes` Resource

#### `create`

Creates a job that fine-tunes a specified model from a given dataset.

```php
$response = $client->fineTunes()->create([
    'training_file' => 'file-ajSREls59WBbvgSzJSVWxMCB',
    'validation_file' => 'file-XjSREls59WBbvgSzJSVWxMCa',
    'model' => 'curie',
    'n_epochs' => 4,
    'batch_size' => null,
    'learning_rate_multiplier' => null,
    'prompt_loss_weight' => 0.01,
    'compute_classification_metrics' => false,
    'classification_n_classes' => null,
    'classification_positive_class' => null,
    'classification_betas' => [],
    'suffix' => null,
]);

$response->id; // 'ft-AF1WoRqd3aJAHsqc9NY7iL8F'
$response->object; // 'fine-tune'
// ...

$response->toArray(); // ['id' => 'ft-AF1WoRqd3aJAHsqc9NY7iL8F', ...]
```

#### `list`

List your organization's fine-tuning jobs.

```php
$response = $client->fineTunes()->list();

$response->object; // 'list'

foreach ($response->data as $result) {
    $result->id; // 'ft-AF1WoRqd3aJAHsqc9NY7iL8F'
    $result->object; // 'fine-tune'
    // ...
}

$response->toArray(); // ['object' => 'list', 'data' => [...]]
```

#### `retrieve`

Gets info about the fine-tune job.

```php
$response = $client->fineTunes()->retrieve('ft-AF1WoRqd3aJAHsqc9NY7iL8F');

$response->id; // 'ft-AF1WoRqd3aJAHsqc9NY7iL8F'
$response->object; // 'fine-tune'
$response->model; // 'curie'
$response->createdAt; // 1614807352
$response->fineTunedModel; // 'curie => ft-acmeco-2021-03-03-21-44-20'
$response->organizationId; // 'org-jwe45798ASN82s'
$response->resultFiles; // [
$response->status; // 'succeeded'
$response->validationFiles; // [
$response->trainingFiles; // [
$response->updatedAt; // 1614807865

foreach ($response->events as $result) {
    $result->object; // 'fine-tune-event' 
    $result->createdAt; // 1614807352
    $result->level; // 'info'
    $result->message; // 'Job enqueued. Waiting for jobs ahead to complete. Queue number =>  0.'
}

$response->hyperparams->batchSize; // 4 
$response->hyperparams->learningRateMultiplier; // 0.1 
$response->hyperparams->nEpochs; // 4 
$response->hyperparams->promptLossWeight; // 0.1

foreach ($response->resultFiles as $result) {
    $result->id; // 'file-XjGxS3KTG0uNmNOK362iJua3'
    $result->object; // 'file'
    $result->bytes; // 140
    $result->createdAt; // 1613779657
    $result->filename; // 'mydata.jsonl'
    $result->purpose; // 'fine-tune'
    $result->status; // 'succeeded'
    $result->status_details; // null
}

foreach ($response->validationFiles as $result) {
    $result->id; // 'file-XjGxS3KTG0uNmNOK362iJua3'
    // ...
}

foreach ($response->trainingFiles as $result) {
    $result->id; // 'file-XjGxS3KTG0uNmNOK362iJua3'
    // ...
}

$response->toArray(); // ['id' => 'ft-AF1WoRqd3aJAHsqc9NY7iL8F', ...]
```

#### `cancel`

Immediately cancel a fine-tune job.

```php
$response = $client->fineTunes()->cancel('ft-AF1WoRqd3aJAHsqc9NY7iL8F');

$response->id; // 'ft-AF1WoRqd3aJAHsqc9NY7iL8F'
$response->object; // 'fine-tune'
// ...
$response->status; // 'cancelled'
// ...

$response->toArray(); // ['id' => 'ft-AF1WoRqd3aJAHsqc9NY7iL8F', ...]
```

#### `list events`

Get fine-grained status updates for a fine-tune job.

```php
$response = $client->fineTunes()->listEvents('ft-AF1WoRqd3aJAHsqc9NY7iL8F');

$response->object; // 'list'

foreach ($response->data as $result) {
    $result->object; // 'fine-tune-event' 
    $result->createdAt; // 1614807352
    // ...
}

$response->toArray(); // ['object' => 'list', 'data' => [...]]
```

#### `list events streamed`

Get streamed fine-grained status updates for a fine-tune job.

```php
$stream = $client->fineTunes()->listEventsStreamed('ft-y3OpNlc8B5qBVGCCVsLZsDST');

foreach($stream as $response){
    $response->message;
}
// 1. iteration => 'Created fine-tune: ft-y3OpNlc8B5qBVGCCVsLZsDST'
// 2. iteration => 'Fine-tune costs $0.00'
// ...
// xx. iteration => 'Uploaded result file: file-ajLKUCMsFPrT633zqwr0eI4l'
// xx. iteration => 'Fine-tune succeeded'
```

### `Moderations` Resource

#### `create`

Classifies if text violates OpenAI's Content Policy.

```php

$response = $client->moderations()->create([
    'model' => 'text-moderation-latest',
    'input' => 'I want to k*** them.',
]);

$response->id; // modr-5xOyuS
$response->model; // text-moderation-003

foreach ($response->results as $result) {
    $result->flagged; // true

    foreach ($result->categories as $category) {
        $category->category->value; // 'violence'
        $category->violated; // true
        $category->score; // 0.97431367635727
    }
}

$response->toArray(); // ['id' => 'modr-5xOyuS', ...]
```

### `Images` Resource

#### `create`

Creates an image given a prompt.

```php
$response = $client->images()->create([
    'prompt' => 'A cute baby sea otter',
    'n' => 1,
    'size' => '256x256',
    'response_format' => 'url',
]);

$response->created; // 1589478378

foreach ($response->data as $data) {
    $data->url; // 'https://oaidalleapiprodscus.blob.core.windows.net/private/...'
    $data->b64_json; // null
}

$response->toArray(); // ['created' => 1589478378, data => ['url' => 'https://oaidalleapiprodscus...', ...]]
```

#### `edit`

Creates an edited or extended image given an original image and a prompt.

```php
$response = $client->images()->edit([
    'image' => fopen('image_edit_original.png', 'r'),
    'mask' => fopen('image_edit_mask.png', 'r'),
    'prompt' => 'A sunlit indoor lounge area with a pool containing a flamingo',
    'n' => 1,
    'size' => '256x256',
    'response_format' => 'url',
]);

$response->created; // 1589478378

foreach ($response->data as $data) {
    $data->url; // 'https://oaidalleapiprodscus.blob.core.windows.net/private/...'
    $data->b64_json; // null
}

$response->toArray(); // ['created' => 1589478378, data => ['url' => 'https://oaidalleapiprodscus...', ...]]
```

#### `variation`

Creates a variation of a given image.

```php
$response = $client->images()->variation([
    'image' => fopen('image_edit_original.png', 'r'),
    'n' => 1,
    'size' => '256x256',
    'response_format' => 'url',
]);

$response->created; // 1589478378

foreach ($response->data as $data) {
    $data->url; // 'https://oaidalleapiprodscus.blob.core.windows.net/private/...'
    $data->b64_json; // null
}

$response->toArray(); // ['created' => 1589478378, data => ['url' => 'https://oaidalleapiprodscus...', ...]]
```

## Testing

The package provides a fake implementation of the `OpenAI\Client` class that allows you to fake the API responses.

To test your code ensure you swap the `OpenAI\Client` class with the `OpenAI\Testing\ClientFake` class in your test case.

The fake responses are returned in the order they are provided while creating the fake client.

All responses are having a `fake()` method that allows you to easily create a response object by only providing the parameters relevant for your test case.

```php
use OpenAI\Testing\ClientFake;
use OpenAI\Responses\Completions\CreateResponse;

$client = new ClientFake([
    CreateResponse::fake([
        'choices' => [
            [
                'text' => 'awesome!',
            ],
        ],
    ]),
]);

$completion = $client->completions()->create([
    'model' => 'text-davinci-003',
    'prompt' => 'PHP is ',
]);

expect($completion['choices'][0]['text'])->toBe('awesome!');
```

In case of a streamed response you can optionally provide a resource holding the fake response data.

```php
use OpenAI\Testing\ClientFake;
use OpenAI\Responses\Chat\CreateStreamedResponse;

$client = new ClientFake([
    CreateStreamedResponse::fake(fopen('file.txt', 'r'););
]);

$completion = $client->chat()->createStreamed([
        'model' => 'gpt-3.5-turbo',
        'messages' => [
            ['role' => 'user', 'content' => 'Hello!'],
        ],
]);

expect($response->getIterator()->current())
        ->id->toBe('chatcmpl-6yo21W6LVo8Tw2yBf7aGf2g17IeIl');
```

After the requests have been sent there are various methods to ensure that the expected requests were sent:

```php
// assert completion create request was sent
$client->assertSent(Completions::class, function (string $method, array $parameters): bool {
    return $method === 'create' &&
        $parameters['model'] === 'text-davinci-003' &&
        $parameters['prompt'] === 'PHP is ';
});
// or
$client->completions()->assertSent(function (string $method, array $parameters): bool {
    // ...
});

// assert 2 completion create requests were sent
$client->assertSent(Completions::class, 2);

// assert no completion create requests were sent
$client->assertNotSent(Completions::class);
// or
$client->completions()->assertNotSent();

// assert no requests were sent
$client->assertNothingSent();
```

To write tests expecting the API request to fail you can provide a `Throwable` object as the response.

```php
$client = new ClientFake([
    new \OpenAI\Exceptions\ErrorException([
        'message' => 'The model `gpt-1` does not exist',
        'type' => 'invalid_request_error',
        'code' => null,
    ])
]);

// the `ErrorException` will be thrown
$completion = $client->completions()->create([
    'model' => 'text-davinci-003',
    'prompt' => 'PHP is ',
]);
```

## Services

### Azure

In order to use the Azure OpenAI Service, it is necessary to construct the client manually using the factory.

```php
$client = OpenAI::factory()
    ->withBaseUri('{your-resource-name}.openai.azure.com/openai/deployments/{deployment-id}')
    ->withHttpHeader('api-key', '{your-api-key}')
    ->withQueryParam('api-version', '{version}')
    ->make();
```

To use Azure, you must deploy a model, identified by the {deployment-id}, which is already incorporated into the API calls. As a result, you do not have to provide the model during the calls since it is included in the `BaseUri`.

Therefore, a basic sample completion call would be:

```php
$result = $client->completions()->create([
    'prompt' => 'PHP is'
]);
``` 

---

OpenAI PHP is an open-sourced software licensed under the **[MIT license](https://opensource.org/licenses/MIT)**.
