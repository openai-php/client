<?php

declare(strict_types=1);

namespace OpenAI\Actions\Responses;

use OpenAI\Responses\Responses\Output\OutputMessage;
use OpenAI\Responses\Responses\Output\OutputMessageContentOutputText;

/**
 * An SDK-only property (output_text) that concatenates all text content from output messages.
 *
 * @phpstan-import-type ResponseOutputObjectReturnType from OutputObjects
 */
final class OutputText
{
    /**
     * @param  ResponseOutputObjectReturnType  $outputItems
     */
    public static function parse(array $outputItems): ?string
    {
        $texts = [];
        foreach ($outputItems as $item) {
            if ($item instanceof OutputMessage) {
                foreach ($item->content as $content) {
                    if ($content instanceof OutputMessageContentOutputText) {
                        $texts[] = $content->text;
                    }
                }
            }
        }

        return empty($texts) ? null : implode(' ', $texts);
    }
}
