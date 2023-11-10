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

        /** @var Response<array{created: int, data: array<int, array{url?: string, b64_json?: string}>}> $response */
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

        /** @var Response<array{created: int, data: array<int, array{url?: string, b64_json?: string}>}> $response */
        $response = $this->transporter->requestObject($payload);

        return ThreadRunStepListResponse::from($response->data(), $response->meta());
    }
}
