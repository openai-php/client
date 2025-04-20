<?php

/**
 * @return array<string, mixed>
 */
function chatCompletion(): array
{
    return [
        'id' => 'chatcmpl-123',
        'object' => 'chat.completion',
        'created' => 1677652288,
        'model' => 'gpt-3.5-turbo',
        'choices' => [
            [
                'index' => 0,
                'message' => [
                    'role' => 'assistant',
                    'content' => "\n\nHello there, how may I assist you today?",
                ],
                'logprobs' => null,
                'finish_reason' => 'stop',
            ],
        ],
        'usage' => [
            'prompt_tokens' => 9,
            'completion_tokens' => 12,
            'total_tokens' => 21,
            'prompt_tokens_details' => [
                'cached_tokens' => 5,
            ],
            'completion_tokens_details' => [
                'reasoning_tokens' => 0,
                'accepted_prediction_tokens' => 0,
                'rejected_prediction_tokens' => 0,
            ],
        ],
    ];
}

/**
 * @return array<string, mixed>
 */
function chatCompletionOpenRouter(): array
{
    return [
        'id' => 'gen-123',
        'object' => 'chat.completion',
        'created' => 1744873707,
        'model' => 'mistral/ministral-8b',
        'choices' => [
            [
                'index' => 0,
                'message' => [
                    'role' => 'assistant',
                    'content' => 'Hello! How can I assist you today?',
                ],
                'logprobs' => null,
                'finish_reason' => 'stop',
            ],
        ],
        'usage' => [
            'prompt_tokens' => 13,
            'completion_tokens' => 20,
            'total_tokens' => 33,
        ],
    ];
}

/**
 * @return array<string, mixed>
 */
function chatCompletionOpenRouterOpenAI(): array
{
    return [
        'id' => 'gen-123',
        'provider' => 'OpenAI',
        'model' => 'openai/gpt-4o-mini',
        'object' => 'chat.completion',
        'created' => 1744900650,
        'system_fingerprint' => 'fp_0392822090',
        'choices' => [
            [
                'index' => 0,
                'message' => [
                    'role' => 'assistant',
                    'content' => 'Hello! How can I assist you today?',
                    'refusal' => null,
                    'reasoning' => null,
                ],
                'logprobs' => null,
                'finish_reason' => 'stop',
                'native_finish_reason' => 'stop',
            ],
        ],
        'usage' => [
            'prompt_tokens' => 21,
            'completion_tokens' => 21,
            'total_tokens' => 42,
            'prompt_tokens_details' => [
                'cached_tokens' => 0,
            ],
            'completion_tokens_details' => [
                'reasoning_tokens' => 0,
            ],
        ],
    ];
}

/**
 * @return array<string, mixed>
 */
function chatCompletionOpenRouterGoogle(): array
{
    return [
        'id' => 'gen-123',
        'provider' => 'Google',
        'model' => 'google/gemini-2.5-pro-preview-03-25',
        'object' => 'chat.completion',
        'created' => 1744910839,
        'choices' => [
            [
                'index' => 0,
                'message' => [
                    'role' => 'assistant',
                    'content' => 'Hello there! I\'m a large language model, trained by Google.',
                    'refusal' => null,
                    'reasoning' => null,
                ],
                'logprobs' => null,
                'finish_reason' => 'stop',
                'native_finish_reason' => 'STOP',
            ],
        ],
        'usage' => [
            'prompt_tokens' => 10,
            'completion_tokens' => 138,
            'total_tokens' => 148,
        ],
    ];
}

/**
 * @return array<string, mixed>
 */
function chatCompletionOpenRouterXAI(): array
{
    return [
        'id' => 'gen-123',
        'provider' => 'xAI',
        'model' => 'x-ai/grok-3-mini-beta',
        'object' => 'chat.completion',
        'created' => 1744911228,
        'system_fingerprint' => 'fp_d133ae3397',
        'choices' => [
            [
                'index' => 0,
                'message' => [
                    'role' => 'assistant',
                    'content' => 'Hello! I\'m Grok, an AI model created by xAI.',
                    'refusal' => null,
                    'reasoning' => 'First, the user is asking "Hello! what model are you?"',
                ],
                'logprobs' => null,
                'finish_reason' => 'stop',
                'native_finish_reason' => 'stop',
            ],
        ],
        'usage' => [
            'prompt_tokens' => 21,
            'completion_tokens' => 36,
            'total_tokens' => 392,
            'prompt_tokens_details' => [
                'cached_tokens' => 0,
            ],
            'completion_tokens_details' => [
                'reasoning_tokens' => 335,
            ],
        ],
    ];
}

/**
 * @return array<string, mixed>
 */
function chatCompletionWithoutId(): array
{
    return [
        'object' => 'chat.completion',
        'created' => 1677652288,
        'model' => 'gpt-3.5-turbo',
        'choices' => [
            [
                'index' => 0,
                'message' => [
                    'role' => 'assistant',
                    'content' => "\n\nHello there, how may I assist you today?",
                ],
                'finish_reason' => 'stop',
            ],
        ],
        'usage' => [
            'prompt_tokens' => 9,
            'completion_tokens' => 12,
            'total_tokens' => 21,
            'prompt_tokens_details' => [
                'cached_tokens' => 5,
            ],
            'completion_tokens_details' => [
                'reasoning_tokens' => 0,
                'accepted_prediction_tokens' => 0,
                'rejected_prediction_tokens' => 0,
            ],
        ],
    ];
}

/**
 * @return array<string, mixed>
 */
function chatCompletionWithoutUsage(): array
{
    return [
        'id' => 'chatcmpl-123',
        'object' => 'chat.completion',
        'created' => 1677652288,
        'model' => 'gpt-3.5-turbo',
        'choices' => [
            [
                'index' => 0,
                'message' => [
                    'role' => 'assistant',
                    'content' => "\n\nHello there, how may I assist you today?",
                ],
                'finish_reason' => 'stop',
            ],
        ],
    ];
}

/**
 * @return array<string, mixed>
 */
function chatCompletionWithoutLogprobs(): array
{
    return [
        'id' => 'chatcmpl-123',
        'object' => 'chat.completion',
        'created' => 1677652288,
        'model' => 'gpt-3.5-turbo',
        'choices' => [
            [
                'index' => 0,
                'message' => [
                    'role' => 'assistant',
                    'content' => "\n\nHello there, how may I assist you today?",
                ],
                'finish_reason' => 'stop',
            ],
        ],
        'usage' => [
            'prompt_tokens' => 9,
            'completion_tokens' => 12,
            'total_tokens' => 21,
            'prompt_tokens_details' => [
                'cached_tokens' => 5,
            ],
            'completion_tokens_details' => [
                'reasoning_tokens' => 0,
                'accepted_prediction_tokens' => 0,
                'rejected_prediction_tokens' => 0,
            ],
        ],
    ];
}

/**
 * @return array<string, mixed>
 */
function chatCompletionWithLogprobs(): array
{
    return [
        'id' => 'chatcmpl-123',
        'object' => 'chat.completion',
        'created' => 1677652288,
        'model' => 'gpt-3.5-turbo',
        'choices' => [
            [
                'index' => 0,
                'message' => [
                    'role' => 'assistant',
                    'content' => 'Hello!',
                ],
                'logprobs' => [
                    'content' => [
                        [
                            'token' => 'Hello',
                            'logprob' => 0.0,
                            'bytes' => [72, 101, 108, 108, 111],
                        ],
                        [
                            'token' => '!',
                            'logprob' => -0.0005715019651688635,
                            'bytes' => [33],
                        ],
                    ],
                ],
                'finish_reason' => 'stop',
            ],
        ],
        'usage' => [
            'prompt_tokens' => 18,
            'completion_tokens' => 3,
            'total_tokens' => 21,
        ],
    ];
}

/**
 * @return array<string, mixed>
 */
function chatCompletionWithSystemFingerprint(): array
{
    return [
        'id' => 'chatcmpl-123',
        'object' => 'chat.completion',
        'created' => 1677652288,
        'model' => 'gpt-3.5-turbo',
        'system_fingerprint' => 'fp_44709d6fcb',
        'choices' => [
            [
                'index' => 0,
                'message' => [
                    'role' => 'assistant',
                    'content' => "\n\nHello there, how may I assist you today?",
                ],
                'logprobs' => null,
                'finish_reason' => 'stop',
            ],
        ],
        'usage' => [
            'prompt_tokens' => 9,
            'completion_tokens' => 12,
            'total_tokens' => 21,
        ],
    ];
}

/**
 * @return array<string, mixed>
 */
function chatCompletionWithFunction(): array
{
    return [
        'id' => 'chatcmpl-123',
        'object' => 'chat.completion',
        'created' => 1686689333,
        'model' => 'gpt-3.5-turbo-0613',
        'choices' => [
            [
                'index' => 0,
                'message' => [
                    'role' => 'assistant',
                    'content' => null,
                    'function_call' => [
                        'name' => 'get_current_weather',
                        'arguments' => "{\n  \"location\": \"Boston, MA\"\n}",
                    ],
                ],
                'logprobs' => null,
                'finish_reason' => 'function_call',
            ],
        ],
        'usage' => [
            'prompt_tokens' => 82,
            'completion_tokens' => 18,
            'total_tokens' => 100,
        ],
    ];
}

/**
 * @return array<string, mixed>
 */
function chatCompletionWithToolCalls(): array
{
    return [
        'id' => 'chatcmpl-123',
        'object' => 'chat.completion',
        'created' => 1699333252,
        'model' => 'gpt-3.5-turbo-0613',
        'choices' => [
            [
                'index' => 0,
                'message' => [
                    'role' => 'assistant',
                    'content' => null,
                    'tool_calls' => [
                        [
                            'id' => 'call_trlgKnhMpYSC7CFXKw3CceUZ',
                            'type' => 'function',
                            'function' => [
                                'name' => 'get_current_weather',
                                'arguments' => "{\n  \"location\": \"Boston, MA\"\n}",
                            ],
                        ],
                    ],
                ],
                'logprobs' => null,
                'finish_reason' => 'tool_calls',
            ],
        ],
        'usage' => [
            'prompt_tokens' => 71,
            'completion_tokens' => 17,
            'total_tokens' => 88,
        ],
    ];
}

/**
 * @return array<string, mixed>
 */
function chatCompletionMessageWithFunctionAndNoContent(): array
{
    return [
        'role' => 'assistant',
        'function_call' => [
            'name' => 'get_current_weather',
            'arguments' => "{\n  \"location\": \"Boston, MA\"\n}",
        ],
    ];
}

/**
 * @return array<string, mixed>
 */
function chatCompletionFromVision(): array
{
    return [
        'id' => 'chatcmpl-123',
        'object' => 'chat.completion',
        'created' => 1677652288,
        'model' => 'gpt-4-1106-vision-preview',
        'choices' => [
            [
                'index' => 0,
                'message' => [
                    'role' => 'assistant',
                    'content' => 'The image shows a beautiful, tranquil natural landscape. A wooden boardwalk path stretches',
                ],
                'logprobs' => null,
            ],
        ],
        'usage' => [
            'prompt_tokens' => 1114,
            'completion_tokens' => 16,
            'total_tokens' => 1130,
        ],
    ];
}

function chatCompletionStreamFirstChunk(): array
{
    return [
        'id' => 'chatcmpl-6wdIE4DsUtqf1srdMTsfkJp0VWZgz',
        'object' => 'chat.completion.chunk',
        'created' => 1679432086,
        'model' => 'gpt-4-0314',
        'choices' => [
            [
                'index' => 0,
                'delta' => [
                    'role' => 'assistant',
                ],
                'finish_reason' => null,
            ],
        ],
    ];
}

function chatCompletionStreamFirstChunkWithoutId(): array
{
    return [
        'object' => 'chat.completion.chunk',
        'created' => 1679432086,
        'model' => 'gpt-4-0314',
        'choices' => [
            [
                'index' => 0,
                'delta' => [
                    'role' => 'assistant',
                ],
                'finish_reason' => null,
            ],
        ],
    ];
}

function chatCompletionStreamContentChunk(): array
{
    return [
        'id' => 'chatcmpl-6wdIE4DsUtqf1srdMTsfkJp0VWZgz',
        'object' => 'chat.completion.chunk',
        'created' => 1679432086,
        'model' => 'gpt-4-0314',
        'choices' => [
            [
                'index' => 0,
                'delta' => [
                    'content' => 'Hello',
                ],
                'finish_reason' => null,
            ],
        ],
    ];
}

function chatCompletionStreamUsageChunk(): array
{
    return [
        'id' => 'chatcmpl-6wdIE4DsUtqf1srdMTsfkJp0VWZgz',
        'object' => 'chat.completion.chunk',
        'created' => 1679432086,
        'model' => 'gpt-4-0314',
        'choices' => [],
        'usage' => [
            'prompt_tokens' => 9,
            'completion_tokens' => 12,
            'total_tokens' => 21,
        ],
    ];
}

function chatCompletionStreamFunctionCallChunk(): array
{
    return [
        'id' => 'chatcmpl-6wdIE4DsUtqf1srdMTsfkJp0VWZgz',
        'object' => 'chat.completion.chunk',
        'created' => 1679432086,
        'model' => 'gpt-4-0314',
        'choices' => [
            [
                'index' => 0,
                'delta' => [
                    'content' => null,
                    'function_call' => [
                        'name' => 'get_current_weather',
                        'arguments' => '',
                    ],
                ],
                'finish_reason' => null,
            ],
        ],
    ];
}

function chatCompletionStreamToolCallsChunk(): array
{
    return [
        'id' => 'chatcmpl-6wdIE4DsUtqf1srdMTsfkJp0VWZgz',
        'object' => 'chat.completion.chunk',
        'created' => 1679432086,
        'model' => 'gpt-4-0314',
        'choices' => [
            [
                'index' => 0,
                'delta' => [
                    'tool_calls' => [
                        [
                            'id' => 'call_trlgKnhMpYSC7CFXKw3CceUZ',
                            'type' => 'function',
                            'function' => [
                                'name' => 'get_current_weather',
                                'arguments' => '',
                            ],
                        ],
                    ],
                ],
                'finish_reason' => null,
            ],
        ],
    ];
}

function chatCompletionStreamVisionContentChunk(): array
{
    return [
        'id' => 'chatcmpl-6wdIE4DsUtqf1srdMTsfkJp0VWZgz',
        'object' => 'chat.completion.chunk',
        'created' => 1679432086,
        'model' => 'gpt-4-1106-vision-preview',
        'choices' => [
            [
                'index' => 0,
                'delta' => [
                    'content' => 'This',
                ],
            ],
        ],
    ];
}

/**
 * @return resource
 */
function chatCompletionStream()
{
    return fopen(__DIR__.'/Streams/ChatCompletionCreate.txt', 'r');
}

/**
 * @return resource
 */
function chatCompletionStreamPing()
{
    return fopen(__DIR__.'/Streams/ChatCompletionPing.txt', 'r');
}

/**
 * @return resource
 */
function chatCompletionStreamError()
{
    return fopen(__DIR__.'/Streams/ChatCompletionCreateError.txt', 'r');
}
