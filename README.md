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
**OpenAI PHP** is a community-maintained PHP API client that allows you to interact with the [Open AI API](https://beta.openai.com/docs/api-reference/introduction). If you or your business relies on this package, it's important to support the developers who have contributed their time and effort to create and maintain this valuable tool:

- Nuno Maduro: **[github.com/sponsors/nunomaduro](https://github.com/sponsors/nunomaduro)**
- Sandro Gehri: **[github.com/sponsors/gehrisandro](https://github.com/sponsors/gehrisandro)**

## Get Started

> **Requires [PHP 8.1+](https://php.net/releases/)**

First, install OpenAI via the [Composer](https://getcomposer.org/) package manager:

```bash
composer require openai-php/client
```

If your project does not already include a PSR-18 client make sure the `php-http/discovery` composer plugin is allowed to run or install a client manually:
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

If required you can configure and create an individual Client:

```php
$yourApiKey = getenv('YOUR_API_KEY');

$client = OpenAI::factory()
    ->withApiKey($yourApiKey)
    ->withOrganization('your-organization') // default: null
    ->withBaseUrl('openai.example.com/v1') // default: api.openai.com/v1
    ->withHttpClient(new \GuzzleHttp\Client([])) // default: HTTP client found using PSR-18 HTTP Client Discovery
    ->withHttpHeader('X-My-Header', 'foo')
    ->withQueryParam('my-param', 'bar')
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

---

OpenAI PHP is an open-sourced software licensed under the **[MIT license](https://opensource.org/licenses/MIT)**.
