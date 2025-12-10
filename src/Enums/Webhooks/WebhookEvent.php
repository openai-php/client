<?php

namespace OpenAI\Enums\Webhooks;

enum WebhookEvent: string
{
    case BatchCancelled = 'batch.cancelled';
    case BatchCompleted = 'batch.completed';
    case BatchExpired = 'batch.expired';
    case BatchFailed = 'batch.failed';
    case EvalRunCancelled = 'eval.run.canceled';
    case EvalRunFailed = 'eval.run.failed';
    case EvalRunSucceeded = 'eval.run.succeeded';
    case FineTuningJobCancelled = 'fine_tuning.job.cancelled';
    case FineTuningJobFailed = 'fine_tuning.job.failed';
    case FineTuningJobSucceeded = 'fine_tuning.job.succeeded';
    case RealtimeCallIncoming = 'realtime.call.incoming';
    case ResponseCancelled = 'response.cancelled';
    case ResponseCompleted = 'response.completed';
    case ResponseFailed = 'response.failed';
    case ResponseIncomplete = 'response.incomplete';
    case VideoCompleted = 'video.completed';
    case VideoFailed = 'video.failed';
}
