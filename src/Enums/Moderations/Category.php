<?php

declare(strict_types=1);

namespace OpenAI\Enums\Moderations;

enum Category: string
{
    case Hate = 'hate';
    case HateThreatening = 'hate/threatening';
    case Harassment = 'harassment';
    case HarassmentThreatening = 'harassment/threatening';
    case SelfHarm = 'self-harm';
    case SelfHarmIntent = 'self-harm/intent';
    case SelfHarmInstructions = 'self-harm/instructions';
    case Sexual = 'sexual';
    case SexualMinors = 'sexual/minors';
    case Violence = 'violence';
    case ViolenceGraphic = 'violence/graphic';
}
