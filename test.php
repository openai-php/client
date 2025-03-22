<?php

require __DIR__ . '/vendor/autoload.php';

// Load .env
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();


$yourApiKey = getenv('YOUR_API_KEY');

$client = OpenAI::factory()
    ->withApiKey($_ENV["GEMINI_API_KEY"])
    ->withOrganization('your-organization') // default: null
    ->withProject('Your Project') // default: null
    ->withBaseUri('https://generativelanguage.googleapis.com/v1beta/openai') // default: api.openai.com/v1
    ->make();

$result = $client->chat()->create([
    'model' => 'gemini-2.0-flash',
    'messages' => [
        ['role' => 'user', 'content' => 'Hello!, who are you'],
    ],
]);



echo $result->choices[0]->message->content;
