<?php

namespace OpenAI\RequestFactories\Moderation;

use OpenAI\Enums\Moderation\ModerationModel;
use OpenAI\Requests\Moderation\ModerationCreateRequest;

final class ModerationCreateRequestFactory
{
    /**
     * @param  array<string, string>  $attributes
     */
    public static function new(array $attributes): ModerationCreateRequest
    {
        return (new self)->make(
            attributes: $attributes,
        );
    }

    /**
     * @param  array<string, string|ModerationModel>  $attributes
     */
    public function make(array $attributes): ModerationCreateRequest
    {
        $model = is_string($attributes['model']) ? ModerationModel::tryFrom($attributes['model']) : $attributes['model'];
        $model = $model ?: ModerationModel::TextModerationLatest;

        return new ModerationCreateRequest(
            input: strval($attributes['input'] ?? ''),
            model: $model,
        );
    }
}
