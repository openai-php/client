<?php

declare(strict_types=1);

namespace OpenAI\Responses\Responses\Output;

use OpenAI\Contracts\ResponseContract;
use OpenAI\Responses\Concerns\ArrayAccessible;
use OpenAI\Responses\Responses\Output\ComputerAction\OutputComputerActionClick as Click;
use OpenAI\Responses\Responses\Output\ComputerAction\OutputComputerActionDoubleClick as DoubleClick;
use OpenAI\Responses\Responses\Output\ComputerAction\OutputComputerActionDrag as Drag;
use OpenAI\Responses\Responses\Output\ComputerAction\OutputComputerActionKeyPress as KeyPress;
use OpenAI\Responses\Responses\Output\ComputerAction\OutputComputerActionMove as Move;
use OpenAI\Responses\Responses\Output\ComputerAction\OutputComputerActionScreenshot as Screenshot;
use OpenAI\Responses\Responses\Output\ComputerAction\OutputComputerActionScroll as Scroll;
use OpenAI\Responses\Responses\Output\ComputerAction\OutputComputerActionType as Type;
use OpenAI\Responses\Responses\Output\ComputerAction\OutputComputerActionWait as Wait;
use OpenAI\Responses\Responses\Output\ComputerAction\OutputComputerPendingSafetyCheck;
use OpenAI\Testing\Responses\Concerns\Fakeable;

/**
 * @phpstan-import-type ClickType from Click
 * @phpstan-import-type DoubleClickType from DoubleClick
 * @phpstan-import-type DragType from Drag
 * @phpstan-import-type KeyPressType from KeyPress
 * @phpstan-import-type MoveType from Move
 * @phpstan-import-type ScreenshotType from Screenshot
 * @phpstan-import-type ScrollType from Scroll
 * @phpstan-import-type TypeType from Type
 * @phpstan-import-type WaitType from Wait
 * @phpstan-import-type PendingSafetyCheckType from OutputComputerPendingSafetyCheck
 *
 * @phpstan-type ActionType ClickType|DoubleClickType|DragType|KeyPressType|MoveType|ScreenshotType|ScrollType|TypeType|WaitType
 * @phpstan-type OutputComputerToolCallType array{action?: ActionType, actions?: array<int, ActionType>, call_id: string, id: string, pending_safety_checks?: array<int, PendingSafetyCheckType>, status: 'in_progress'|'completed'|'incomplete', type: 'computer_call'}
 *
 * @implements ResponseContract<OutputComputerToolCallType>
 */
final class OutputComputerToolCall implements ResponseContract
{
    /**
     * @use ArrayAccessible<OutputComputerToolCallType>
     */
    use ArrayAccessible;

    use Fakeable;

    /**
     * @param  array<int, Click|DoubleClick|Drag|KeyPress|Move|Screenshot|Scroll|Type|Wait>  $actions
     * @param  array<int, OutputComputerPendingSafetyCheck>  $pendingSafetyChecks
     * @param  'in_progress'|'completed'|'incomplete'  $status
     * @param  'computer_call'  $type
     */
    private function __construct(
        public readonly array $actions,
        public readonly string $callId,
        public readonly string $id,
        public readonly array $pendingSafetyChecks,
        public readonly string $status,
        public readonly string $type,
    ) {}

    /**
     * @param  OutputComputerToolCallType  $attributes
     */
    public static function from(array $attributes): self
    {
        /** @var array<int, ActionType> $actionAttributes */
        $actionAttributes = [];
        if (isset($attributes['actions'])) {
            $actionAttributes = $attributes['actions'];
        } elseif (isset($attributes['action'])) {
            $actionAttributes = [$attributes['action']];
        }

        $actions = array_map(
            static fn (array $action): Click|DoubleClick|Drag|KeyPress|Move|Screenshot|Scroll|Type|Wait => self::mapAction($action),
            $actionAttributes
        );

        $pendingSafetyChecks = array_map(
            fn (array $safetyCheck): OutputComputerPendingSafetyCheck => OutputComputerPendingSafetyCheck::from($safetyCheck),
            $attributes['pending_safety_checks'] ?? []
        );

        return new self(
            actions: $actions,
            callId: $attributes['call_id'],
            id: $attributes['id'],
            pendingSafetyChecks: $pendingSafetyChecks,
            status: $attributes['status'],
            type: $attributes['type'],
        );
    }

    /**
     * {@inheritDoc}
     */
    public function toArray(): array
    {
        return [
            'type' => $this->type,
            'call_id' => $this->callId,
            'id' => $this->id,
            'actions' => array_map(
                fn (Click|DoubleClick|Drag|KeyPress|Move|Screenshot|Scroll|Type|Wait $action): array => $action->toArray(),
                $this->actions,
            ),
            'pending_safety_checks' => array_map(
                fn (OutputComputerPendingSafetyCheck $safetyCheck): array => $safetyCheck->toArray(),
                $this->pendingSafetyChecks,
            ),
            'status' => $this->status,
        ];
    }

    /**
     * @param  array<string, mixed>  $action
     */
    private static function mapAction(array $action): Click|DoubleClick|Drag|KeyPress|Move|Screenshot|Scroll|Type|Wait
    {
        switch ($action['type'] ?? null) {
            case 'click':
                /** @var ClickType $action */
                return Click::from($action);
            case 'double_click':
                /** @var DoubleClickType $action */
                return DoubleClick::from($action);
            case 'drag':
                /** @var DragType $action */
                return Drag::from($action);
            case 'keypress':
                /** @var KeyPressType $action */
                return KeyPress::from($action);
            case 'move':
                /** @var MoveType $action */
                return Move::from($action);
            case 'screenshot':
                /** @var ScreenshotType $action */
                return Screenshot::from($action);
            case 'scroll':
                /** @var ScrollType $action */
                return Scroll::from($action);
            case 'type':
                /** @var TypeType $action */
                return Type::from($action);
            case 'wait':
                /** @var WaitType $action */
                return Wait::from($action);
            default:
                throw new \InvalidArgumentException('Invalid or missing action type in computer action payload.');
        }
    }
}
