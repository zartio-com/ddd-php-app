<?php
declare(strict_types=1);

namespace Context\User\Application\PublicApi\Validation\Constraints\Credentials;

use Context\User\Application\PublicApi\Query\Credentials\WithLogin;
use Context\User\Domain\Exception\ValueObject\Credentials\LoginException;
use Override;
use Symfony\Component\Messenger\HandleTrait;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;

/**
 * @internal
 * @see UniqueLogin
 */
class UniqueLoginValidator extends ConstraintValidator
{

    use HandleTrait;

    public function __construct(
        MessageBusInterface $messageBus,
    )
    {
        $this->messageBus = $messageBus;
    }

    #[Override] public function validate(mixed $value, Constraint $constraint): void
    {
        if (!$constraint instanceof UniqueLogin) {
            throw new UnexpectedTypeException($constraint, UniqueLogin::class);
        }

        if ($value === null) {
            return;
        }

        $value = (string)$value;

        try {
            new \Context\User\Domain\ValueObject\Credentials\Login($value);
        } catch (LoginException) {
            return;
        }

        $credential = $this->handle(new WithLogin($value));
        if ($credential !== null) {
            $this->context->buildViolation($constraint->message)
                ->setCode(UniqueLogin::NOT_UNIQUE_ERROR)
                ->addViolation();
        }
    }
}