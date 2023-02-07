# Changelog
All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](http://keepachangelog.com/)
and this project adheres to [Semantic Versioning](http://semver.org/).

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
- Add `images()` resource to interact with [DALL-E](https://beta.openai.com/docs/api-reference/images)

### Fixed
- Parse completions create response with logprobs correctly

## v0.1.0 (2022-10-20)
### Added
- First version
