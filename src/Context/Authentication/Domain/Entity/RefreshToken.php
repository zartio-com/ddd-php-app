<?php
declare(strict_types=1);

namespace Context\Authentication\Domain\Entity;

use Context\Authentication\Domain\ValueObject as VO;

/**
 * @internal
 */
final class RefreshToken
{

    private function __construct(
        private readonly VO\RefreshTokenId $id,
        private VO\RefreshToken $refreshToken,
    )
    {

    }

//    public static function create(
//        VO\IdentityType $identityType,
//        VO\IdentityId $identityId,
//    ): self
//    {
//        return new self(
//            id: VO\RefreshTokenId::create(),
//            refreshToken:
//        );
//    }

//    public static function reconstitute(
//        VO\RefreshTokenId $id,
//    ): self
//    {
//        return new self(
//            id: $id,
//        );
//    }
}