<?php

declare(strict_types=1);

namespace OpenAI\Resources;

use OpenAI\Contracts\Resources\ThreadsRunsStepsContract;
use OpenAI\Responses\Threads\Runs\Steps\ThreadRunStepListResponse;
use OpenAI\Responses\Threads\Runs\Steps\ThreadRunStepResponse;
use OpenAI\ValueObjects\Transporter\Payload;
use OpenAI\ValueObjects\Transporter\Response;

final class ThreadsRunsSteps implements ThreadsRunsStepsContract
{
    use Concerns\Transportable;

    /**
     * Retrieves a run step.
     *
     * @see https://platform.openai.com/docs/api-reference/runs/getRunStep
     */
    public function retrieve(string $threadId, string $runId, string $stepId): ThreadRunStepResponse
    {
        $payload = Payload::retrieve('threads/'.$threadId.'/runs/'.$runId.'/steps', $stepId);

        /** @var Response<array{id: string, object: string, created_at: int, thread_id: string, assistant_id: string, run_id: string, type: string, status: string, step_details: array{type: 'tool_calls', tool_calls: array<int, array{id: string, type: 'code_interpreter', code_interpreter: array{input: string, outputs: array<int, array{type: 'image', image: array{file_id: string}}|array{type: 'logs', logs: string}>}}|array{id: string, type: 'retrieval', retrieval: array<string, string>}|array{id: string, type: 'function', function: array{name: string, arguments: string, output: ?string}}>}|array{type: 'message_creation', message_creation: array{message_id: string}}, last_error: ?array{code: string, message: string}, expires_at: ?int, cancelled_at: ?int, failed_at: ?int, completed_at: ?int, metadata?: array<string, string>}> $response */
        $response = $this->transporter->requestObject($payload);

        return ThreadRunStepResponse::from($response->data(), $response->meta());
    }

    /**
     * Returns a list of run steps belonging to a run.
     *
     * @see https://platform.openai.com/docs/api-reference/runs/listRunSteps
     *
     * @param  array<string, mixed>  $parameters
     */
    public function list(string $threadId, string $runId, array $parameters = []): ThreadRunStepListResponse
    {
        $payload = Payload::list('threads/'.$threadId.'/runs/'.$runId.'/steps', $parameters);

        /** @var Response<array{object: string, data: array<int, array{id: string, object: string, created_at: int, thread_id: string, assistant_id: string, run_id: string, type: string, status: string, step_details: array{type: 'tool_calls', tool_calls: array<int, array{id: string, type: 'code_interpreter', code_interpreter: array{input: string, outputs: array<int, array{type: 'image', image: array{file_id: string}}|array{type: 'logs', logs: string}>}}|array{id: string, type: 'retrieval', retrieval: array<string, string>}|array{id: string, type: 'function', function: array{name: string, arguments: string, output: ?string}}>}|array{type: 'message_creation', message_creation: array{message_id: string}}, last_error: ?array{code: string, message: string}, expires_at: ?int, cancelled_at: ?int, failed_at: ?int, completed_at: ?int, metadata?: array<string, string>}>, first_id: ?string, last_id: ?string, has_more: bool}> $response */
        $response = $this->transporter->requestObject($payload);

        return ThreadRunStepListResponse::from($response->data(), $response->meta());
    }
}
