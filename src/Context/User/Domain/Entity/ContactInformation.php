<?php
declare(strict_types=1);

namespace Context\User\Domain\Entity;

/**
 * @internal
 */
final class ContactInformation
{

    private function __construct(
        private readonly string $id,
        private ?string $firstName,
        private ?string $lastName,
    )
    {
    }
}