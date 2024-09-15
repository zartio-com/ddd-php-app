<?php
declare(strict_types=1);

namespace Context\User\Domain\Exception\Entity\Credentials;

use SharedKernel\Domain\Exception\DomainException;

/**
 * @internal
 */
class NewPasswordIsSameAsOldPasswordException extends DomainException
{

}