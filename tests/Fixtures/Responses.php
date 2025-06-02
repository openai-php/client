<?php

/**
 * @return array<string, mixed>
 */
function createResponseResource(): array
{
    return [
        'id' => 'resp_67ccf18ef5fc8190b16dbee19bc54e5f087bb177ab789d5c',
        'object' => 'response',
        'created_at' => 1741484430,
        'status' => 'completed',
        'error' => null,
        'incomplete_details' => null,
        'instructions' => null,
        'max_output_tokens' => null,
        'metadata' => [],
        'model' => 'gpt-4o-2024-08-06',
        'output' => [
            outputAnnotationMessage(),
            outputWebSearchToolCall(),
            outputFileSearchToolCall(),
            outputComputerToolCall(),
            outputReasoning(),
        ],
        'parallel_tool_calls' => true,
        'previous_response_id' => null,
        'reasoning' => [
            'effort' => null,
            'generate_summary' => null,
        ],
        'store' => true,
        'temperature' => 1.0,
        'text' => [
            'format' => [
                'type' => 'text',
            ],
        ],
        'tool_choice' => 'auto',
        'tools' => [
            toolWebSearchPreview(),
            toolFileSearch(),
        ],
        'top_p' => 1.0,
        'truncation' => 'disabled',
        'usage' => [
            'input_tokens' => 328,
            'input_tokens_details' => [
                'cached_tokens' => 0,
            ],
            'output_tokens' => 356,
            'output_tokens_details' => [
                'reasoning_tokens' => 0,
            ],
            'total_tokens' => 684,
        ],
        'user' => null,
    ];
}

/**
 * @return array<string, mixed>
 */
function retrieveResponseResource(): array
{
    return [
        'id' => 'resp_67ccf18ef5fc8190b16dbee19bc54e5f087bb177ab789d5c',
        'object' => 'response',
        'created_at' => 1741484430,
        'status' => 'completed',
        'error' => null,
        'incomplete_details' => null,
        'instructions' => null,
        'max_output_tokens' => null,
        'metadata' => [],
        'model' => 'gpt-4o-2024-08-06',
        'output' => [
            outputWebSearchToolCall(),
            outputAnnotationMessage(),
        ],
        'parallel_tool_calls' => true,
        'previous_response_id' => null,
        'reasoning' => [
            'effort' => null,
            'generate_summary' => null,
        ],
        'store' => true,
        'temperature' => 1.0,
        'text' => [
            'format' => [
                'type' => 'text',
            ],
        ],
        'tool_choice' => 'auto',
        'tools' => [
            toolWebSearchPreview(),
            toolFileSearch(),
        ],
        'top_p' => 1.0,
        'truncation' => 'disabled',
        'usage' => [
            'input_tokens' => 328,
            'input_tokens_details' => [
                'cached_tokens' => 0,
            ],
            'output_tokens' => 356,
            'output_tokens_details' => [
                'reasoning_tokens' => 0,
            ],
            'total_tokens' => 684,
        ],
        'user' => null,
    ];
}

/**
 * @return array<string, mixed>
 */
function listInputItemsResource(): array
{
    return [
        'object' => 'list',
        'data' => [
            inputMessage(),
        ],
        'first_id' => 'msg_67ccf190ca3881909d433c50b1f6357e087bb177ab789d5c',
        'last_id' => 'msg_67ccf190ca3881909d433c50b1f6357e087bb177ab789d5c',
        'has_more' => false,
    ];
}

/**
 * @return array<string, mixed>
 */
function deleteResponseResource(): array
{
    return [
        'id' => 'resp_67ccf18ef5fc8190b16dbee19bc54e5f087bb177ab789d5c',
        'object' => 'response.deleted',
        'deleted' => true,
    ];
}

/**
 * @return array<string, mixed>
 */
function inputMessage(): array
{
    return [
        'content' => [
            [
                'text' => 'What was a positive news story from today?',
                'type' => 'input_text',
            ],
        ],
        'id' => 'msg_67ccf190ca3881909d433c50b1f6357e087bb177ab789d5c',
        'role' => 'user',
        'status' => 'completed',
        'type' => 'message',
    ];
}

/**
 * @return array<string, mixed>
 */
function outputFileSearchToolCall(): array
{
    return [
        'id' => 'fs_67ccf18f64008190a39b619f4c8455ef087bb177ab789d5c',
        'queries' => [
            'map',
            'kansas',
        ],
        'status' => 'completed',
        'type' => 'file_search_call',
        'results' => [
            [
                'attributes' => [
                    'foo' => 'bar',
                ],
                'file_id' => 'file_67ccf18f64008190a39b619f4c8455ef087bb177ab789d5c',
                'filename' => 'kansas_map.geojson',
                'score' => 0.98882,
                'text' => 'Map of Kansas',
            ],
        ],
    ];
}

/**
 * @return array<string, mixed>
 */
function outputComputerToolCall(): array
{
    return [
        'type' => 'computer_call',
        'call_id' => 'call_67ccf18f64008190a39b619f4c8455ef087bb177ab789d5c',
        'id' => 'cu_67ccf18f64008190a39b619f4c8455ef087bb177ab789d5c',
        'action' => [
            'button' => 'left',
            'type' => 'click',
            'x' => 117,
            'y' => 123,
        ],
        'pending_safety_checks' => [
            [
                'code' => 'malicious_instructions',
                'id' => 'cu_sc_67ccf18f64008190a39b619f4c8455ef087bb177ab789d5c',
                'message' => 'Safety check message',
            ],
        ],
        'status' => 'completed',
    ];
}

/**
 * @return array<string, mixed>
 */
function outputWebSearchToolCall(): array
{
    return [
        'id' => 'ws_67ccf18f64008190a39b619f4c8455ef087bb177ab789d5c',
        'status' => 'completed',
        'type' => 'web_search_call',
    ];
}

/**
 * @return array<string, mixed>
 */
function outputReasoning(): array
{
    return [
        'id' => 'rs_67ccf190ca3881909d433c50b1f6357e087bb177ab789d5c',
        'summary' => [
            [
                'text' => 'A summary of the reasoning process.',
                'type' => 'summary_text',
            ],
        ],
        'type' => 'reasoning',
        'encrypted_content' => 'aabbccddeeff',
        'status' => 'completed',
    ];
}

/**
 * @return array<string, mixed>
 */
function outputBasicMessage(): array
{
    return [
        'content' => [
            [
                'annotations' => [],
                'text' => 'This is a basic message.',
                'type' => 'output_text',
            ],
        ],
        'id' => 'msg_67ccf190ca3881909d433c50b1f6357e087bb177ab789d5c',
        'role' => 'assistant',
        'status' => 'completed',
        'type' => 'message',
    ];
}

/**
 * @return array<string, mixed>
 */
function outputAnnotationMessage(): array
{
    return [
        'content' => [
            [
                'annotations' => [
                    [
                        'end_index' => 557,
                        'start_index' => 442,
                        'title' => '...',
                        'type' => 'url_citation',
                        'url' => 'https://.../?utm_source=chatgpt.com',
                    ],
                    [
                        'end_index' => 1077,
                        'start_index' => 962,
                        'title' => '...',
                        'type' => 'url_citation',
                        'url' => 'https://.../?utm_source=chatgpt.com',
                    ],
                    [
                        'end_index' => 1451,
                        'start_index' => 1336,
                        'title' => '...',
                        'type' => 'url_citation',
                        'url' => 'https://.../?utm_source=chatgpt.com',
                    ],
                ],
                'text' => 'As of today, March 9, 2025, one notable positive news story...',
                'type' => 'output_text',
            ],
            [
                'refusal' => 'The assistant refused to answer.',
                'type' => 'refusal',
            ],
        ],
        'id' => 'msg_67ccf190ca3881909d433c50b1f6357e087bb177ab789d5c',
        'role' => 'assistant',
        'status' => 'completed',
        'type' => 'message',
    ];
}

/**
 * @return array<string, mixed>
 */
function outputMessageOnlyRefusal(): array
{
    return [
        'content' => [
            [
                'refusal' => 'The assistant refused to answer.',
                'type' => 'refusal',
            ],
        ],
        'id' => 'msg_67ccf190ca3881909d433c50b1f6357e087bb177ab789d5c',
        'role' => 'assistant',
        'status' => 'completed',
        'type' => 'message',
    ];
}

/**
 * @return array<string, mixed>
 */
function toolWebSearchPreview(): array
{
    return [
        'type' => 'web_search_preview',
        'search_context_size' => 'medium',
        'user_location' => [
            'type' => 'approximate',
            'city' => 'San Francisco',
            'country' => 'US',
            'region' => 'California',
            'timezone' => 'America/Los_Angeles',
        ],
    ];
}

/**
 * @return array<string, mixed>
 */
function toolFileSearch(): array
{
    return [
        'type' => 'file_search',
        'vector_store_ids' => [
            'vector_store_id_1',
            'vector_store_id_2',
        ],
        'filters' => [
            'key' => 'search-term',
            'type' => 'eq',
            'value' => 'search-term-value',
        ],
        'max_num_results' => 5,
        'ranking_options' => [
            'ranker' => 'bm25',
            'score_threshold' => 0.5,
        ],
    ];
}

/**
 * @return resource
 */
function responseCompletionStream()
{
    return fopen(__DIR__.'/Streams/ResponseCompletionCreate.txt', 'r');
}

/**
 * @return resource
 */
function responseCompletionSteamCreatedEvent()
{
    return fopen(__DIR__.'/Streams/ResponseCreatedResponse.txt', 'r');
}
