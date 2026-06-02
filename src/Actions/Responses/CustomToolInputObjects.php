<?php

declare(strict_types=1);

namespace OpenAI\Actions\Responses;

use OpenAI\Responses\Responses\Tool\CustomToolInputs\GrammarInput;
use OpenAI\Responses\Responses\Tool\CustomToolInputs\TextInput;

/**
 * @phpstan-import-type TextInputType from TextInput
 * @phpstan-import-type GrammarInputType from GrammarInput
 *
 * @phpstan-type CustomToolInputTypes TextInputType|GrammarInputType
 * @phpstan-type CustomToolInputReturnType TextInput|GrammarInput
 */
final class CustomToolInputObjects
{
    /**
     * @param  CustomToolInputTypes  $attributes
     */
    public static function parse(array $attributes): TextInput|GrammarInput
    {
        return match ($attributes['type']) {
            'text' => TextInput::from($attributes),
            'grammar' => GrammarInput::from($attributes),
        };
    }
}
