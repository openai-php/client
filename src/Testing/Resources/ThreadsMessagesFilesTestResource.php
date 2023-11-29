<?php

namespace OpenAI\Testing\Resources;

use OpenAI\Contracts\Resources\ThreadsMessagesFilesContract;
use OpenAI\Responses\Threads\Messages\Files\ThreadMessageFileListResponse;
use OpenAI\Responses\Threads\Messages\Files\ThreadMessageFileResponse;
use OpenAI\Testing\Resources\Concerns\Testable;

final class ThreadsMessagesFilesTestResource implements ThreadsMessagesFilesContract
{
    use Testable;

    public function resource(): string
    {
        return ThreadsMessagesFiles::class;
    }

    public function retrieve(string $threadId, string $messageId, string $fileId): ThreadMessageFileResponse
    {
        return $this->record(__FUNCTION__, $threadId, $messageId, $fileId);
    }

    public function list(string $threadId, string $messageId, array $parameters = []): ThreadMessageFileListResponse
    {
        return $this->record(__FUNCTION__, $threadId, $messageId, $parameters);
    }
}
