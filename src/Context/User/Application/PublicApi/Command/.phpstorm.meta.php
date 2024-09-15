<?php

namespace PHPSTORM_META {

    use Context\User\Application\PublicApi\Query\Credentials\WithLoginAndPassword;
    use Symfony\Component\Messenger\HandleTrait;

    override(HandleTrait::handle(), map([
        '\Context\User\Application\PublicApi\Command\Credentials\TryToUpgradeHashingAlgorithm' => 'void',
    ]));
}