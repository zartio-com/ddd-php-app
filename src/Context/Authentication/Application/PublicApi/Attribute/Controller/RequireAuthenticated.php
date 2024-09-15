<?php
declare(strict_types=1);

namespace Context\Authentication\Application\PublicApi\Attribute\Controller;

use Attribute;
use Context\Authentication\Application\PublicApi\DTO\Enum\IdentityType;

#[Attribute]
readonly class RequireAuthenticated
{

    public function __construct(
        public IdentityType $identityType,
    )
    {

    }
}