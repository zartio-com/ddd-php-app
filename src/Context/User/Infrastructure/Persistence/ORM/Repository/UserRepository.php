<?php
declare(strict_types=1);

namespace Context\User\Infrastructure\Persistence\ORM\Repository;

use Context\User\Domain\Entity\User;
use Context\User\Domain\ValueObject\UserId;
use Context\User\Infrastructure\Persistence\ORM\Mapping\UserMapper;
use Context\User\Infrastructure\Persistence\UserRepositoryInterface;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;

/**
 * @internal
 */
class UserRepository implements UserRepositoryInterface
{

    /** @var EntityRepository<\Context\User\Infrastructure\Persistence\ORM\Entity\User> */
    private readonly EntityRepository $entityRepository;

    public function __construct(
        private readonly EntityManagerInterface $em,
        private readonly UserMapper $userMapper,
    )
    {
        $this->entityRepository = $em->getRepository(\Context\User\Infrastructure\Persistence\ORM\Entity\User::class);
    }

    public function persist(User $user): void
    {
        $entity = $this->userMapper->toORM($user);
        $this->em->persist($entity);
        $this->em->flush();
    }

    public function userOfId(UserId $userId): ?User
    {
        $entity = $this->entityRepository->find($userId->getValue());

        return $entity ? $this->userMapper->toDomain($entity) : null;
    }
}