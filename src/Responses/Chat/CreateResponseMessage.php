<?php

declare(strict_types=1);

namespace OpenAI\Responses\Chat;

/**
 * @phpstan-import-type CreateResponseChoiceAudioType from CreateResponseChoiceAudio
 * @phpstan-import-type CreateResponseChoiceImageType from CreateResponseChoiceImage
 */
final class CreateResponseMessage
{
    /**
     * @param  array<int, CreateResponseToolCall>  $toolCalls
     * @param  array<int, CreateResponseChoiceAnnotations>  $annotations
     * @param  array<int, CreateResponseChoiceImage>|null  $images
     */
    private function __construct(
        public readonly string $role,
        public readonly ?string $content,
        public readonly array $annotations,
        public readonly array $toolCalls,
        public readonly ?CreateResponseFunctionCall $functionCall,
        public readonly ?CreateResponseChoiceAudio $audio = null,
        public readonly ?array $images = null,
    ) {}

    /**
     * @param  array{role: string, content: ?string, annotations?: array<int, array{type: string, url_citation: array{start_index: int, end_index: int, title: string, url: string}}>, function_call?: array{name: string, arguments: string}, tool_calls?: array<int, array{id: string, type: string, function: array{name: string, arguments: string}}>, audio?: CreateResponseChoiceAudioType, images?: array<int, CreateResponseChoiceImageType>}  $attributes
     */
    public static function from(array $attributes): self
    {
        $toolCalls = array_map(fn (array $result): CreateResponseToolCall => CreateResponseToolCall::from(
            $result
        ), $attributes['tool_calls'] ?? []);

        $annotations = array_map(fn (array $result): CreateResponseChoiceAnnotations => CreateResponseChoiceAnnotations::from(
            $result,
        ), $attributes['annotations'] ?? []);

        $images = isset($attributes['images'])
            ? array_map(fn (array $result): CreateResponseChoiceImage => CreateResponseChoiceImage::from($result), $attributes['images'])
            : null;

        return new self(
            role: $attributes['role'],
            content: $attributes['content'] ?? null,
            annotations: $annotations,
            toolCalls: $toolCalls,
            functionCall: isset($attributes['function_call']) ? CreateResponseFunctionCall::from($attributes['function_call']) : null,
            audio: isset($attributes['audio']) ? CreateResponseChoiceAudio::from($attributes['audio']) : null,
            images: $images,
        );
    }

    /**
     * @return array{role: string, content: string|null, annotations?: array<int, array{type: string, url_citation: array{start_index: int, end_index: int, title: string, url: string}}>, function_call?: array{name: string, arguments: string}, tool_calls?: array<int, array{id: string, type: string, function: array{name: string, arguments: string}}>, audio?: CreateResponseChoiceAudioType, images?: array<int, CreateResponseChoiceImageType>}
     */
    public function toArray(): array
    {
        $data = [
            'role' => $this->role,
            'content' => $this->content,
        ];

        if ($this->annotations !== []) {
            $data['annotations'] = array_map(fn (CreateResponseChoiceAnnotations $annotations): array => $annotations->toArray(), $this->annotations);
        }

        if ($this->functionCall instanceof CreateResponseFunctionCall) {
            $data['function_call'] = $this->functionCall->toArray();
        }

        if ($this->toolCalls !== []) {
            $data['tool_calls'] = array_map(fn (CreateResponseToolCall $toolCall): array => $toolCall->toArray(), $this->toolCalls);
        }

        if ($this->audio instanceof CreateResponseChoiceAudio) {
            $data['audio'] = $this->audio->toArray();
        }

        if ($this->images !== null && $this->images !== []) {
            $data['images'] = array_map(fn (CreateResponseChoiceImage $image): array => $image->toArray(), $this->images);
        }

        return $data;
    }
}
