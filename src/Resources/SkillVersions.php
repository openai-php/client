<?php

declare(strict_types=1);

namespace OpenAI\Resources;

use OpenAI\Contracts\Resources\SkillVersionsContract;
use OpenAI\Responses\Skills\Versions\SkillVersionDeleteResponse;
use OpenAI\Responses\Skills\Versions\SkillVersionListResponse;
use OpenAI\Responses\Skills\Versions\SkillVersionResponse;
use OpenAI\ValueObjects\Transporter\Payload;
use OpenAI\ValueObjects\Transporter\Response;

/**
 * @phpstan-import-type SkillVersionType from SkillVersionResponse
 * @phpstan-import-type SkillVersionListType from SkillVersionListResponse
 * @phpstan-import-type SkillVersionDeleteType from SkillVersionDeleteResponse
 */
final class SkillVersions implements SkillVersionsContract
{
    use Concerns\Transportable;

    /**
     * Create a new immutable skill version.
     *
     * @see https://developers.openai.com/api/reference/resources/skills/subresources/versions/methods/create
     *
     * @param  array<string, mixed>  $parameters
     */
    public function create(string $skillId, array $parameters): SkillVersionResponse
    {
        $payload = Payload::upload("skills/$skillId/versions", $parameters);

        /** @var Response<SkillVersionType> $response */
        $response = $this->transporter->requestObject($payload);

        return SkillVersionResponse::from($response->data(), $response->meta());
    }

    /**
     * List skill versions for a skill.
     *
     * @see https://developers.openai.com/api/reference/resources/skills/subresources/versions/methods/list
     *
     * @param  array<string, mixed>  $parameters
     */
    public function list(string $skillId, array $parameters = []): SkillVersionListResponse
    {
        $payload = Payload::list("skills/$skillId/versions", $parameters);

        /** @var Response<SkillVersionListType> $response */
        $response = $this->transporter->requestObject($payload);

        return SkillVersionListResponse::from($response->data(), $response->meta());
    }

    /**
     * Get a specific skill version.
     *
     * @see https://developers.openai.com/api/reference/resources/skills/subresources/versions/methods/retrieve
     */
    public function retrieve(string $skillId, string $version): SkillVersionResponse
    {
        $payload = Payload::retrieve("skills/$skillId/versions", $version);

        /** @var Response<SkillVersionType> $response */
        $response = $this->transporter->requestObject($payload);

        return SkillVersionResponse::from($response->data(), $response->meta());
    }

    /**
     * Download a skill version zip bundle.
     *
     * @see https://developers.openai.com/api/reference/resources/skills/subresources/versions/subresources/content/methods/retrieve
     */
    public function content(string $skillId, string $version): string
    {
        $payload = Payload::retrieveContent("skills/$skillId/versions", $version);

        return $this->transporter->requestContent($payload, requireSuccess: true);
    }

    /**
     * Delete a skill version.
     *
     * @see https://developers.openai.com/api/reference/resources/skills/subresources/versions/methods/delete
     */
    public function delete(string $skillId, string $version): SkillVersionDeleteResponse
    {
        $payload = Payload::delete("skills/$skillId/versions", $version);

        /** @var Response<SkillVersionDeleteType> $response */
        $response = $this->transporter->requestObject($payload);

        return SkillVersionDeleteResponse::from($response->data(), $response->meta());
    }
}
