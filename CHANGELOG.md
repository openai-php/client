# Changelog
All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](http://keepachangelog.com/)
and this project adheres to [Semantic Versioning](http://semver.org/).

## v0.8.1 (2023-12-22)
### Added
-  Add support for Assistants and Threads endpoint ([#271](https://github.com/openai-php/client/pull/271))
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
- Stream suppport ([#84](https://github.com/openai-php/client/pull/84))

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
