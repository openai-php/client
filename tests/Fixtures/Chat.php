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
function chatCompletionWithAnnotations(): array
{
    return [
        'id' => 'chatcmpl-123',
        'object' => 'chat.completion',
        'created' => 1677652288,
        'model' => 'gpt-4o-mini-search-preview',
        'choices' => [
            [
                'index' => 0,
                'message' => [
                    'role' => 'assistant',
                    'content' => 'Hello World',
                    'annotations' => [
                        [
                            'type' => 'url_citation',
                            'url_citation' => [
                                'end_index' => 5,
                                'start_index' => 0,
                                'title' => 'Hello',
                                'url' => 'https://example.com',
                            ],
                        ],
                    ],
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

function chatCompletionWithCitations(): array
{
    return [
        "id" => "80a3200c-98d0-4d29-97d0-4766130d7e4d",
        "object" => "chat.completion",
        "created" => 1746182677,
        "model" => "sonar",
        "citations" => [
            "https://hennessey.com/seo/technical/what-are-the-benefits-of-technical-seo/",
            "https://www.cloudflare.com/learning/performance/how-website-speed-boosts-seo/",
            "https://www.semrush.com/blog/technical-seo/",
            "https://thriveagency.com/news/mastering-technical-seo-for-website-performance/",
            "https://elearninginfographics.com/the-importance-of-prioritizing-technical-seo-for-improved-website-performance/"
        ],
        "choices" => [
            [
                "index" => 0,
                "message" => [
                    "role" => "assistant",
                    "content" => "Technical SEO plays a crucial role in boosting website performance by enhancing various aspects that contribute to better search engine rankings and user experience. Here's how technical SEO impacts website performance, based on expert insights and case studies:\n\n## Key Benefits of Technical SEO\n\n1. **Website Speed**: Technical SEO improves site speed, which is a critical factor for both user experience and search engine rankings. Faster websites retain visitors, reduce bounce rates, and improve the chances of higher rankings in search results[2][5]. Techniques like compressing images, using Content Delivery Networks (CDNs), and minifying code can enhance speed[5].\n\n2. **Mobile Compatibility**: Ensuring that a website is mobile-friendly is vital, as Google prioritizes mobile-first indexing. Technical SEO helps websites adapt to mobile screens, providing a seamless experience across devices[1][5].\n\n3. **Crawlability and Indexing**: Technical SEO optimizes crawlability and indexing by guiding search engine bots through the site more efficiently. This involves creating XML sitemaps, using proper URL structures, and implementing canonical tags to ensure that content is indexed correctly, leading to better search engine visibility[3][5].\n\n4. **Security and Navigation**: Technical SEO also emphasizes website security and navigation. Ensuring that a site is secure (HTTPS) and easy to navigate improves user trust and engagement, which can positively influence search engine rankings[1][5].\n\n## Expert Views\n\nExperts generally agree that technical SEO is essential for maintaining high website performance. It not only ensures that search engines can crawl and index content effectively but also enhances the overall user experience, which is crucial for converting traffic into leads and customers[1][3]. \n\n## Case Studies\n\nWhile specific case studies are not provided in the search results, it is common for businesses to see significant improvements in organic traffic and user engagement when they implement comprehensive technical SEO strategies. Improvements in website speed, mobile compatibility, and crawlability typically lead to increased visibility in search results and better user retention rates.\n\nIn summary, technical SEO is indispensable for boosting website performance by optimizing for search engines and enhancing user experience, which are both critical factors in achieving higher search engine rankings and driving organic traffic."
                ],
                'logprobs' => null,
                'finish_reason' => null,
            ]
        ],
        "usage" => [
            "prompt_tokens" => 15,
            "completion_tokens" => 438,
            "total_tokens" => 453,
            "search_context_size" => "low"
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
    return fopen(__DIR__ . '/Streams/ChatCompletionCreate.txt', 'r');
}

/**
 * @return resource
 */
function chatCompletionStreamPing()
{
    return fopen(__DIR__ . '/Streams/ChatCompletionPing.txt', 'r');
}

/**
 * @return resource
 */
function chatCompletionStreamError()
{
    return fopen(__DIR__ . '/Streams/ChatCompletionCreateError.txt', 'r');
}
