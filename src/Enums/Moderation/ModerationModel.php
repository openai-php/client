<?php

namespace OpenAI\Enums\Moderation;

enum ModerationModel: string
{
    case TextModerationLatest = 'text-moderation-latest';
    case TextModerationStable = 'text-moderation-stable';
}
