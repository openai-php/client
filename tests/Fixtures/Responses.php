<?php

/**
 * @return array<string, mixed>
 */
function createResponseResource(): array
{
    return [
        'id' => 'resp_67ccf18ef5fc8190b16dbee19bc54e5f087bb177ab789d5c',
        'background' => null,
        'object' => 'response',
        'created_at' => 1741484430,
        'status' => 'completed',
        'error' => null,
        'incomplete_details' => null,
        'instructions' => null,
        'max_tool_calls' => null,
        'max_output_tokens' => null,
        'metadata' => [],
        'model' => 'gpt-4o-2024-08-06',
        'output' => [
            outputAnnotationMessage(),
            outputWebSearchToolCall(),
            outputFileSearchToolCall(),
            outputComputerToolCall(),
            outputReasoning(),
            outputCodeInterpreterToolCall(),
        ],
        'parallel_tool_calls' => true,
        'previous_response_id' => null,
        'prompt' => null,
        'prompt_cache_key' => null,
        'safety_identifier' => null,
        'service_tier' => null,
        'reasoning' => [
            'effort' => null,
            'generate_summary' => null,
            'summary' => null,
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
            toolImageGeneration(),
            toolRemoteMcp(),
            toolConnectorMcp(),
        ],
        'top_logprobs' => null,
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
        'verbosity' => null,
    ];
}

function createResponseStoredPromptResource(): array
{
    return [
        'id' => 'resp_67ccf18ef5fc8190b16dbee19bc54e5f087bb177ab789d5c',
        'object' => 'response',
        'created_at' => 1741484430,
        'status' => 'completed',
        'error' => null,
        'incomplete_details' => null,
        'instructions' => [
            [
                'type' => 'message',
                'content' => [
                    [
                        'type' => 'input_text',
                        'text' => 'What is the weather in Tampa?',
                    ],
                ],
                'role' => 'system',
            ],
        ],
        'max_output_tokens' => null,
        'model' => 'gpt-4.1-nano-2025-04-14',
        'output' => [
            outputBasicMessage(),
        ],
        'outputText' => 'The weather in Tampa is sunny with a high of 85°F.',
        'prompt' => [
            'id' => 'prompt_67ccf18ef5fc8190b16dbee19bc54e5f087bb177ab789d5c',
            'variables' => [
                'city' => [
                    'type' => 'input_text',
                    'text' => 'Tampa',
                ],
            ],
            'version' => '1',
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
        'tools' => [],
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
        'background' => null,
        'object' => 'response',
        'created_at' => 1741484430,
        'status' => 'completed',
        'error' => null,
        'incomplete_details' => null,
        'instructions' => null,
        'max_tool_calls' => null,
        'max_output_tokens' => null,
        'metadata' => [],
        'model' => 'gpt-4o-2024-08-06',
        'output' => [
            outputWebSearchToolCall(),
            outputAnnotationMessage(),
        ],
        'output_text' => 'As of today, March 9, 2025, one notable positive news story...',
        'parallel_tool_calls' => true,
        'previous_response_id' => null,
        'prompt' => null,
        'prompt_cache_key' => null,
        'safety_identifier' => null,
        'service_tier' => null,
        'reasoning' => [
            'effort' => null,
            'generate_summary' => null,
            'summary' => null,
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
            toolImageGeneration(),
            toolRemoteMcp(),
            toolConnectorMcp(),
        ],
        'top_logprobs' => null,
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
        'verbosity' => null,
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
            outputBasicMessage(),
            outputAnnotationMessage(),
            outputMessageOnlyRefusal(),
            outputAnnotationMessage(),
            outputWebSearchToolCall(),
            outputFileSearchToolCall(),
            outputComputerToolCall(),
            outputReasoning(),
            outputCodeInterpreterToolCall(),
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
function outputMcpApprovalRequest(): array
{
    return [
        'id' => 'fs_67ccf18f64008190a39b619f4c8455ef087bb177ab789d5c',
        'server_label' => 'server-name',
        'type' => 'mcp_approval_request',
        'arguments' => '',
        'name' => 'Name',
    ];
}

/**
 * @return array<string, mixed>
 */
function outputMcpCall(): array
{
    return [
        'id' => 'fs_67ccf18f64008190a39b619f4c8455ef087bb177ab789d5c',
        'server_label' => 'server-name',
        'type' => 'mcp_call',
        'arguments' => '',
        'name' => 'Name',
        'approval_request_id' => null,
        'error' => null,
        'output' => null,
    ];
}

/**
 * @return array<string, mixed>
 */
function outputMcpErrorCallObject(): array
{
    return [
        'id' => 'mcp_67ccf18f64008190a39b619f4c8455ef087bb177ab789d5c',
        'type' => 'mcp_call',
        'approval_request_id' => null,
        'arguments' => json_encode(['topk' => 50]),
        'error' => [
            'type' => 'http_error',
            'code' => 401,
            'message' => 'Unauthorized',
        ],
        'name' => 'list_recent_files',
        'output' => null,
        'server_label' => 'Dropbox',
    ];
}

/**
 * @return array<string, mixed>
 */
function outputMcpErrorCallString(): array
{
    return [
        'id' => 'mcp_67ccf18f64008190a39b619f4c8455ef087bb177ab789d5c',
        'type' => 'mcp_call',
        'approval_request_id' => null,
        'arguments' => json_encode(['topk' => 50]),
        'error' => 'Missing or invalid authorization token.',
        'name' => 'list_recent_files',
        'output' => null,
        'server_label' => 'Dropbox',
    ];
}

/**
 * @return array<string, mixed>
 */
function outputMcpListTools(): array
{
    return [
        'id' => 'fs_67ccf18f64008190a39b619f4c8455ef087bb177ab789d5c',
        'server_label' => 'server-name',
        'type' => 'mcp_list_tools',
        'tools' => [],
    ];
}

/**
 * @return array<string, mixed>
 */
function outputMcpErrorCallToolExecution(): array
{
    return [
        'id' => 'mcp_68ae0539ede081a096e9cc4526aadc8200b5e200d643ebad',
        'type' => 'mcp_call',
        'approval_request_id' => null,
        'arguments' => '{"value":"test"}',
        'error' => [
            'type' => 'mcp_tool_execution_error',
            'content' => [
                [
                    'type' => 'text',
                    'text' => '[POST] "undefined": <no response> Invalid URL: undefined',
                    'annotations' => null,
                    'meta' => null,
                ],
            ],
        ],
        'name' => 'deploy-html',
        'output' => null,
        'server_label' => 'deploy-html',
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
function outputCodeInterpreterToolCall(): array
{
    return [
        'code' => 'print("Hello, World!")',
        'id' => 'ci_67ccf18f64008190a39b619f4c8455ef087bb177ab789d5c',
        'outputs' => [
            [
                'type' => 'logs',
                'logs' => 'Execution started.',
            ],
            [
                'type' => 'files',
                'files' => [
                    [
                        'file_id' => 'file_67ccf18f64008190a39b619f4c8455ef087bb177ab789d5c',
                        'mime_type' => 'text/plain',
                    ],
                ],
            ],
        ],
        'status' => 'completed',
        'type' => 'code_interpreter_call',
        'container_id' => 'container_67ccf18f64008190a39b619f4c8455ef087bb177ab789d5c',
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
function toolImageGeneration(): array
{
    return [
        'type' => 'image_generation',
        'background' => 'transparent',
        'input_image_mask' => null,
        'model' => 'gpt-image-1',
        'moderation' => 'auto',
        'output_compression' => 100,
        'output_format' => 'png',
        'partial_images' => 0,
        'quality' => 'auto',
        'size' => 'auto',
    ];
}

/**
 * @return array<string, mixed>
 */
function toolRemoteMcp(): array
{
    return [
        'type' => 'mcp',
        'server_label' => 'My test MCP server',
        'server_url' => 'https://server.example.com/mcp',
        'require_approval' => null,
        'allowed_tools' => null,
        'headers' => null,
        'connector_id' => null,
        'authorization' => null,
        'server_description' => null,
    ];
}

/**
 * @return array<string, mixed>
 */
function toolRemoveMcpRequireApproval(): array
{
    return [
        'type' => 'mcp',
        'server_label' => 'My test MCP server',
        'server_url' => 'https://server.example.com/mcp',
        'require_approval' => [
            'never' => [
                'read_only' => null,
                'tool_names' => ['ask_question', 'read_wiki_structure'],
            ],
            'always' => null,
        ],
        'allowed_tools' => null,
        'headers' => null,
        'server_description' => null,
    ];
}

/**
 * @return array<string, mixed>
 */
function toolConnectorMcp(): array
{
    return [
        'type' => 'mcp',
        'server_label' => 'Dropbox',
        'server_url' => null,
        'require_approval' => 'never',
        'allowed_tools' => null,
        'headers' => null,
        'connector_id' => 'connector_dropbox',
        'authorization' => '<redacted>',
        'server_description' => null,
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
 * @return array<string, mixed>
 */
function toolFileSearchNestedFilters(): array
{
    return [
        'type' => 'file_search',
        'filters' => [
            'type' => 'and',
            'filters' => [
                [
                    'type' => 'and',
                    'filters' => [
                        [
                            'type' => 'ne',
                            'key' => 'state',
                            'value' => 'ks',
                        ],
                        [
                            'type' => 'ne',
                            'key' => 'state',
                            'value' => 'mo',
                        ],
                    ],
                ],
            ],
        ],
        'max_num_results' => 5,
        'ranking_options' => [
            'ranker' => 'auto',
            'score_threshold' => 0.1,
        ],
        'vector_store_ids' => [
            'vector_store_id_1',
            'vector_store_id_2',
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
function responseImageGenerationStream()
{
    return fopen(__DIR__.'/Streams/ResponseImageGenerationCreate.txt', 'r');
}

/**
 * @return resource
 */
function responseCodeInterpreterStream()
{
    return fopen(__DIR__.'/Streams/ResponseCodeInterpreterCreate.txt', 'r');
}

/**
 * @return resource
 */
function responseCompletionSteamCreatedEvent()
{
    return fopen(__DIR__.'/Streams/ResponseCreatedResponse.txt', 'r');
}
