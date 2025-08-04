# Changelog
All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/)
and this project adheres to [Semantic Versioning](https://semver.org/).

## v0.15.0 (2025-08-04)
### Added

* Add `updateAttributes` method to `VectorStoresFiles` ([#626](https://github.com/openai-php/client/pull/626))
* Add support for chat completion audio modality ([#629](https://github.com/openai-php/client/pull/629))
* Add `Containers` API ([#636](https://github.com/openai-php/client/pull/636))
* Add `model` field to `CreateResponse` for embeddings ([#634](https://github.com/openai-php/client/pull/634))

### Fixed

* Fix streamed response tool call without arguments in VLLM ([#623](https://github.com/openai-php/client/pull/623))
* Fix support for `code_interpreter_call` on retrieve response ([#632](https://github.com/openai-php/client/pull/632))
* Fix JSON encoding to preserve UTF-8 characters using `JSON_UNESCAPED_UNICODE` ([#628](https://github.com/openai-php/client/pull/628))

## v0.14.0 (2025-06-24)
### Added
- Add helper method `output_text` to Responses API ([#579](https://github.com/openai-php/client/pull/579))
- Add support for response cancel in Responses API ([#588](https://github.com/openai-php/client/pull/588))
- Add support for Image Generation Tool to Responses API ([#594](https://github.com/openai-php/client/pull/594))
- Add streaming for Image Generation in Responses API ([#602](https://github.com/openai-php/client/pull/602))
- Add support for Code Interpreter to Responses API ([#610](https://github.com/openai-php/client/pull/610))
- Add support for Remote MCP Tool in Responses API ([#601](https://github.com/openai-php/client/pull/601))
- Add realtime ephemeral tokens ([#591](https://github.com/openai-php/client/pull/591))
- Add streaming support for Audio transcriptions ([#603](https://github.com/openai-php/client/pull/603))
- Add realtime key documentation ([#597](https://github.com/openai-php/client/pull/597))

### Fixed
- Add missing `index` to `CreateStreamedResponseToolCall` ([#562](https://github.com/openai-php/client/pull/562))
- Make `$parameters` optional in thread `create()` method ([#577](https://github.com/openai-php/client/pull/577))
- Support Azure `model.list` endpoint ([#599](https://github.com/openai-php/client/pull/599))
- Add `reasoning_effort` support to Assistants ([#606](https://github.com/openai-php/client/pull/606))
- Use proper parameter order in `Response` constructor ([#615](https://github.com/openai-php/client/pull/615))
- Support reused prompts/instructions in Responses API ([#616](https://github.com/openai-php/client/pull/616))

### Changed
- Use proper header notation for Responses API docs ([#596](https://github.com/openai-php/client/pull/596))
- Collapse legacy/deprecated sections by default in docs ([#609](https://github.com/openai-php/client/pull/609))

### Deprecated
- mark Assistants API as deprecated ([#607](https://github.com/openai-php/client/pull/607))
- mark Completions API as legacy ([#608](https://github.com/openai-php/client/pull/608))

## v0.13.0 (2025-05-14)
### Added
- Add support for Responses API ([#541](https://github.com/openai-php/client/pull/541))

### Fixed
- Add Throwable type support to ClientFake responses ([#576](https://github.com/openai-php/client/pull/576))

## v0.12.0 (2025-05-04)
### Changed
- Removed PHP 8.1 support

## v0.11.0 (2025-05-04)
### Added
- Add logprobs to Chat Response ([#533](https://github.com/openai-php/client/pull/533))
- Add ResponseHasMetaInformationContract contract to ThreadRunStepResponse ([#523](https://github.com/openai-php/client/pull/523))
- Add support for 'attributes' on vector store files ([#551](https://github.com/openai-php/client/pull/551))
- Add OpenAI compatibility support for Google Gemini ([#502](https://github.com/openai-php/client/pull/502))
- Add compatibility for Aliyun LLM APIs ([#530](https://github.com/openai-php/client/pull/530))
- Add ability to pass arguments to files list request ([#557](https://github.com/openai-php/client/pull/557))
- Add search vector store functionality ([#559](https://github.com/openai-php/client/pull/559))
- Add Image Response usage ([#571](https://github.com/openai-php/client/pull/571))
- Add category applied input types to moderation response ([#572](https://github.com/openai-php/client/pull/572))
- Add support for annotations in Chat response (Web Search) ([#564](https://github.com/openai-php/client/pull/564))
- Add test coverage for assistants streaming and related functionality ([#444](https://github.com/openai-php/client/pull/444))

### Changed
- Update GitHub Action deprecations & opt into Dependabot ([#544](https://github.com/openai-php/client/pull/544))
- Draw attention away from deprecated completions endpoints in docs ([#548](https://github.com/openai-php/client/pull/548))

### Fixed
- Fix type definition for responses in ClientFake::addResponses method ([#382](https://github.com/openai-php/client/pull/382))
- Fix Content retrieval in HttpTransport with custom HttpClient ([#343](https://github.com/openai-php/client/pull/343))
- Fix correct completion endpoint when logprobs missing ([#550](https://github.com/openai-php/client/pull/550))
- Fix chat completion choices to allow responses without logprobs field ([#554](https://github.com/openai-php/client/pull/554))
- Fix support for streaming of non-OpenAI models that return "ping" ([#556](https://github.com/openai-php/client/pull/556))
- Fix OpenRouter token usage response ([#560](https://github.com/openai-php/client/pull/560))
- Fix Gemini list models ([#567](https://github.com/openai-php/client/pull/567))

## v0.10.3 (2024-11-12)
### Added
- Add http status to ErrorException ([#487](https://github.com/openai-php/client/pull/487))
- Add `cached_usage` to CreateResponseUsage for Chat ([#494](https://github.com/openai-php/client/pull/494))
- Add moderation categories (Illicit*) ([#495](https://github.com/openai-php/client/pull/495))

### Fixed
- Fix missing parameters on FineTuning RetrieveJobResponse ([#496](https://github.com/openai-php/client/pull/496))
- Fix nullable description on Assistants Tool Function ([#484](https://github.com/openai-php/client/pull/484))
- Fix attachment key missing on ThreadMessageResponse ([#471](https://github.com/openai-php/client/pull/471))

## v0.10.2 (2024-10-17)
### Added
- Add `thread.run.incomplete` to ThreadRunStreamResponse ([#421](https://github.com/openai-php/client/pull/421))
- Add `withProject` to configure the project for the client ([#377](https://github.com/openai-php/client/pull/377))
- Add fake `b64_json` to support mocking ([#462](https://github.com/openai-php/client/pull/462))

### Fixed
- Fix image url content type to use `url` instead of `file_id` ([#422](https://github.com/openai-php/client/pull/422))
- Fix type error on VectorStoresFilesTestResources ([#460](https://github.com/openai-php/client/pull/460))
- Fix vector store cancel method ([#435](https://github.com/openai-php/client/pull/435))

## v0.10.1 (2024-06-06)
### Added
-  Add support for Assistants API v2 and Vector Stores endpoints ([#420](https://github.com/openai-php/client/pull/420))

### Docs
-  Add vector store endpoints documentation ([#420](https://github.com/openai-php/client/pull/420))

## v0.10.0-beta.1 (2024-05-27)
### Added
-  Add support for Assistants API v2 and Vector Stores endpoint ([#405](https://github.com/openai-php/client/pull/405))

## v0.9.2 (2024-05-27)
### Added
- Support for usage stream option on chat endpoint ([#398](https://github.com/openai-php/client/pull/398))

### Fixed
- Missing output parameter on streamed code interpreter output ([#406](https://github.com/openai-php/client/pull/406))

## v0.9.1 (2024-05-24)
### Added
- Add support for Batches endpoint ([#403](https://github.com/openai-php/client/pull/403))

## v0.9.0 (2024-05-21)
### Added
- Assistants: add streaming support ([#367](https://github.com/openai-php/client/pull/367))

## v0.8.5 (2024-04-15)
### Added
- Audio: add support for timestamp_granularities ([#374](https://github.com/openai-php/client/pull/374))

## v0.8.4 (2024-02-07)
### Fixed
- Fix default fake data for meta information ([#332](https://github.com/openai-php/client/pull/332))

## v0.8.3 (2024-02-02)
### Added
- ThreadRun: Add "usage" property to the response ([#330](https://github.com/openai-php/client/pull/330))

## v0.8.2 (2024-01-26)
### Fixed
- ThreadRunStep: "content" missing in response if result has not been submitted ([#319](https://github.com/openai-php/client/pull/319))
- Files: "bytes" in retrieve response is may null ([#325](https://github.com/openai-php/client/pull/325))

## v0.8.1 (2023-12-22)
### Added
- Add support for Assistants and Threads endpoint ([#271](https://github.com/openai-php/client/pull/271))
- Add stream support for Text To Speech ([#235](https://github.com/openai-php/client/pull/235))
- Add test resources for Assistants and Threads  ([#279](https://github.com/openai-php/client/pull/279))

### Changed
- Remove thread messages delete endpoint ([#309](https://github.com/openai-php/client/pull/309))

### Fixed
- Handle x-request-id in meta information ([#283](https://github.com/openai-php/client/pull/283))
- Handle meta information from azure headers ([#307](https://github.com/openai-php/client/pull/307))
- Add missing default system_fingerprint to chat create response fixture ([#308](https://github.com/openai-php/client/pull/308))
- Convert headers to lower case before creation meta information ([#306](https://github.com/openai-php/client/pull/306))

### Docs
- Remove threads list endpoint from README.md ([#275](https://github.com/openai-php/client/pull/275))
- Clarify assistants files docs ([#278](https://github.com/openai-php/client/pull/278))
- Fix image creation example ([#297](https://github.com/openai-php/client/pull/297))
- Fix outdated links ([#299](https://github.com/openai-php/client/pull/299))
- Add troubleshooting section and explain how to configure HTTP client timeouts

## v0.8.0 (2023-11-23)
### Added
-  Add support for Assistants and Threads endpoint ([#271](https://github.com/openai-php/client/pull/271))

## v0.8.0-beta.3 (2023-11-23)
### Removed
-  Remove `list()` from Threads resource

## v0.8.0-beta.2 (2023-11-14)
### Fixed
-  instruction on ThreadRunResponse may be nullable

## v0.7.10 (2023-11-14)
### Added
-  Add RetrieveJobResponseError and batch_size, learning_rate_multiplier parameters on RetrieveJobResponseHyperparameters for fine-tuning endpoint ([#255](https://github.com/openai-php/client/pull/255))

## v0.7.9 (2023-11-14)
### Added
-  Add revised_prompt property to CreateResponseData on the image create endpoint ([#257](https://github.com/openai-php/client/pull/257))

### Docs
- Fix model in one of the examples

## v0.8.0-beta.1 (2023-11-13)
### Added
-  Add support for Assistants and Threads endpoint ([#243](https://github.com/openai-php/client/pull/243))

## v0.7.8 (2023-11-07)
### Added
-  Add support for GTP-4 vision on the chat completion endpoint ([#241](https://github.com/openai-php/client/pull/241))

## v0.7.7 (2023-11-07)
### Added
-  Add support for tool calls on the chat completion endpoint ([#239](https://github.com/openai-php/client/pull/239))

## v0.7.6 (2023-11-06)
### Added
-  Add support for the audio speech endpoint ([#237](https://github.com/openai-php/client/pull/237))

## v0.7.5 (2023-11-06)
### Changed
- Update Models endpoint response object to the latest API changes ([#235](https://github.com/openai-php/client/pull/235))

### Docs
- Update FineTuning job id names ([#230](https://github.com/openai-php/client/pull/230))
- Use Chat resource as the primary example

## v0.7.4 (2023-10-21)
### Fixed
- nEpochs on RetrieveJobResponseHyperparameters may be string
- processingMs ond MetaInformationOpenAI may be null ([#218](https://github.com/openai-php/client/pull/218))

## v0.7.3 (2023-09-08)
### Added
- Add "has_more" to fine-tuning jobs and events list responses ([#206](https://github.com/openai-php/client/pull/206))

### Changed
- Add parameters to the fine-tuning jobs list request to filter the results ([#206](https://github.com/openai-php/client/pull/206))

### Fixed
- error_code may be int

## v0.7.2 (2023-08-31)
### Fixed
- Missing openai-version header from Azure

## v0.7.1 (2023-08-29)
### Fixed
- Typo in class name MetaInformationOpenAI

## v0.7.0 (2023-08-29)
### Added
- Add support for the fine-tuning API ([#199](https://github.com/openai-php/client/pull/199))
- Provide access to header / meta information for all responses ([#195](https://github.com/openai-php/client/pull/195))

### Changed
- Mark `FineTunes` resource as deprecated
- Mark `Edits` resource as deprecated
- Add missing moderation enums ([#178](https://github.com/openai-php/client/pull/178))

### Fixed
- Chat completion create response with function calling on Azure ([#184](https://github.com/openai-php/client/pull/184))
- Breaking change on OpenAI API regarding "transient" field in Audio translations ([#168](https://github.com/openai-php/client/pull/168))
- Docs: fix OpenAI URL

## v0.6.3 (2023-07-07)
### Fixed
- Breaking change on OpenAI API regarding "transient" field in Audio ([#160](https://github.com/openai-php/client/pull/160))

## v0.6.2 (2023-06-23)
### Changed
- Error handling: use error code as exception message if error message is empty ([#150](https://github.com/openai-php/client/pull/150))

### Fixed
- Error handling: Catch error in stream responses ([#150](https://github.com/openai-php/client/pull/150))
- Error handling: Handle errors where message is an array ([#150](https://github.com/openai-php/client/pull/150))

## v0.6.1 (2023-06-15)
### Fixed
- Chat/CreateResponse faking with function_call ([#145](https://github.com/openai-php/client/issues/145))

## v0.6.0 (2023-06-14)
### Added
- Add support for function calling in the Chat Completions API ([#144](https://github.com/openai-php/client/issues/144))

## v0.5.3 (2023-06-07)
### Fixed
- Exception handling for server error with non default content type header ([#134](https://github.com/openai-php/client/issues/134))
- Faking embedding responses for multidimensional vectors ([#131](https://github.com/openai-php/client/issues/131))

## v0.5.2 (2023-05-27)
### Added
- Add support for psr/http-message ^2.0 ([#130](https://github.com/openai-php/client/issues/130))

## v0.5.1 (2023-05-24)
### Fixed
- fix: stream broken after checking for errors (regression of [#113](https://github.com/openai-php/client/pull/113))

## v0.5.0 (2023-05-24)
### Added
- Support for HTTP base uri ([#106](https://github.com/openai-php/client/pull/106))

### Changed
- unify exception handling between HTTP client implementations ([#113](https://github.com/openai-php/client/pull/113))

### Fixed
- fix toArray() on `CreateStreamedResponseDelta` to match the original API response  ([#108](https://github.com/openai-php/client/pull/108))

### Docs
- explain usage for "OpenAI on Azure" ([#109](https://github.com/openai-php/client/pull/109))

## v0.4.2 (2023-04-12)
### Added
- Testing support ([#71](https://github.com/openai-php/client/pull/71))

### Changed
- Trim ApiKey before sending it to the API ([#101](https://github.com/openai-php/client/pull/101))

### Fixed
- Nullable fields on error response  ([#102](https://github.com/openai-php/client/pull/102))

## v0.4.1 (2023-03-24)
### Added
- Stream support ([#84](https://github.com/openai-php/client/pull/84))

## v0.4.0 (2023-03-17)
### Changed
- Removed dependency for `guzzlehttp/guzzle` and use PSR-18 client discovery instead ([#75](https://github.com/openai-php/client/pull/75))
- Add Client factory which allows for a custom HTTP client
- Client factory further accepts custom HTTP headers, query parameters and API URI

## v0.3.5 (2023-03-08)
### Fixed
- `status_details` can be a string in file responses. Affects Files and FineTunes resources ([#68](https://github.com/openai-php/client/pull/68))

## v0.3.4 (2023-03-03)
### Added
- `Audio` resource to turn audio into text powered by `whisper-1` ([#62](https://github.com/openai-php/client/pull/62))

## v0.3.3 (2023-03-02)
### Added
- `Chat` resource aka ChatGPT powered by `gpt-3.5-turbo` ([#60](https://github.com/openai-php/client/pull/60))

## v0.3.2 (2023-02-28)
### Fixed
- Nullable `finish_reason` on Completions `CreateResponse` ([#52](https://github.com/openai-php/client/pull/52), [545e0ab](https://github.com/openai-php/client/commit/545e0aba106fb0c60a86c2918f5209940b6dd26f))

## v0.3.1 (2023-02-07)
### Fixed
- Missing `events` on FineTunes `RetrieveResponse` ([#41](https://github.com/openai-php/client/pull/41))

## v0.3.0 (2023-01-03)
### Changed
- `OpenAI::client()` first argument changed from `apiToken` to `apiKey` ([#25](https://github.com/openai-php/client/pull/25))

### Fixed
- Getting contents from Guzzle's response causing issues with middleware ([#33](https://github.com/openai-php/client/pull/33))

## v0.2.1 (2022-11-09)
### Fixed
- FineTunes create response: `batch_size`, `learning_rate` and `fine_tuned_model` are nullable ([#16](https://github.com/openai-php/client/issues/16))
- File responses: add missing fields `status` and `status_details`

## v0.2.0 (2022-11-07)
### Added
- Add `images()` resource to interact with [DALL-E](https://platform.openai.com/docs/api-reference/images)

### Fixed
- Parse completions create response with logprobs correctly

## v0.1.0 (2022-10-20)
### Added
- First version
