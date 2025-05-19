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
function chatCompletionStreamError()
{
    return fopen(__DIR__.'/Streams/ChatCompletionCreateError.txt', 'r');
}

/**
 * @return array<string, mixed>
 */
function chatCompletionWithLogProbs(): array
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
                'logprobs' => [
                    'content' => [
                        [
                            'token' => 'Hello',
                            'logprob' => -0.0001,
                            'bytes' => [72, 101, 108, 108, 111],
                            'top_logprobs' => [
                                [
                                    'token' => 'Hello',
                                    'logprob' => -0.0001,
                                    'bytes' => [72, 101, 108, 108, 111],
                                ],
                            ],
                        ],
                    ],
                ],
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
function chatCompletionWithUsageDetails(): array
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
            'prompt_tokens_details' => [
                'audio_tokens' => 0,
                'image_tokens' => 0,
                'text_tokens' => 9,
            ],
            'completion_tokens' => 12,
            'completion_tokens_details' => [
                'audio_tokens' => 0,
                'reasoning_tokens' => 0,
                'accepted_prediction_tokens' => 12,
                'rejected_prediction_tokens' => 0,
            ],
            'total_tokens' => 21,
        ],
    ];
}

/**
 * @return array<string, mixed>
 */
function chatCompletionOpenRouter(): array
{
    return [
        'id' => 'gen-hPV4VUD2Jc8f59N2QPpK5n4834mR',
        'model' => 'google/gemma-7b-it:free',
        'choices' => [
            [
                'index' => 0,
                'message' => [
                    'role' => 'assistant',
                    'content' => 'Hello! How can I help you today?',
                ],
                'finish_reason' => 'stop',
            ],
        ],
        'usage' => [
            'prompt_tokens' => 13,
            'completion_tokens' => 20,
            'total_tokens' => 33,
        ],
        'created' => 1708000000,
    ];
}

/**
 * @return array<string, mixed>
 */
function chatCompletionOpenRouterOpenAI(): array
{
    return [
        'id' => 'gen-hPV4VUD2Jc8f59N2QPpK5n4834mR',
        'model' => 'openai/gpt-4-turbo-preview',
        'choices' => [
            [
                'index' => 0,
                'message' => [
                    'role' => 'assistant',
                    'content' => 'Hello! How can I help you today?',
                ],
                'finish_reason' => 'stop',
            ],
        ],
        'usage' => [
            'prompt_tokens' => 21,
            'prompt_tokens_details' => [
                'text_tokens' => 21,
            ],
            'completion_tokens' => 21,
            'completion_tokens_details' => [
                'reasoning_tokens' => 0,
                'accepted_prediction_tokens' => 21,
                'rejected_prediction_tokens' => 0,
            ],
            'total_tokens' => 42,
        ],
        'created' => 1708000000,
    ];
}

/**
 * @return array<string, mixed>
 */
function chatCompletionOpenRouterGoogle(): array
{
    return [
        'id' => 'gen-hPV4VUD2Jc8f59N2QPpK5n4834mR',
        'model' => 'google/gemini-pro',
        'choices' => [
            [
                'index' => 0,
                'message' => [
                    'role' => 'assistant',
                    'content' => 'Hello! How can I help you today?',
                ],
                'finish_reason' => 'stop',
            ],
        ],
        'usage' => [
            'prompt_tokens' => 10,
            'completion_tokens' => 138,
            'total_tokens' => 148,
        ],
        'created' => 1708000000,
    ];
}

/**
 * @return array<string, mixed>
 */
function chatCompletionOpenRouterXAI(): array
{
    return [
        'id' => 'gen-hPV4VUD2Jc8f59N2QPpK5n4834mR',
        'model' => 'xai/grok-1',
        'choices' => [
            [
                'index' => 0,
                'message' => [
                    'role' => 'assistant',
                    'content' => 'Hello! How can I help you today?',
                ],
                'finish_reason' => 'stop',
            ],
        ],
        'usage' => [
            'prompt_tokens' => 21,
            'prompt_tokens_details' => [
                'text_tokens' => 21,
            ],
            'completion_tokens' => 36,
            'completion_tokens_details' => [
                'reasoning_tokens' => 0,
                'accepted_prediction_tokens' => 36,
                'rejected_prediction_tokens' => 0,
            ],
            'total_tokens' => 392, // xAI returns strange total_tokens
        ],
        'created' => 1708000000,
    ];
}
