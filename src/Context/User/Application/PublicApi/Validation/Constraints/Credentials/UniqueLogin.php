<?php
declare(strict_types=1);

namespace Context\User\Application\PublicApi\Validation\Constraints\Credentials;

use Attribute;
use Symfony\Component\Validator\Constraint;

/**
 * NOTICE: Will query the database through message bus!
 * @see UniqueLoginValidator::validate()
 */
#[Attribute(Attribute::TARGET_PROPERTY | Attribute::TARGET_METHOD)]
final class UniqueLogin extends Constraint
{

    public const string NOT_UNIQUE_ERROR = 'login_not_unique';

    protected const array ERROR_NAMES = [
        self::NOT_UNIQUE_ERROR => 'NOT_UNIQUE_ERROR',
    ];

    public string $message = 'Login is not unique';

    public function __construct(
        ?string $message = null,
        mixed $options = null,
        ?array $groups = null,
        mixed $payload = null
    )
    {
        parent::__construct($options, $groups, $payload);

        $this->message = $message ?? $this->message;
    }
}