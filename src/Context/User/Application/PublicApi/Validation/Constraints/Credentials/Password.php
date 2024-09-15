<?php
declare(strict_types=1);

namespace Context\User\Application\PublicApi\Validation\Constraints\Credentials;

use Attribute;
use Symfony\Component\Validator\Constraint;

/**
 * @see PasswordValidator::validate()
 */
#[Attribute(Attribute::TARGET_PROPERTY | Attribute::TARGET_METHOD)]
final class Password extends Constraint
{

    public const string TOO_SHORT_ERROR = 'password_too_short';
    public const string TOO_SIMPLE_ERROR = 'password_too_simple';

    protected const array ERROR_NAMES = [
        self::TOO_SHORT_ERROR => 'TOO_SHORT_ERROR',
        self::TOO_SIMPLE_ERROR => 'TOO_SIMPLE_ERROR',
    ];

    public string $tooShortMessage = 'Password is too short';

    public string $tooSimpleMessage = 'Password is too simple';

    public function __construct(
        ?string $tooShortMessage = null,
        ?string $tooSimpleMessage = null,
        mixed $options = null,
        ?array $groups = null,
        mixed $payload = null
    )
    {
        parent::__construct($options, $groups, $payload);

        $this->tooShortMessage = $tooShortMessage ?? $this->tooShortMessage;
        $this->tooSimpleMessage = $tooSimpleMessage ?? $this->tooSimpleMessage;
    }
}