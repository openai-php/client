<?php

declare(strict_types=1);

namespace OpenAI\Responses\Responses;

use OpenAI\Actions\Responses\OutputObjects;
use OpenAI\Actions\Responses\OutputText;
use OpenAI\Actions\Responses\ToolChoiceObjects;
use OpenAI\Actions\Responses\ToolObjects;
use OpenAI\Contracts\ResponseContract;
use OpenAI\Contracts\ResponseHasMetaInformationContract;
use OpenAI\Responses\Concerns\ArrayAccessible;
use OpenAI\Responses\Concerns\HasMetaInformation;
use OpenAI\Responses\Meta\MetaInformation;
use OpenAI\Responses\Responses\Output\OutputCodeInterpreterToolCall;
use OpenAI\Responses\Responses\Output\OutputComputerToolCall;
use OpenAI\Responses\Responses\Output\OutputCustomToolCall;
use OpenAI\Responses\Responses\Output\OutputFileSearchToolCall;
use OpenAI\Responses\Responses\Output\OutputFunctionToolCall;
use OpenAI\Responses\Responses\Output\OutputImageGenerationToolCall;
use OpenAI\Responses\Responses\Output\OutputLocalShellCall;
use OpenAI\Responses\Responses\Output\OutputMcpApprovalRequest;
use OpenAI\Responses\Responses\Output\OutputMcpCall;
use OpenAI\Responses\Responses\Output\OutputMcpListTools;
use OpenAI\Responses\Responses\Output\OutputMessage;
use OpenAI\Responses\Responses\Output\OutputReasoning;
use OpenAI\Responses\Responses\Output\OutputWebSearchToolCall;
use OpenAI\Responses\Responses\Tool\CodeInterpreterTool;
use OpenAI\Responses\Responses\Tool\ComputerUseTool;
use OpenAI\Responses\Responses\Tool\FileSearchTool;
use OpenAI\Responses\Responses\Tool\FunctionTool;
use OpenAI\Responses\Responses\Tool\ImageGenerationTool;
use OpenAI\Responses\Responses\Tool\RemoteMcpTool;
use OpenAI\Responses\Responses\Tool\WebSearchTool;
use OpenAI\Responses\Responses\ToolChoice\FunctionToolChoice;
use OpenAI\Responses\Responses\ToolChoice\HostedToolChoice;
use OpenAI\Testing\Responses\Concerns\Fakeable;

/**
 * @phpstan-import-type ResponseFormatType from CreateResponseFormat
 * @phpstan-import-type ErrorType from GenericResponseError
 * @phpstan-import-type IncompleteDetailsType from CreateResponseIncompleteDetails
 * @phpstan-import-type UsageType from CreateResponseUsage
 * @phpstan-import-type ReasoningType from CreateResponseReasoning
 * @phpstan-import-type ReferencePromptObjectType from ReferencePromptObject
 * @phpstan-import-type ResponseOutputObjectTypes from OutputObjects
 * @phpstan-import-type ResponseToolChoiceTypes from ToolChoiceObjects
 * @phpstan-import-type ResponseToolObjectTypes from ToolObjects
 *
 * @phpstan-type InstructionsType array<int, mixed>|string|null
 * @phpstan-type RetrieveResponseType array{id: string, background?: bool|null, object: 'response', created_at: int, status: 'completed'|'failed'|'in_progress'|'incomplete', error: ErrorType|null, incomplete_details: IncompleteDetailsType|null, instructions: InstructionsType, max_output_tokens: int|null, max_tool_calls?: int|null, model: string, output: ResponseOutputObjectTypes, output_text: string|null, parallel_tool_calls: bool, previous_response_id: string|null, prompt: ReferencePromptObjectType|null, prompt_cache_key?: string|null, reasoning: ReasoningType|null, safety_identifier?: string|null, service_tier?: string|null, store: bool, temperature: float|null, text: ResponseFormatType, tool_choice: ResponseToolChoiceTypes, tools: ResponseToolObjectTypes, top_logprobs?: int|null, top_p: float|null, truncation: 'auto'|'disabled'|null, usage: UsageType|null, user: string|null, verbosity: string|null, metadata: array<string, string>|null}
 *
 * @implements ResponseContract<RetrieveResponseType>
 */
final class RetrieveResponse implements ResponseContract, ResponseHasMetaInformationContract
{
    /**
     * @use ArrayAccessible<RetrieveResponseType>
     */
    use ArrayAccessible;

    use Fakeable;
    use HasMetaInformation;

    /**
     * @param  'response'  $object
     * @param  'completed'|'failed'|'in_progress'|'incomplete'  $status
     * @param  array<int, mixed>|string|null  $instructions
     * @param  array<int, OutputMessage|OutputComputerToolCall|OutputFileSearchToolCall|OutputWebSearchToolCall|OutputFunctionToolCall|OutputReasoning|OutputMcpListTools|OutputMcpApprovalRequest|OutputMcpCall|OutputImageGenerationToolCall|OutputCodeInterpreterToolCall|OutputLocalShellCall|OutputCustomToolCall>  $output
     * @param  array<int, ComputerUseTool|FileSearchTool|FunctionTool|WebSearchTool|ImageGenerationTool|RemoteMcpTool|CodeInterpreterTool>  $tools
     * @param  'auto'|'disabled'|null  $truncation
     * @param  array<string, string>  $metadata
     */
    private function __construct(
        public readonly string $id,
        public readonly ?bool $background,
        public readonly string $object,
        public readonly int $createdAt,
        public readonly string $status,
        public readonly ?GenericResponseError $error,
        public readonly ?CreateResponseIncompleteDetails $incompleteDetails,
        public readonly array|string|null $instructions,
        public readonly ?int $maxToolCalls,
        public readonly ?int $maxOutputTokens,
        public readonly string $model,
        public readonly array $output,
        public readonly ?string $outputText,
        public readonly bool $parallelToolCalls,
        public readonly ?string $previousResponseId,
        public readonly ?ReferencePromptObject $prompt,
        public readonly ?string $promptCacheKey,
        public readonly ?string $safetyIdentifier,
        public readonly ?string $serviceTier,
        public readonly ?CreateResponseReasoning $reasoning,
        public readonly bool $store,
        public readonly ?float $temperature,
        public readonly CreateResponseFormat $text,
        public readonly string|FunctionToolChoice|HostedToolChoice $toolChoice,
        public readonly array $tools,
        public readonly ?int $topLogProbs,
        public readonly ?float $topP,
        public readonly ?string $truncation,
        public readonly ?CreateResponseUsage $usage,
        public readonly ?string $user,
        public readonly ?string $verbosity,
        public array $metadata,
        private readonly MetaInformation $meta,
    ) {}

    /**
     * @param  RetrieveResponseType  $attributes
     */
    public static function from(array $attributes, MetaInformation $meta): self
    {
        $output = OutputObjects::parse($attributes['output']);
        $toolChoice = ToolChoiceObjects::parse($attributes['tool_choice']);
        $tools = ToolObjects::parse($attributes['tools']);

        return new self(
            id: $attributes['id'],
            background: $attributes['background'] ?? null,
            object: $attributes['object'],
            createdAt: $attributes['created_at'],
            status: $attributes['status'],
            error: isset($attributes['error'])
                ? GenericResponseError::from($attributes['error'])
                : null,
            incompleteDetails: isset($attributes['incomplete_details'])
                ? CreateResponseIncompleteDetails::from($attributes['incomplete_details'])
                : null,
            instructions: $attributes['instructions'],
            maxToolCalls: $attributes['max_tool_calls'] ?? null,
            maxOutputTokens: $attributes['max_output_tokens'],
            model: $attributes['model'],
            output: $output,
            outputText: OutputText::parse($output),
            parallelToolCalls: $attributes['parallel_tool_calls'],
            previousResponseId: $attributes['previous_response_id'],
            prompt: isset($attributes['prompt'])
                ? ReferencePromptObject::from($attributes['prompt'])
                : null,
            promptCacheKey: $attributes['prompt_cache_key'] ?? null,
            safetyIdentifier: $attributes['safety_identifier'] ?? null,
            serviceTier: $attributes['service_tier'] ?? null,
            reasoning: isset($attributes['reasoning'])
                ? CreateResponseReasoning::from($attributes['reasoning'])
                : null,
            store: $attributes['store'],
            temperature: $attributes['temperature'],
            text: CreateResponseFormat::from($attributes['text']),
            toolChoice: $toolChoice,
            tools: $tools,
            topLogProbs: $attributes['top_logprobs'] ?? null,
            topP: $attributes['top_p'],
            truncation: $attributes['truncation'],
            usage: isset($attributes['usage'])
                ? CreateResponseUsage::from($attributes['usage'])
                : null,
            user: $attributes['user'] ?? null,
            verbosity: $attributes['verbosity'] ?? null,
            metadata: $attributes['metadata'] ?? [],
            meta: $meta,
        );
    }

    /**
     * {@inheritDoc}
     */
    public function toArray(): array
    {
        // https://github.com/phpstan/phpstan/issues/8438
        // @phpstan-ignore-next-line
        return [
            'id' => $this->id,
            'background' => $this->background,
            'object' => $this->object,
            'created_at' => $this->createdAt,
            'status' => $this->status,
            'error' => $this->error?->toArray(),
            'incomplete_details' => $this->incompleteDetails?->toArray(),
            'instructions' => $this->instructions,
            'max_tool_calls' => $this->maxToolCalls,
            'max_output_tokens' => $this->maxOutputTokens,
            'metadata' => $this->metadata ?? [],
            'model' => $this->model,
            'output' => array_map(
                fn (OutputMessage|OutputComputerToolCall|OutputFileSearchToolCall|OutputWebSearchToolCall|OutputFunctionToolCall|OutputReasoning|OutputMcpListTools|OutputMcpApprovalRequest|OutputMcpCall|OutputImageGenerationToolCall|OutputCodeInterpreterToolCall|OutputLocalShellCall|OutputCustomToolCall $output): array => $output->toArray(),
                $this->output
            ),
            'output_text' => $this->outputText,
            'parallel_tool_calls' => $this->parallelToolCalls,
            'previous_response_id' => $this->previousResponseId,
            'prompt' => $this->prompt?->toArray(),
            'prompt_cache_key' => $this->promptCacheKey,
            'safety_identifier' => $this->safetyIdentifier,
            'service_tier' => $this->serviceTier,
            'reasoning' => $this->reasoning?->toArray(),
            'store' => $this->store,
            'temperature' => $this->temperature,
            'text' => $this->text->toArray(),
            'tool_choice' => is_string($this->toolChoice)
                ? $this->toolChoice
                : $this->toolChoice->toArray(),
            'tools' => array_map(
                fn (ComputerUseTool|FileSearchTool|FunctionTool|WebSearchTool|ImageGenerationTool|RemoteMcpTool|CodeInterpreterTool $tool): array => $tool->toArray(),
                $this->tools
            ),
            'top_logprobs' => $this->topLogProbs,
            'top_p' => $this->topP,
            'truncation' => $this->truncation,
            'usage' => $this->usage?->toArray(),
            'user' => $this->user,
            'verbosity' => $this->verbosity,
        ];
    }
}
