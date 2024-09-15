<?php
declare(strict_types=1);

namespace Context\User\Domain\Exception\Aggregate\User;

use SharedKernel\Domain\Exception\DomainException;
use Throwable;

/**
 * @internal
 */
class UserCanNotHaveNoCredentials extends DomainException
{

    public function __construct(
        ?Throwable $previous = null
    )
    {
        parent::__construct(
            message: 'Cannot create User without any Credentials',
            previous: $previous
        );
    }
}