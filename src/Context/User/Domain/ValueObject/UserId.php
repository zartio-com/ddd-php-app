<?php
declare(strict_types=1);

namespace Context\User\Domain\ValueObject;

use Symfony\Component\Uid\Uuid;

readonly class UserId
{
    public function __construct(
        private Uuid $id,
    )
    {

    }

    public function getValue(): Uuid
    {
        return $this->id;
    }
}