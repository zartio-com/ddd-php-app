<?php
declare(strict_types=1);

namespace Context\User\Application\Exception\Factory\DTO\Output\Credential;

use Context\User\Domain\Entity\Credentials\CredentialInterface;
use SharedKernel\Application\Exception\ApplicationException;
use Throwable;

class UnhandledCredentialImplementationException extends ApplicationException
{

    /**
     * @param class-string<CredentialInterface> $unhandledClass
     */
    public function __construct(string $unhandledClass, ?Throwable $previous = null)
    {
        parent::__construct(
            message: "Unhandled implementation of CredentialInterface for: $unhandledClass",
            previous: $previous
        );
    }
}