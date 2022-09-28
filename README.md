<p align="center">
    <img src="https://raw.githubusercontent.com/openai-php/client/main/art/example.png" width="600" alt="OpenAI PHP">
    <p align="center">
        <a href="https://github.com/openai-php/client/actions"><img alt="GitHub Workflow Status (master)" src="https://img.shields.io/github/workflow/status/openai-php/client/Tests/main"></a>
        <a href="https://packagist.org/packages/openai-php/client"><img alt="Total Downloads" src="https://img.shields.io/packagist/dt/openai-php/client"></a>
        <a href="https://packagist.org/packages/openai-php/client"><img alt="Latest Version" src="https://img.shields.io/packagist/v/openai-php/client"></a>
        <a href="https://packagist.org/packages/openai-php/client"><img alt="License" src="https://img.shields.io/github/license/openai-php/client"></a>
    </p>
</p>

------
**OpenAI PHP** is a supercharged PHP API client that allows you to interact with the [Open AI API](https://beta.openai.com/docs/api-reference/introduction).

> This project is a work-in-progress. Code and documentation are currently under development and are subject to change.

## Get Started

> **Requires [PHP 8.1+](https://php.net/releases/)**

First, install OpenAI via the [Composer](https://getcomposer.org/) package manager:

```bash
composer require openai-php/client dev-main
```

Then, interact with OpenAI's API:

```php
$client = OpenAI::client('YOUR_API_KEY');

$result = $client->completions()->create([
    'model' => 'davinci',
    'prompt' => 'PHP is',
]);

echo $result['choices'][0]['text']; // an open-source, widely-used, server-side scripting language.
```

## TODO



- [x] Models
- [x] Completions
- [x] Edits
- [x] Embeddings
- [x] Files
- [ ] FineTunes
- [ ] Moderations
- [ ] Classifications

## Usage

### `Models` Resource

#### `list`

Lists the currently available models, and provides basic information about each one such as the owner and availability.

```php
$client->models()->list(); // ['data' => [...], ...]
```

#### `retrieve`

Retrieves a model instance, providing basic information about the model such as the owner and permissioning.

```php
$client->models()->retrieve($model); // ['id' => 'text-davinci-002', ...]
```

### `Completions` Resource

#### `create`

Creates a completion for the provided prompt and parameters.

```php
$client->completions()->create($parameters); // ['choices' => [...], ...]
```

### `Edits` Resource

#### `create`

Creates a new edit for the provided input, instruction, and parameters.

```php
$client->edits()->create(); // ['choices' => [...], ...]
```

### `Embeddings` Resource

#### `create`

Creates an embedding vector representing the input text.

```php
$client->embeddings()->create(); // ['data' => [...], ...]
```

### `Files` Resource

#### `list`

Returns a list of files that belong to the user's organization.

```php
$client->files()->list(); // ['data' => [...], ...]
```

#### `delete`

Delete a file.

```php
$client->files()->delete($file); // ['id' => 'file-XjGxS3KTG0uNmNOK362iJua3', ...]
```

#### `retrieve`

Returns information about a specific file.

```php
$client->files()->retrieve($file); // ['id' => 'file-XjGxS3KTG0uNmNOK362iJua3', ...]
```

#### `upload`

Upload a file that contains document(s) to be used across various endpoints/features.

```php
$client->files()->upload([
        'purpose' => 'fine-tune',
        'file' => fopen('my-file.jsonl', 'r'),
    ]); // ['id' => 'file-XjGxS3KTG0uNmNOK362iJua3', ...]
```

#### `download`

Returns the contents of the specified file.

```php
$client->files()->download($file); // '{"prompt": "<prompt text>", ...'
```

---

OpenAI PHP is an open-sourced software licensed under the **[MIT license](https://opensource.org/licenses/MIT)**.
