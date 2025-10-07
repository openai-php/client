<?php

declare(strict_types=1);

namespace OpenAI\Resources;

use OpenAI\Contracts\Resources\ThreadsRunsContract;
use OpenAI\Contracts\Resources\ThreadsRunsStepsContract;
use OpenAI\Responses\StreamResponse;
use OpenAI\Responses\Threads\Runs\ThreadRunListResponse;
use OpenAI\Responses\Threads\Runs\ThreadRunResponse;
use OpenAI\Responses\Threads\Runs\ThreadRunStreamResponse;
use OpenAI\ValueObjects\Transporter\Payload;
use OpenAI\ValueObjects\Transporter\Response;

final class ThreadsRuns implements ThreadsRunsContract
{
    use Concerns\Streamable;
    use Concerns\Transportable;

    /**
     * Create a run.
     *
     * @see https://platform.openai.com/docs/api-reference/runs/createRun
     *
     * @param  array<string, mixed>  $parameters
     */
    public function create(string $threadId, array $parameters): ThreadRunResponse
    {
        $payload = Payload::create('threads/'.$threadId.'/runs', $parameters);

        /** @var Response<array{id: string, object: string, created_at: int, thread_id: string, assistant_id: string, status: string, required_action?: array{type: string, submit_tool_outputs: array{tool_calls: array<int, array{id: string, type: string, function: array{name: string, arguments: string}}>}}, last_error: ?array{code: string, message: string}, expires_at: ?int, started_at: ?int, cancelled_at: ?int, failed_at: ?int, completed_at: ?int, model: string, instructions: ?string, tools: array<int, array{type: 'code_interpreter'}|array{type: 'file_search'}|array{type: 'function', function: array{description: string, name: string, parameters: array<string, mixed>}}>, metadata: array<string, string>, usage?: array{prompt_tokens: int, completion_tokens: int|null, total_tokens: int}, incomplete_details: ?array{reason: string}, temperature: float|int|null, top_p: null|float|int, max_prompt_tokens: ?int, max_completion_tokens: ?int, truncation_strategy: array{type: string, last_messages: ?int}, tool_choice: string|array{type: string, function?: array{name: string}}, response_format: string|array{type: 'text'|'json_object'}}> $response */
        $response = $this->transporter
            ->addHeader('OpenAI-Beta', 'assistants=v2')
            ->requestObject($payload);

        return ThreadRunResponse::from($response->data(), $response->meta());
    }

    /**
     * Creates a streamed run
     *
     * @see https://platform.openai.com/docs/api-reference/runs/createRun
     *
     * @param  array<string, mixed>  $parameters
     * @return StreamResponse<ThreadRunStreamResponse>
     */
    public function createStreamed(string $threadId, array $parameters): StreamResponse
    {
        $parameters = $this->setStreamParameter($parameters);

        $payload = Payload::create('threads/'.$threadId.'/runs', $parameters);

        $response = $this->transporter
            ->addHeader('OpenAI-Beta', 'assistants=v2')
            ->requestStream($payload);

        return new StreamResponse(ThreadRunStreamResponse::class, $response);
    }

    /**
     * Retrieves a run.
     *
     * @see https://platform.openai.com/docs/api-reference/runs/getRun
     */
    public function retrieve(string $threadId, string $runId): ThreadRunResponse
    {
        $payload = Payload::retrieve('threads/'.$threadId.'/runs', $runId);

        /** @var Response<array{id: string, object: string, created_at: int, thread_id: string, assistant_id: string, status: string, required_action?: array{type: string, submit_tool_outputs: array{tool_calls: array<int, array{id: string, type: string, function: array{name: string, arguments: string}}>}}, last_error: ?array{code: string, message: string}, expires_at: ?int, started_at: ?int, cancelled_at: ?int, failed_at: ?int, completed_at: ?int, model: string, instructions: ?string, tools: array<int, array{type: 'code_interpreter'}|array{type: 'file_search'}|array{type: 'function', function: array{description: string, name: string, parameters: array<string, mixed>}}>, metadata: array<string, string>, usage?: array{prompt_tokens: int, completion_tokens: int|null, total_tokens: int}, incomplete_details: ?array{reason: string}, temperature: float|int|null, top_p: null|float|int, max_prompt_tokens: ?int, max_completion_tokens: ?int, truncation_strategy: array{type: string, last_messages: ?int}, tool_choice: string|array{type: string, function?: array{name: string}}, response_format: string|array{type: 'text'|'json_object'}}> $response */
        $response = $this->transporter
            ->addHeader('OpenAI-Beta', 'assistants=v2')
            ->requestObject($payload);

        return ThreadRunResponse::from($response->data(), $response->meta());
    }

    /**
     * Modifies a run.
     *
     * @see https://platform.openai.com/docs/api-reference/runs/modifyRun
     *
     * @param  array<string, mixed>  $parameters
     */
    public function modify(string $threadId, string $runId, array $parameters): ThreadRunResponse
    {
        $payload = Payload::modify('threads/'.$threadId.'/runs', $runId, $parameters);

        /** @var Response<array{id: string, object: string, created_at: int, thread_id: string, assistant_id: string, status: string, required_action?: array{type: string, submit_tool_outputs: array{tool_calls: array<int, array{id: string, type: string, function: array{name: string, arguments: string}}>}}, last_error: ?array{code: string, message: string}, expires_at: ?int, started_at: ?int, cancelled_at: ?int, failed_at: ?int, completed_at: ?int, model: string, instructions: ?string, tools: array<int, array{type: 'code_interpreter'}|array{type: 'file_search'}|array{type: 'function', function: array{description: string, name: string, parameters: array<string, mixed>}}>, metadata: array<string, string>, usage?: array{prompt_tokens: int, completion_tokens: int|null, total_tokens: int}, incomplete_details: ?array{reason: string}, temperature: float|int|null, top_p: null|float|int, max_prompt_tokens: ?int, max_completion_tokens: ?int, truncation_strategy: array{type: string, last_messages: ?int}, tool_choice: string|array{type: string, function?: array{name: string}}, response_format: string|array{type: 'text'|'json_object'}}> $response */
        $response = $this->transporter
            ->addHeader('OpenAI-Beta', 'assistants=v2')
            ->requestObject($payload);

        return ThreadRunResponse::from($response->data(), $response->meta());
    }

    /**
     * This endpoint can be used to submit the outputs from the tool calls once they're all completed.
     *
     * @see https://platform.openai.com/docs/api-reference/runs/submitToolOutputs
     *
     * @param  array<string, mixed>  $parameters
     */
    public function submitToolOutputs(string $threadId, string $runId, array $parameters): ThreadRunResponse
    {
        $payload = Payload::create('threads/'.$threadId.'/runs/'.$runId.'/submit_tool_outputs', $parameters);

        /** @var Response<array{id: string, object: string, created_at: int, thread_id: string, assistant_id: string, status: string, required_action?: array{type: string, submit_tool_outputs: array{tool_calls: array<int, array{id: string, type: string, function: array{name: string, arguments: string}}>}}, last_error: ?array{code: string, message: string}, expires_at: ?int, started_at: ?int, cancelled_at: ?int, failed_at: ?int, completed_at: ?int, model: string, instructions: ?string, tools: array<int, array{type: 'code_interpreter'}|array{type: 'file_search'}|array{type: 'function', function: array{description: string, name: string, parameters: array<string, mixed>}}>, metadata: array<string, string>, usage?: array{prompt_tokens: int, completion_tokens: int|null, total_tokens: int}, incomplete_details: ?array{reason: string}, temperature: float|int|null, top_p: null|float|int, max_prompt_tokens: ?int, max_completion_tokens: ?int, truncation_strategy: array{type: string, last_messages: ?int}, tool_choice: string|array{type: string, function?: array{name: string}}, response_format: string|array{type: 'text'|'json_object'}}> $response */
        $response = $this->transporter
            ->addHeader('OpenAI-Beta', 'assistants=v2')
            ->requestObject($payload);

        return ThreadRunResponse::from($response->data(), $response->meta());
    }

    /**
     * This endpoint can be used to submit the outputs from the tool calls once they're all completed.
     * And stream back the response
     *
     * @see https://platform.openai.com/docs/api-reference/runs/submitToolOutputs
     *
     * @param  array<string, mixed>  $parameters
     * @return StreamResponse<ThreadRunStreamResponse>
     */
    public function submitToolOutputsStreamed(string $threadId, string $runId, array $parameters): StreamResponse
    {
        $parameters = $this->setStreamParameter($parameters);

        $payload = Payload::create('threads/'.$threadId.'/runs/'.$runId.'/submit_tool_outputs', $parameters);

        $response = $this->transporter
            ->addHeader('OpenAI-Beta', 'assistants=v2')
            ->requestStream($payload);

        return new StreamResponse(ThreadRunStreamResponse::class, $response);
    }

    /**
     * Cancels a run that is `in_progress`.
     *
     * @see https://platform.openai.com/docs/api-reference/runs/cancelRun
     */
    public function cancel(string $threadId, string $runId): ThreadRunResponse
    {
        $payload = Payload::cancel('threads/'.$threadId.'/runs', $runId);

        /** @var Response<array{id: string, object: string, created_at: int, thread_id: string, assistant_id: string, status: string, required_action?: array{type: string, submit_tool_outputs: array{tool_calls: array<int, array{id: string, type: string, function: array{name: string, arguments: string}}>}}, last_error: ?array{code: string, message: string}, expires_at: ?int, started_at: ?int, cancelled_at: ?int, failed_at: ?int, completed_at: ?int, model: string, instructions: ?string, tools: array<int, array{type: 'code_interpreter'}|array{type: 'file_search'}|array{type: 'function', function: array{description: string, name: string, parameters: array<string, mixed>}}>, metadata: array<string, string>, usage?: array{prompt_tokens: int, completion_tokens: int|null, total_tokens: int}, incomplete_details: ?array{reason: string}, temperature: float|int|null, top_p: null|float|int, max_prompt_tokens: ?int, max_completion_tokens: ?int, truncation_strategy: array{type: string, last_messages: ?int}, tool_choice: string|array{type: string, function?: array{name: string}}, response_format: string|array{type: 'text'|'json_object'}}> $response */
        $response = $this->transporter
            ->addHeader('OpenAI-Beta', 'assistants=v2')
            ->requestObject($payload);

        return ThreadRunResponse::from($response->data(), $response->meta());
    }

    /**
     * Returns a list of runs belonging to a thread.
     *
     * @see https://platform.openai.com/docs/api-reference/runs/listRuns
     *
     * @param  array<string, mixed>  $parameters
     */
    public function list(string $threadId, array $parameters = []): ThreadRunListResponse
    {
        $payload = Payload::list('threads/'.$threadId.'/runs', $parameters);

        /** @var Response<array{object: string, data: array<int, array{id: string, object: string, created_at: int, thread_id: string, assistant_id: string, status: string, required_action?: array{type: string, submit_tool_outputs: array{tool_calls: array<int, array{id: string, type: string, function: array{name: string, arguments: string}}>}}, last_error: ?array{code: string, message: string}, expires_at: ?int, started_at: ?int, cancelled_at: ?int, failed_at: ?int, completed_at: ?int, model: string, instructions: ?string, tools: array<int, array{type: 'code_interpreter'}|array{type: 'file_search'}|array{type: 'function', function: array{description: string, name: string, parameters: array<string, mixed>}}>, metadata: array<string, string>, usage?: array{prompt_tokens: int, completion_tokens: int|null, total_tokens: int}, incomplete_details: ?array{reason: string}, temperature: float|int|null, top_p: null|float|int, max_prompt_tokens: ?int, max_completion_tokens: ?int, truncation_strategy: array{type: string, last_messages: ?int}, tool_choice: string|array{type: string, function?: array{name: string}}, response_format: string|array{type: 'text'|'json_object'}}>, first_id: ?string, last_id: ?string, has_more: bool}> $response */
        $response = $this->transporter
            ->addHeader('OpenAI-Beta', 'assistants=v2')
            ->requestObject($payload);

        return ThreadRunListResponse::from($response->data(), $response->meta());
    }

    /**
     * Get steps attached to a run.
     *
     * @see https://platform.openai.com/docs/api-reference/runs/step-object
     */
    public function steps(): ThreadsRunsStepsContract
    {
        return new ThreadsRunsSteps($this->transporter);
    }
}
