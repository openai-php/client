<?php

declare(strict_types=1);

namespace OpenAI\Enums\Moderations;

enum Category: string
{
    case Hate = 'hate';
    case HateThreatening = 'hate/threatening';
    case SelfHarm = 'self-harm';
    case Sexual = 'sexual';
    case SexualMinors = 'sexual/minors';
    case Violence = 'violence';
    case ViolenceGraphic = 'violence/graphic';
}
