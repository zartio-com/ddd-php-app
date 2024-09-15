<?php
declare(strict_types=1);

namespace Context\User\Application\PublicApi\Validation\Constraints\Credentials;

use Attribute;
use Symfony\Component\Validator\Constraint;

/**
 * @see LoginValidator::validate()
 */
#[Attribute(Attribute::TARGET_PROPERTY | Attribute::TARGET_METHOD)]
final class Login extends Constraint
{

    public const string TOO_SHORT_ERROR = 'login_too_short';
    public const string INVALID_CHARACTERS_ERROR = 'login_contains_invalid_characters';

    protected const array ERROR_NAMES = [
        self::TOO_SHORT_ERROR => 'TOO_SHORT_ERROR',
        self::INVALID_CHARACTERS_ERROR => 'INVALID_CHARACTERS_ERROR',
    ];

    public string $tooShortMessage = 'Login is too short. Minimum length is 4.';

    public string $invalidCharactersMessage =
        'Login contains invalid characters. Only alphanumerics and underscores are allowed.';

    public function __construct(
        ?string $tooShortMessage = null,
        ?string $invalidCharactersMessage = null,
        mixed $options = null,
        ?array $groups = null,
        mixed $payload = null
    )
    {
        parent::__construct($options, $groups, $payload);

        $this->tooShortMessage = $tooShortMessage ?? $this->tooShortMessage;
        $this->invalidCharactersMessage = $invalidCharactersMessage ?? $this->invalidCharactersMessage;
    }
}