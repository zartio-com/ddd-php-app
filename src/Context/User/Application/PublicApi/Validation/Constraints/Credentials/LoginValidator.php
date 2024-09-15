<?php
declare(strict_types=1);

namespace Context\User\Application\PublicApi\Validation\Constraints\Credentials;

use Context\User\Domain\Exception\ValueObject\Credentials\LoginContainsInvalidCharacters;
use Context\User\Domain\Exception\ValueObject\Credentials\LoginTooShortException;
use Override;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;

/**
 * @internal
 * @see Login
 */
class LoginValidator extends ConstraintValidator
{

    #[Override] public function validate(mixed $value, Constraint $constraint): void
    {
        if (!$constraint instanceof Login) {
            throw new UnexpectedTypeException($constraint, Login::class);
        }

        if ($value === null) {
            return;
        }

        $value = (string)$value;

        try {
            new \Context\User\Domain\ValueObject\Credentials\Login($value);
        } catch (LoginTooShortException) {
            $this->context->buildViolation($constraint->tooShortMessage)
                ->setCode(Login::TOO_SHORT_ERROR)
                ->addViolation();
        } catch (LoginContainsInvalidCharacters) {
            $this->context->buildViolation($constraint->invalidCharactersMessage)
                ->setCode(Login::INVALID_CHARACTERS_ERROR)
                ->addViolation();
        }
    }
}