# Changelog
All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](http://keepachangelog.com/)
and this project adheres to [Semantic Versioning](http://semver.org/).

## v0.2.1 (2022-11-09)
### Fixed
- FineTunes create response: `batch_size`, `learning_rate` and `fine_tuned_model` are nullable (#16)
- File responses: add missing fields `status` and `status_details`

## v0.2.0 (2022-11-07)
### Added
- Add `images()` resource to interact with [DALL-E](https://beta.openai.com/docs/api-reference/images)

### Fixed
- Parse completions create response with logprobs correctly

## v0.1.0 (2022-10-20)
### Added
- First version
