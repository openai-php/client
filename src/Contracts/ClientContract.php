<?php

declare(strict_types=1);

namespace OpenAI\Contracts;

use OpenAI\Contracts\Resources\AssistantsContract;
use OpenAI\Contracts\Resources\AudioContract;
use OpenAI\Contracts\Resources\ChatContract;
use OpenAI\Contracts\Resources\CompletionsContract;
use OpenAI\Contracts\Resources\EmbeddingsContract;
use OpenAI\Contracts\Resources\FilesContract;
use OpenAI\Contracts\Resources\FineTunesContract;
use OpenAI\Contracts\Resources\ImagesContract;
use OpenAI\Contracts\Resources\ModelsContract;
use OpenAI\Contracts\Resources\ModerationsContract;
use OpenAI\Contracts\Resources\EditsContract;
use OpenAI\Contracts\Resources\ResponsesContract; // Add ResponsesContract

/**
 * @internal
 */
interface ClientContract
{
    /**
     * Returns an audio resource.
     */
    public function audio(): AudioContract;

    /**
     * Returns a chat resource.
     */
    public function chat(): ChatContract;

    /**
     * Returns a completions resource.
     */
    public function completions(): CompletionsContract;

    /**
     * Returns an edits resource.
     */
    public function edits(): EditsContract;

    /**
     * Returns an embeddings resource.
     */
    public function embeddings(): EmbeddingsContract;

    /**
     * Returns a files resource.
     */
    public function files(): FilesContract;

    /**
     * Returns a fine tunes resource.
     */
    public function fineTunes(): FineTunesContract;

    /**
     * Returns a images resource.
     */
    public function images(): ImagesContract;

    /**
     * Returns a models resource.
     */
    public function models(): ModelsContract;

    /**
     * Returns a moderations resource.
     */
    public function moderations(): ModerationsContract;

    /**
     * Returns a assistants resource.
     */
    public function assistants(): AssistantsContract;

    /**
     * Returns a responses resource.
     */
    public function responses(): ResponsesContract;
}
