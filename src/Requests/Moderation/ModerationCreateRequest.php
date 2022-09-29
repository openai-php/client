<?php

namespace OpenAI\Requests\Moderation;

use OpenAI\Contracts\Request;
use OpenAI\Enums\Moderation\ModerationModel;

final class ModerationCreateRequest implements Request
{
    public function __construct(
        public readonly string $input,
        public readonly ModerationModel $model = ModerationModel::TextModerationLatest,
    ) {
    }

    /**
     * @return array<string, string>
     */
    public function toArray(): array
    {
        return [
            'input' => $this->input,
            'model' => $this->model->value,
        ];
    }
}
