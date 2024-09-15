<?php
declare(strict_types=1);

namespace Context\User\Domain\ValueObject;

use JetBrains\PhpStorm\Immutable;
use SharedKernel\Domain\ValueObject\Id;

/**
 * @internal
 */
#[Immutable]
readonly class UserId extends Id
{

}