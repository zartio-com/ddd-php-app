<?php
declare(strict_types=1);

namespace Context\User\Application\PublicApi\Validation\Constraints\Credentials;

use Context\User\Domain\Exception\ValueObject\Credentials\Password\PasswordTooShortException;
use Context\User\Domain\Exception\ValueObject\Credentials\Password\PasswordTooSimpleException;
use Override;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;

/**
 * @internal
 * @see Password
 */
class PasswordValidator extends ConstraintValidator
{

    #[Override] public function validate(mixed $value, Constraint $constraint): void
    {
        if (!$constraint instanceof Password) {
            throw new UnexpectedTypeException($constraint, Password::class);
        }

        if ($value === null) {
            return;
        }

        $value = (string)$value;

        try {
            new \Context\User\Domain\ValueObject\Credentials\Password\Password($value);
        } catch (PasswordTooShortException) {
            $this->context->buildViolation($constraint->tooShortMessage)
                ->setCode(Password::TOO_SHORT_ERROR)
                ->addViolation();
        } catch (PasswordTooSimpleException) {
            $this->context->buildViolation($constraint->tooSimpleMessage)
                ->setCode(Password::TOO_SIMPLE_ERROR)
                ->addViolation();
        }
    }
}