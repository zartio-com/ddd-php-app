<?php
declare(strict_types=1);

namespace Context\User\Domain\ValueObject\Credentials;

use Exception;
use JetBrains\PhpStorm\Immutable;

/**
 * @internal
 */
#[Immutable]
readonly class ApiKey
{

    private function __construct(
        private string $apiKey,
    )
    {

    }

    public static function create(): self
    {
        try {
            return new self(base64_encode(random_bytes(64)));
        } catch (Exception) {
            return new self('change-me'); // TODO: wtf am i supposed to do here
        }
    }

    public function toString(): string
    {
        return $this->apiKey;
    }

    public function equals(self $otherApiKey): bool
    {
        return $this->apiKey === $otherApiKey->apiKey;
    }
}