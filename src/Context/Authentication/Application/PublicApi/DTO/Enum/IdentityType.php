<?php
declare(strict_types=1);

namespace Context\Authentication\Application\PublicApi\DTO\Enum;

use JsonSerializable;

enum IdentityType: string implements JsonSerializable
{

    case USER = 'user';

    #[\Override] public function jsonSerialize(): string
    {
        return $this->value;
    }
}
