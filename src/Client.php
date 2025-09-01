<?php

declare(strict_types=1);

namespace OpenAI;

use OpenAI\Contracts\ClientContract;
use OpenAI\Contracts\Resources\RealtimeContract;
use OpenAI\Contracts\Resources\ThreadsContract;
use OpenAI\Contracts\Resources\VectorStoresContract;
use OpenAI\Contracts\TransporterContract;
use OpenAI\Resources\Assistants;
use OpenAI\Resources\Audio;
use OpenAI\Resources\Batches;
use OpenAI\Resources\Chat;
use OpenAI\Resources\Completions;
use OpenAI\Resources\Containers;
use OpenAI\Resources\Conversations;
use OpenAI\Resources\Edits;
use OpenAI\Resources\Embeddings;
use OpenAI\Resources\Files;
use OpenAI\Resources\FineTunes;
use OpenAI\Resources\FineTuning;
use OpenAI\Resources\Images;
use OpenAI\Resources\Models;
use OpenAI\Resources\Moderations;
use OpenAI\Resources\Realtime;
use OpenAI\Resources\Responses;
use OpenAI\Resources\Threads;
use OpenAI\Resources\VectorStores;

final class Client implements ClientContract
{
    /**
     * Creates a Client instance with the given API token.
     */
    public function __construct(private readonly TransporterContract $transporter)
    {
        // ..
    }

    /**
     * Manage responses to assist models with tasks.
     *
     * @see https://platform.openai.com/docs/api-reference/responses
     */
    public function responses(): Responses
    {
        return new Responses($this->transporter);
    }

    /**
     * Create and manage conversations to store and retrieve conversation state across Response API calls.
     *
     * @see https://platform.openai.com/docs/api-reference/conversations
     */
    public function conversations(): Conversations
    {
        return new Conversations($this->transporter);
    }

    /**
     * Given a prompt, the model will return one or more predicted completions, and can also return the probabilities
     * of alternative tokens at each position.
     *
     * @see https://platform.openai.com/docs/api-reference/completions
     */
    public function completions(): Completions
    {
        return new Completions($this->transporter);
    }

    /**
     * Given a chat conversation, the model will return a chat completion response.
     *
     * @see https://platform.openai.com/docs/api-reference/chat
     */
    public function chat(): Chat
    {
        return new Chat($this->transporter);
    }

    /**
     * Create and manage containers for use with the Code Interpreter tool.
     *
     * @see https://platform.openai.com/docs/api-reference/containers
     */
    public function containers(): Containers
    {
        return new Containers($this->transporter);
    }

    /**
     * Get a vector representation of a given input that can be easily consumed by machine learning models and algorithms.
     *
     * @see https://platform.openai.com/docs/api-reference/embeddings
     */
    public function embeddings(): Embeddings
    {
        return new Embeddings($this->transporter);
    }

    /**
     * Learn how to turn audio into text.
     *
     * @see https://platform.openai.com/docs/api-reference/audio
     */
    public function audio(): Audio
    {
        return new Audio($this->transporter);
    }

    /**
     * Given a prompt and an instruction, the model will return an edited version of the prompt.
     *
     * @see https://platform.openai.com/docs/api-reference/edits
     */
    public function edits(): Edits
    {
        return new Edits($this->transporter);
    }

    /**
     * Files are used to upload documents that can be used with features like Fine-tuning.
     *
     * @see https://platform.openai.com/docs/api-reference/files
     */
    public function files(): Files
    {
        return new Files($this->transporter);
    }

    /**
     * List and describe the various models available in the API.
     *
     * @see https://platform.openai.com/docs/api-reference/models
     */
    public function models(): Models
    {
        return new Models($this->transporter);
    }

    /**
     * Manage fine-tuning jobs to tailor a model to your specific training data.
     *
     * @see https://platform.openai.com/docs/api-reference/fine-tuning
     */
    public function fineTuning(): FineTuning
    {
        return new FineTuning($this->transporter);
    }

    /**
     * Manage fine-tuning jobs to tailor a model to your specific training data.
     *
     * @see https://platform.openai.com/docs/api-reference/fine-tunes
     * @deprecated OpenAI has deprecated this endpoint and will stop working by January 4, 2024.
     * https://openai.com/blog/gpt-3-5-turbo-fine-tuning-and-api-updates#updated-gpt-3-models
     */
    public function fineTunes(): FineTunes
    {
        return new FineTunes($this->transporter);
    }

    /**
     * Given an input text, outputs if the model classifies it as violating OpenAI's content policy.
     *
     * @see https://platform.openai.com/docs/api-reference/moderations
     */
    public function moderations(): Moderations
    {
        return new Moderations($this->transporter);
    }

    /**
     * Given a prompt and/or an input image, the model will generate a new image.
     *
     * @see https://platform.openai.com/docs/api-reference/images
     */
    public function images(): Images
    {
        return new Images($this->transporter);
    }

    /**
     * Build assistants that can call models and use tools to perform tasks.
     *
     * @see https://platform.openai.com/docs/api-reference/assistants
     */
    public function assistants(): Assistants
    {
        return new Assistants($this->transporter);
    }

    /**
     * Communicate with a model in real time using WebRTC or WebSockets.
     *
     * @see https://platform.openai.com/docs/api-reference/realtime
     */
    public function realtime(): RealtimeContract
    {
        return new Realtime($this->transporter);
    }

    /**
     * Create threads that assistants can interact with.
     *
     * @see https://platform.openai.com/docs/api-reference/threads
     */
    public function threads(): ThreadsContract
    {
        return new Threads($this->transporter);
    }

    /**
     * Create large batches of API requests for asynchronous processing. The Batch API returns completions within 24 hours.
     *
     * @see https://platform.openai.com/docs/api-reference/batch
     */
    public function batches(): Batches
    {
        return new Batches($this->transporter);
    }

    /**
     * Create and update vector stores that assistants can interact with
     *
     * @see https://platform.openai.com/docs/api-reference/vector-stores
     */
    public function vectorStores(): VectorStoresContract
    {
        return new VectorStores($this->transporter);
    }
}
