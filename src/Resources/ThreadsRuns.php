<?php

declare(strict_types=1);

namespace OpenAI\Resources;

use OpenAI\Contracts\Resources\ThreadsRunsContract;
use OpenAI\Contracts\Resources\ThreadsRunsStepsContract;
use OpenAI\Events\RequestHandled;
use OpenAI\Responses\Threads\Runs\ThreadRunListResponse;
use OpenAI\Responses\Threads\Runs\ThreadRunResponse;
use OpenAI\ValueObjects\Transporter\Payload;
use OpenAI\ValueObjects\Transporter\Response;

final class ThreadsRuns implements ThreadsRunsContract
{
    use Concerns\Dispatchable;
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

        /** @var Response<array{id: string, object: string, created_at: int, thread_id: string, assistant_id: string, status: string, required_action?: array{type: string, submit_tool_outputs: array{tool_calls: array<int, array{id: string, type: string, function: array{name: string, arguments: string}}>}}, last_error: ?array{code: string, message: string}, expires_at: ?int, started_at: ?int, cancelled_at: ?int, failed_at: ?int, completed_at: ?int, model: string, instructions: ?string, tools: array<int, array{type: 'code_interpreter'}|array{type: 'retrieval'}|array{type: 'function', function: array{description: string, name: string, parameters: array<string, mixed>}}>, file_ids: array<int, string>, metadata: array<string, string>}> $responseRaw */
        $responseRaw = $this->transporter->requestObject($payload);

        $response = ThreadRunResponse::from($responseRaw->data(), $responseRaw->meta());

        $this->event(new RequestHandled($payload, $response));

        return $response;
    }

    /**
     * Retrieves a run.
     *
     * @see https://platform.openai.com/docs/api-reference/runs/getRun
     */
    public function retrieve(string $threadId, string $runId): ThreadRunResponse
    {
        $payload = Payload::retrieve('threads/'.$threadId.'/runs', $runId);

        /** @var Response<array{id: string, object: string, created_at: int, thread_id: string, assistant_id: string, status: string, required_action?: array{type: string, submit_tool_outputs: array{tool_calls: array<int, array{id: string, type: string, function: array{name: string, arguments: string}}>}}, last_error: ?array{code: string, message: string}, expires_at: ?int, started_at: ?int, cancelled_at: ?int, failed_at: ?int, completed_at: ?int, model: string, instructions: ?string, tools: array<int, array{type: 'code_interpreter'}|array{type: 'retrieval'}|array{type: 'function', function: array{description: string, name: string, parameters: array<string, mixed>}}>, file_ids: array<int, string>, metadata: array<string, string>}> $responseRaw */
        $responseRaw = $this->transporter->requestObject($payload);

        $response = ThreadRunResponse::from($responseRaw->data(), $responseRaw->meta());

        $this->event(new RequestHandled($payload, $response));

        return $response;
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

        /** @var Response<array{id: string, object: string, created_at: int, thread_id: string, assistant_id: string, status: string, required_action?: array{type: string, submit_tool_outputs: array{tool_calls: array<int, array{id: string, type: string, function: array{name: string, arguments: string}}>}}, last_error: ?array{code: string, message: string}, expires_at: ?int, started_at: ?int, cancelled_at: ?int, failed_at: ?int, completed_at: ?int, model: string, instructions: ?string, tools: array<int, array{type: 'code_interpreter'}|array{type: 'retrieval'}|array{type: 'function', function: array{description: string, name: string, parameters: array<string, mixed>}}>, file_ids: array<int, string>, metadata: array<string, string>}> $responseRaw */
        $responseRaw = $this->transporter->requestObject($payload);

        $response = ThreadRunResponse::from($responseRaw->data(), $responseRaw->meta());

        $this->event(new RequestHandled($payload, $response));

        return $response;
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

        /** @var Response<array{id: string, object: string, created_at: int, thread_id: string, assistant_id: string, status: string, required_action?: array{type: string, submit_tool_outputs: array{tool_calls: array<int, array{id: string, type: string, function: array{name: string, arguments: string}}>}}, last_error: ?array{code: string, message: string}, expires_at: ?int, started_at: ?int, cancelled_at: ?int, failed_at: ?int, completed_at: ?int, model: string, instructions: ?string, tools: array<int, array{type: 'code_interpreter'}|array{type: 'retrieval'}|array{type: 'function', function: array{description: string, name: string, parameters: array<string, mixed>}}>, file_ids: array<int, string>, metadata: array<string, string>}> $responseRaw */
        $responseRaw = $this->transporter->requestObject($payload);

        $response = ThreadRunResponse::from($responseRaw->data(), $responseRaw->meta());

        $this->event(new RequestHandled($payload, $response));

        return $response;
    }

    /**
     * Cancels a run that is `in_progress`.
     *
     * @see https://platform.openai.com/docs/api-reference/runs/cancelRun
     */
    public function cancel(string $threadId, string $runId): ThreadRunResponse
    {
        $payload = Payload::cancel('threads/'.$threadId.'/runs', $runId);

        /** @var Response<array{id: string, object: string, created_at: int, thread_id: string, assistant_id: string, status: string, required_action?: array{type: string, submit_tool_outputs: array{tool_calls: array<int, array{id: string, type: string, function: array{name: string, arguments: string}}>}}, last_error: ?array{code: string, message: string}, expires_at: ?int, started_at: ?int, cancelled_at: ?int, failed_at: ?int, completed_at: ?int, model: string, instructions: ?string, tools: array<int, array{type: 'code_interpreter'}|array{type: 'retrieval'}|array{type: 'function', function: array{description: string, name: string, parameters: array<string, mixed>}}>, file_ids: array<int, string>, metadata: array<string, string>}> $responseRaw */
        $responseRaw = $this->transporter->requestObject($payload);

        $response = ThreadRunResponse::from($responseRaw->data(), $responseRaw->meta());

        $this->event(new RequestHandled($payload, $response));

        return $response;
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

        /** @var Response<array{object: string, data: array<int, array{id: string, object: string, created_at: int, thread_id: string, assistant_id: string, status: string, required_action?: array{type: string, submit_tool_outputs: array{tool_calls: array<int, array{id: string, type: string, function: array{name: string, arguments: string}}>}}, last_error: ?array{code: string, message: string}, expires_at: ?int, started_at: ?int, cancelled_at: ?int, failed_at: ?int, completed_at: ?int, model: string, instructions: ?string, tools: array<int, array{type: 'code_interpreter'}|array{type: 'retrieval'}|array{type: 'function', function: array{description: string, name: string, parameters: array<string, mixed>}}>, file_ids: array<int, string>, metadata: array<string, string>}>, first_id: ?string, last_id: ?string, has_more: bool}> $responseRaw */
        $responseRaw = $this->transporter->requestObject($payload);

        $response = ThreadRunListResponse::from($responseRaw->data(), $responseRaw->meta());

        $this->event(new RequestHandled($payload, $response));

        return $response;
    }

    /**
     * Get steps attached to a run.
     *
     * @see https://platform.openai.com/docs/api-reference/runs/step-object
     */
    public function steps(): ThreadsRunsStepsContract
    {
        return (new ThreadsRunsSteps($this->transporter))
            ->setEventDispatcher($this->events);
    }
}
