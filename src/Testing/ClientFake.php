<?php

namespace OpenAI\Testing;

use OpenAI\Contracts\Client;
use OpenAI\Contracts\Response;
use OpenAI\Resources\Contracts\AudioContract;
use OpenAI\Resources\Contracts\ChatContract;
use OpenAI\Resources\Contracts\CompletionsContract;
use OpenAI\Resources\Contracts\EditsContract;
use OpenAI\Resources\Contracts\EmbeddingsContract;
use OpenAI\Resources\Contracts\FilesContract;
use OpenAI\Resources\Contracts\FineTunesContract;
use OpenAI\Resources\Contracts\ImagesContract;
use OpenAI\Resources\Contracts\ModelsContract;
use OpenAI\Resources\Contracts\ModerationsContract;
use OpenAI\Testing\Requests\TestRequest;
use OpenAI\Testing\Resources\AudioTestResource;
use OpenAI\Testing\Resources\ChatTestResource;
use OpenAI\Testing\Resources\CompletionsTestResource;
use OpenAI\Testing\Resources\EditsTestResource;
use OpenAI\Testing\Resources\EmbeddingsTestResource;
use OpenAI\Testing\Resources\FilesTestResource;
use OpenAI\Testing\Resources\FineTunesTestResource;
use OpenAI\Testing\Resources\ImagesTestResource;
use OpenAI\Testing\Resources\ModelsTestResource;
use OpenAI\Testing\Resources\ModerationsTestResource;
use PHPUnit\Framework\Assert as PHPUnit;

/**
 * @noRector Rector\Privatization\Rector\Class_\FinalizeClassesWithoutChildrenRector
 */
class ClientFake implements Client
{
    /**
     * @var array<array-key, TestRequest>
     */
    private array $requests = [];

    /**
     * @param  array<array-key, Response|string>  $responses
     */
    public function __construct(protected array $responses = [])
    {
    }

    /**
     * @param  array<array-key, Response>  $responses
     */
    public function addResponses(array $responses): void
    {
        $this->responses = [...$this->responses, ...$responses];
    }

    /**
     * @param  callable|int|null  $callback
     */
    public function assertSent(string $resource, $callback = null): void
    {
        if (is_int($callback)) {
            $this->assertSentTimes($resource, $callback);

            return;
        }

        PHPUnit::assertTrue(
            $this->sent($resource, $callback) !== [],
            "The expected [{$resource}] request was not sent."
        );
    }

    protected function assertSentTimes(string $resource, int $times = 1): void
    {
        $count = count($this->sent($resource));

        PHPUnit::assertSame(
            $times, $count,
            "The expected [{$resource}] resource was sent {$count} times instead of {$times} times."
        );
    }

    /**
     * @return mixed[]
     */
    protected function sent(string $resource, callable $callback = null): array
    {
        if (! $this->hasSent($resource)) {
            return [];
        }

        $callback = $callback ?: fn (): bool => true;

        return array_filter($this->resourcesOf($resource), fn (TestRequest $resource) => $callback($resource->method(), $resource->parameters()));
    }

    protected function hasSent(string $resource): bool
    {
        return $this->resourcesOf($resource) !== [];
    }

    public function assertNotSent(string $resource, callable $callback = null): void
    {
        PHPUnit::assertCount(
            0, $this->sent($resource, $callback),
            "The unexpected [{$resource}] request was sent."
        );
    }

    public function assertNothingSent(): void
    {
        $resourceNames = implode(
            separator: ', ',
            array: array_map(fn (TestRequest $request): string => $request->resource(), $this->requests)
        );

        PHPUnit::assertEmpty($this->requests, 'The following requests were sent unexpectedly: '.$resourceNames);
    }

    /**
     * @return array<array-key, TestRequest>
     */
    protected function resourcesOf(string $type): array
    {
        return array_filter($this->requests, fn (TestRequest $request): bool => $request->resource() === $type);
    }

    public function record(TestRequest $request): Response|string
    {
        $this->requests[] = $request;

        $response = array_shift($this->responses);

        if (is_null($response)) {
            throw new \Exception('No fake responses left.');
        }

        return $response;
    }

    public function completions(): CompletionsContract
    {
        return new CompletionsTestResource($this);
    }

    public function chat(): ChatContract
    {
        return new ChatTestResource($this);
    }

    public function embeddings(): EmbeddingsContract
    {
        return new EmbeddingsTestResource($this);
    }

    public function audio(): AudioContract
    {
        return new AudioTestResource($this);
    }

    public function edits(): EditsContract
    {
        return new EditsTestResource($this);
    }

    public function files(): FilesContract
    {
        return new FilesTestResource($this);
    }

    public function models(): ModelsContract
    {
        return new ModelsTestResource($this);
    }

    public function fineTunes(): FineTunesContract
    {
        return new FineTunesTestResource($this);
    }

    public function moderations(): ModerationsContract
    {
        return new ModerationsTestResource($this);
    }

    public function images(): ImagesContract
    {
        return new ImagesTestResource($this);
    }
}
