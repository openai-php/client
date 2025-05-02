<?php

use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Psr7\Stream;
use OpenAI\Responses\Chat\CreateResponse;
use OpenAI\Responses\Chat\CreateResponseChoice;
use OpenAI\Responses\Chat\CreateResponseUsage;
use OpenAI\Responses\Chat\CreateStreamedResponse;
use OpenAI\Responses\Chat\CreateStreamedResponseChoice;
use OpenAI\Responses\Meta\MetaInformation;
use OpenAI\Responses\StreamResponse;

test('create', function () {
    $client = mockClient('POST', 'chat/completions', [
        'model' => 'gpt-3.5-turbo',
        'messages' => ['role' => 'user', 'content' => 'Hello!'],
    ], \OpenAI\ValueObjects\Transporter\Response::from(chatCompletion(), metaHeaders()));

    $result = $client->chat()->create([
        'model' => 'gpt-3.5-turbo',
        'messages' => ['role' => 'user', 'content' => 'Hello!'],
    ]);

    expect($result)
        ->toBeInstanceOf(CreateResponse::class)
        ->id->toBe('chatcmpl-123')
        ->object->toBe('chat.completion')
        ->created->toBe(1677652288)
        ->model->toBe('gpt-3.5-turbo')
        ->choices->toBeArray()->toHaveCount(1)
        ->choices->each->toBeInstanceOf(CreateResponseChoice::class)
        ->usage->toBeInstanceOf(CreateResponseUsage::class);

    expect($result->choices[0])
        ->message->role->toBe('assistant')
        ->message->content->toBe("\n\nHello there, how may I assist you today?")
        ->index->toBe(0)
        ->logprobs->toBe(null)
        ->finishReason->toBe('stop');

    expect($result->usage)
        ->promptTokens->toBe(9)
        ->completionTokens->toBe(12)
        ->totalTokens->toBe(21);

    expect($result->meta())
        ->toBeInstanceOf(MetaInformation::class);
});

test('create perplexity', function () {
    $client = mockClient('POST', 'chat/completions', [
      "model" => "sonar",
      "messages" => [["role" => "user","content" => "Does technical SEO boost website performance? What do case studies and experts say?"]],
], \OpenAI\ValueObjects\Transporter\Response::from(chatCompletionWithCitations(), metaHeaders()));

    $result = $client->chat()->create([
        "model" => "sonar",
        "messages" => [["role" => "user","content" => "Does technical SEO boost website performance? What do case studies and experts say?"]],
    ]);

    expect($result)
        ->toBeInstanceOf(CreateResponse::class)
        ->id->toBe('80a3200c-98d0-4d29-97d0-4766130d7e4d')
        ->object->toBe('chat.completion')
        ->created->toBe(1746182677)
        ->model->toBe('sonar')
        ->choices->toBeArray()->toHaveCount(1)
        ->choices->each->toBeInstanceOf(CreateResponseChoice::class)
        ->usage->toBeInstanceOf(CreateResponseUsage::class);

    expect($result->choices[0])
        ->message->role->toBe('assistant')
        ->message->content->toBe("Technical SEO plays a crucial role in boosting website performance by enhancing various aspects that contribute to better search engine rankings and user experience. Here's how technical SEO impacts website performance, based on expert insights and case studies:\n\n## Key Benefits of Technical SEO\n\n1. **Website Speed**: Technical SEO improves site speed, which is a critical factor for both user experience and search engine rankings. Faster websites retain visitors, reduce bounce rates, and improve the chances of higher rankings in search results[2][5]. Techniques like compressing images, using Content Delivery Networks (CDNs), and minifying code can enhance speed[5].\n\n2. **Mobile Compatibility**: Ensuring that a website is mobile-friendly is vital, as Google prioritizes mobile-first indexing. Technical SEO helps websites adapt to mobile screens, providing a seamless experience across devices[1][5].\n\n3. **Crawlability and Indexing**: Technical SEO optimizes crawlability and indexing by guiding search engine bots through the site more efficiently. This involves creating XML sitemaps, using proper URL structures, and implementing canonical tags to ensure that content is indexed correctly, leading to better search engine visibility[3][5].\n\n4. **Security and Navigation**: Technical SEO also emphasizes website security and navigation. Ensuring that a site is secure (HTTPS) and easy to navigate improves user trust and engagement, which can positively influence search engine rankings[1][5].\n\n## Expert Views\n\nExperts generally agree that technical SEO is essential for maintaining high website performance. It not only ensures that search engines can crawl and index content effectively but also enhances the overall user experience, which is crucial for converting traffic into leads and customers[1][3]. \n\n## Case Studies\n\nWhile specific case studies are not provided in the search results, it is common for businesses to see significant improvements in organic traffic and user engagement when they implement comprehensive technical SEO strategies. Improvements in website speed, mobile compatibility, and crawlability typically lead to increased visibility in search results and better user retention rates.\n\nIn summary, technical SEO is indispensable for boosting website performance by optimizing for search engines and enhancing user experience, which are both critical factors in achieving higher search engine rankings and driving organic traffic.")
        ->index->toBe(0)
        ->logprobs->toBeNull()
        ->finishReason->toBeNull();

    expect($result->usage)
        ->promptTokens->toBe(15)
        ->completionTokens->toBe(438)
        ->totalTokens->toBe(453)
        ->searchContextSize
        ->toBe('low');

    expect($result->meta())
        ->toBeInstanceOf(MetaInformation::class);
});

test('create throws an exception if stream option is true', function () {
    OpenAI::client('foo')->chat()->create([
        'model' => 'gpt-3.5-turbo',
        'messages' => ['role' => 'user', 'content' => 'Hello!'],
        'stream' => true,
    ]);
})->throws(OpenAI\Exceptions\InvalidArgumentException::class, 'Stream option is not supported. Please use the createStreamed() method instead.');

test('create streamed', function () {
    $response = new Response(
        body: new Stream(chatCompletionStream()),
        headers: metaHeaders(),
    );

    $client = mockStreamClient('POST', 'chat/completions', [
        'model' => 'gpt-3.5-turbo',
        'messages' => ['role' => 'user', 'content' => 'Hello!'],
        'stream' => true,
    ], $response);

    $result = $client->chat()->createStreamed([
        'model' => 'gpt-3.5-turbo',
        'messages' => ['role' => 'user', 'content' => 'Hello!'],
    ]);

    expect($result)
        ->toBeInstanceOf(StreamResponse::class)
        ->toBeInstanceOf(IteratorAggregate::class);

    expect($result->getIterator())
        ->toBeInstanceOf(Iterator::class);

    expect($result->getIterator()->current())
        ->toBeInstanceOf(CreateStreamedResponse::class)
        ->id->toBe('chatcmpl-6wdIE4DsUtqf1srdMTsfkJp0VWZgz')
        ->object->toBe('chat.completion.chunk')
        ->created->toBe(1679432086)
        ->model->toBe('gpt-4-0314')
        ->choices->toBeArray()->toHaveCount(1)
        ->choices->each->toBeInstanceOf(CreateStreamedResponseChoice::class)
        ->usage->toBeNull();

    expect($result->getIterator()->current()->choices[0])
        ->delta->role->toBeNull()
        ->delta->content->toBe('Hello')
        ->index->toBe(0)
        ->logprobs->toBe(null)
        ->finishReason->toBeNull();

    expect($result->meta())
        ->toBeInstanceOf(MetaInformation::class);
});

test('handles ping messages in stream', function () {
    $response = new Response(
        body: new Stream(chatCompletionStreamPing()),
        headers: metaHeaders(),
    );

    $client = mockStreamClient('POST', 'chat/completions', [
        'model' => 'gpt-3.5-turbo',
        'messages' => ['role' => 'user', 'content' => 'Hello!'],
        'stream' => true,
    ], $response);

    $stream = $client->chat()->createStreamed([
        'model' => 'gpt-3.5-turbo',
        'messages' => ['role' => 'user', 'content' => 'Hello!'],
    ]);

    foreach ($stream as $response) {
        expect($response)
            ->toBeInstanceOf(CreateStreamedResponse::class);
    }
});

test('handles error messages in stream', function () {
    $response = new Response(
        body: new Stream(chatCompletionStreamError())
    );

    $client = mockStreamClient('POST', 'chat/completions', [
        'model' => 'gpt-3.5-turbo',
        'messages' => ['role' => 'user', 'content' => 'Hello!'],
        'stream' => true,
    ], $response);

    $result = $client->chat()->createStreamed([
        'model' => 'gpt-3.5-turbo',
        'messages' => ['role' => 'user', 'content' => 'Hello!'],
    ]);

    expect(fn () => $result->getIterator()->current())
        ->toThrow(function (OpenAI\Exceptions\ErrorException $e) {
            expect($e->getMessage())->toBe('The server had an error while processing your request. Sorry about that!')
                ->and($e->getErrorMessage())->toBe('The server had an error while processing your request. Sorry about that!')
                ->and($e->getErrorCode())->toBeNull()
                ->and($e->getErrorType())->toBe('server_error');
        });
});
