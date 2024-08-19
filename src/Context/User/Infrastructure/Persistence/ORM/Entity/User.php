<?php
declare(strict_types=1);

namespace Context\User\Infrastructure\Persistence\ORM\Entity;

use Context\User\Domain\ValueObject\UserId;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Uid\Uuid;

/**
 * @internal
 */
#[ORM\Entity]
class User
{

    public function __construct(
        #[ORM\Id]
        #[ORM\Column(type: 'uuid')]
        private Uuid $id,

        #[ORM\Column(type: 'string', unique: true)]
        private string $username,
    )
    {

    }

    public function getId(): Uuid
    {
        return $this->id;
    }

    public function getUsername(): string
    {
        return $this->username;
    }
}