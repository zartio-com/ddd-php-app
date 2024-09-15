<?php

namespace PHPSTORM_META {

    use Context\User\Application\PublicApi\Query\Credentials\WithLoginAndPassword;
    use Symfony\Component\Messenger\HandleTrait;

    override(HandleTrait::handle(), map([
        '\Context\User\Application\PublicApi\Query\UserOfId' => '\Context\User\Application\PublicApi\DTO\User',
        '\Context\User\Application\PublicApi\Query\UserOfId' => 'null',

        '\Context\User\Application\PublicApi\Query\Credentials\WithLoginAndPassword' => '\Context\User\Application\PublicApi\DTO\Credentials\LoginAndPassword',
        '\Context\User\Application\PublicApi\Query\Credentials\WithLoginAndPassword' => 'null',

        '\Context\User\Application\PublicApi\Query\Credentials\WithLogin' => '\Context\User\Application\PublicApi\DTO\Credentials\LoginAndPassword',
        '\Context\User\Application\PublicApi\Query\Credentials\WithLogin' => 'null',
    ]));
}