<?php

declare(strict_types=1);

namespace OpenAI\ValueObjects\Transporter;

use Http\Discovery\Psr17Factory;
use Http\Message\MultipartStream\MultipartStreamBuilder;
use OpenAI\Contracts\Request;
use OpenAI\Enums\Transporter\ContentType;
use OpenAI\Enums\Transporter\Method;
use OpenAI\ValueObjects\ResourceUri;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\StreamInterface;

/**
 * @internal
 */
final class Payload
{
    /**
     * Creates a new Request value object.
     *
     * @param  array<string, mixed>  $parameters
     */
    private function __construct(
        private readonly ContentType $contentType,
        private readonly Method $method,
        private readonly ResourceUri $uri,
        private readonly array $parameters = [],
    ) {
        // ..
    }

    /**
     * Creates a new Payload value object from the given parameters.
     */
    public static function list(string $resource): self
    {
        $contentType = ContentType::JSON;
        $method = Method::GET;
        $uri = ResourceUri::list($resource);

        return new self($contentType, $method, $uri);
    }

    /**
     * Creates a new Payload value object from the given parameters.
     */
    public static function retrieve(string $resource, string $id, string $suffix = ''): self
    {
        $contentType = ContentType::JSON;
        $method = Method::GET;
        $uri = ResourceUri::retrieve($resource, $id, $suffix);

        return new self($contentType, $method, $uri);
    }

    /**
     * Creates a new Payload value object from the given parameters.
     */
    public static function retrieveContent(string $resource, string $id): self
    {
        $contentType = ContentType::JSON;
        $method = Method::GET;
        $uri = ResourceUri::retrieveContent($resource, $id);

        return new self($contentType, $method, $uri);
    }

    /**
     * Creates a new Payload value object from the given parameters.
     *
     * @param  array<string, mixed>  $parameters
     */
    public static function create(string $resource, array $parameters): self
    {
        $contentType = ContentType::JSON;
        $method = Method::POST;
        $uri = ResourceUri::create($resource);

        return new self($contentType, $method, $uri, $parameters);
    }

    /**
     * Creates a new Payload value object from the given parameters.
     *
     * @param  array<string, mixed>  $parameters
     */
    public static function upload(string $resource, array $parameters): self
    {
        $contentType = ContentType::MULTIPART;
        $method = Method::POST;
        $uri = ResourceUri::upload($resource);

        return new self($contentType, $method, $uri, $parameters);
    }

    /**
     * Creates a new Payload value object from the given parameters.
     */
    public static function cancel(string $resource, string $id): self
    {
        $contentType = ContentType::JSON;
        $method = Method::POST;
        $uri = ResourceUri::cancel($resource, $id);

        return new self($contentType, $method, $uri);
    }

    /**
     * Creates a new Payload value object from the given parameters.
     */
    public static function delete(string $resource, string $id): self
    {
        $contentType = ContentType::JSON;
        $method = Method::DELETE;
        $uri = ResourceUri::delete($resource, $id);

        return new self($contentType, $method, $uri);
    }

    /**
     * Creates a new Psr 7 Request instance.
     */
    public function toRequest(BaseUri $baseUri, Headers $headers, QueryParams $queryParams): RequestInterface
    {
        $psr17Factory = new Psr17Factory();

        $body = null;

        $uri = $baseUri->toString().$this->uri->toString();
        if (! empty($queryParams->toArray())) {
            $uri .= '?'.http_build_query($queryParams->toArray());
        }

        $headers = $headers->withContentType($this->contentType);

        if ($this->method === Method::POST) {
            if ($this->contentType === ContentType::MULTIPART) {
                $streamBuilder = new MultipartStreamBuilder($psr17Factory);

                /** @var array<string, StreamInterface|string|int|float|bool> $parameters */
                $parameters = $this->parameters;

                foreach ($parameters as $key => $value) {
                    if (is_int($value) || is_float($value) || is_bool($value)) {
                        $value = (string) $value;
                    }

                    $streamBuilder->addResource($key, $value);
                }

                $body = $streamBuilder->build();

                $headers = $headers->withContentType($this->contentType, '; boundary='.$streamBuilder->getBoundary());
            } else {
                $body = $psr17Factory->createStream(json_encode($this->parameters, JSON_THROW_ON_ERROR));
            }
        }

        $request = $psr17Factory->createRequest($this->method->value, $uri);

        if ($body !== null) {
            $request = $request->withBody($body);
        }

        foreach ($headers->toArray() as $name => $value) {
            $request = $request->withHeader($name, $value);
        }

        return $request;
    }
}
