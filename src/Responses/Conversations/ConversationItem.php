<?php

declare(strict_types=1);

namespace OpenAI\Responses\Conversations;

use OpenAI\Actions\Conversations\ItemObjects;
use OpenAI\Contracts\ResponseContract;
use OpenAI\Responses\Concerns\ArrayAccessible;
use OpenAI\Responses\Conversations\Objects\Message;
use OpenAI\Responses\Responses\Input\ComputerToolCallOutput;
use OpenAI\Responses\Responses\Input\CustomToolCallOutput;
use OpenAI\Responses\Responses\Input\FunctionToolCallOutput;
use OpenAI\Responses\Responses\Input\LocalShellCallOutput;
use OpenAI\Responses\Responses\Input\McpApprovalResponse;
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
use OpenAI\Responses\Responses\Output\OutputReasoning;
use OpenAI\Responses\Responses\Output\OutputWebSearchToolCall;
use OpenAI\Testing\Responses\Concerns\Fakeable;

/**
 * @phpstan-import-type ItemObjectTypes from ItemObjects
 *
 * @phpstan-type ConversationItemType ItemObjectTypes
 *
 * @implements ResponseContract<ConversationItemType>
 */
final class ConversationItem implements ResponseContract
{
    /**
     * @use ArrayAccessible<ConversationItemType>
     */
    use ArrayAccessible;

    use Fakeable;

    private function __construct(
        public readonly Message|OutputFileSearchToolCall|OutputFunctionToolCall|FunctionToolCallOutput|LocalShellCallOutput|McpApprovalResponse|CustomToolCallOutput|OutputWebSearchToolCall|OutputComputerToolCall|ComputerToolCallOutput|OutputReasoning|OutputMcpListTools|OutputMcpApprovalRequest|OutputMcpCall|OutputImageGenerationToolCall|OutputCodeInterpreterToolCall|OutputLocalShellCall|OutputCustomToolCall $item
    ) {}

    /**
     * @param  ConversationItemType  $attributes
     */
    public static function from(array $attributes): self
    {
        // Lets re-use our existing parser, so we don't have to duplicate the logic.
        // But we need to wrap the attributes in an array, since it expects an array of items.
        $item = ItemObjects::parse([$attributes])[0];

        return new self(
            item: $item,
        );
    }

    /**
     * {@inheritDoc}
     */
    public function toArray(): array
    {
        return $this->item->toArray();
    }
}
