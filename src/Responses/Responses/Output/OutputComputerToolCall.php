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
 * @implements ResponseContract<array{action: array{button: 'left'|'right'|'wheel'|'back'|'forward', type: 'click', x: float, y: float}|array{type: 'double_click', x: float, y: float}|array{path: array<int, array{x: int, y: int}>, type: 'drag'}|array{keys: array<int, string>, type: 'keypress'}|array{type: 'move', x: int, y: int}|array{type: 'screenshot'}|array{scroll_x: int, scroll_y: int, type: 'scroll', x: int, y: int}|array{text: string, type: 'type'}|array{type: 'wait'}, call_id: string, id: string, pending_safety_checks: array<int, array{code: string, id: string, message: string}>, status: 'in_progress'|'completed'|'incomplete', type: 'computer_call'}>
 */
final class OutputComputerToolCall implements ResponseContract
{
    /**
     * @use ArrayAccessible<array{action: array{button: 'left'|'right'|'wheel'|'back'|'forward', type: 'click', x: float, y: float}|array{type: 'double_click', x: float, y: float}|array{path: array<int, array{x: int, y: int}>, type: 'drag'}|array{keys: array<int, string>, type: 'keypress'}|array{type: 'move', x: int, y: int}|array{type: 'screenshot'}|array{scroll_x: int, scroll_y: int, type: 'scroll', x: int, y: int}|array{text: string, type: 'type'}|array{type: 'wait'}, call_id: string, id: string, pending_safety_checks: array<int, array{code: string, id: string, message: string}>, status: 'in_progress'|'completed'|'incomplete', type: 'computer_call'}>
     */
    use ArrayAccessible;

    use Fakeable;

    /**
     * @param  array<int, OutputComputerPendingSafetyCheck>  $pendingSafetyChecks
     * @param  'in_progress'|'completed'|'incomplete'  $status
     * @param  'computer_call'  $type
     */
    private function __construct(
        public readonly Click|DoubleClick|Drag|KeyPress|Move|Screenshot|Scroll|Type|Wait $action,
        public readonly string $callId,
        public readonly string $id,
        public readonly array $pendingSafetyChecks,
        public readonly string $status,
        public readonly string $type,
    ) {}

    /**
     * @param  array{action: array{button: 'left'|'right'|'wheel'|'back'|'forward', type: 'click', x: float, y: float}|array{type: 'double_click', x: float, y: float}|array{path: array<int, array{x: int, y: int}>, type: 'drag'}|array{keys: array<int, string>, type: 'keypress'}|array{type: 'move', x: int, y: int}|array{type: 'screenshot'}|array{scroll_x: int, scroll_y: int, type: 'scroll', x: int, y: int}|array{text: string, type: 'type'}|array{type: 'wait'}, call_id: string, id: string, pending_safety_checks: array<int, array{code: string, id: string, message: string}>, status: 'in_progress'|'completed'|'incomplete', type: 'computer_call'}  $attributes
     */
    public static function from(array $attributes): self
    {
        $action = match ($attributes['action']['type']) {
            'click' => Click::from($attributes['action']),
            'double_click' => DoubleClick::from($attributes['action']),
            'drag' => Drag::from($attributes['action']),
            'keypress' => KeyPress::from($attributes['action']),
            'move' => Move::from($attributes['action']),
            'screenshot' => Screenshot::from($attributes['action']),
            'scroll' => Scroll::from($attributes['action']),
            'type' => Type::from($attributes['action']),
            'wait' => Wait::from($attributes['action']),
        };

        $pendingSafetyChecks = array_map(
            fn (array $safetyCheck): OutputComputerPendingSafetyCheck => OutputComputerPendingSafetyCheck::from($safetyCheck),
            $attributes['pending_safety_checks']
        );

        return new self(
            action: $action,
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
            'action' => $this->action->toArray(),
            'call_id' => $this->callId,
            'id' => $this->id,
            'pending_safety_checks' => array_map(
                fn (OutputComputerPendingSafetyCheck $safetyCheck): array => $safetyCheck->toArray(),
                $this->pendingSafetyChecks,
            ),
            'status' => $this->status,
            'type' => $this->type,
        ];
    }
}
