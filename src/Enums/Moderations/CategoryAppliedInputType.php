<?php

declare(strict_types=1);

namespace OpenAI\Enums\Moderations;

enum CategoryAppliedInputType: string
{
    case Text = 'text';
    case Image = 'image';
    case Audio = 'audio';
}
