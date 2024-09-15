<?php
declare(strict_types=1);

namespace Context\Authentication\Domain\ValueObject;

use SharedKernel\Domain\ValueObject\Id;
use Symfony\Component\Uid\Uuid;

/**
 * @internal
 */
readonly class IdentityId extends Id
{

    public function __construct(Uuid $id)
    {
        parent::__construct($id);
    }
}