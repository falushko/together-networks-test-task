<?php

namespace TestTask\Repository;

use PDO;
use TestTask\DTO\User;
use TestTask\Interfaces\UserCacheManagerInterface;
use TestTask\Interfaces\UserHydratorInterface;
use TestTask\Interfaces\UserRepositoryInterface;

/**
 * Class UserRepository
 * @package TestTask\Repository
 */
class UserRepository implements UserRepositoryInterface
{
    /**
     * @var PDO
     */
    protected $pdo;

    /**
     * @var UserCacheManagerInterface
     */
    protected $cacheManager;

    /**
     * @var UserHydratorInterface
     */
    protected $userHydrator;

    /**
     * @param PDO $pdo
     * @param UserHydratorInterface $userHydrator
     * @param UserCacheManagerInterface $cacheManager
     */
    public function __construct(PDO $pdo, UserHydratorInterface $userHydrator, UserCacheManagerInterface $cacheManager)
    {
        $this->pdo = $pdo;
        $this->userHydrator = $userHydrator;
        $this->cacheManager = $cacheManager;
    }

    /**
     * @param string $emailOrName
     * @return User[]
     */
    public function getUsersByEmailOrName(string $emailOrName): array
    {
        if ($usersArray = $this->cacheManager->getUsersBySearchPhrase($emailOrName)) {
            return  $this->userHydrator->hydrateUsers($usersArray);
        }

        $stmt = $this->pdo->prepare("
            SELECT id, name, email, sum, currency 
            FROM users 
            WHERE name = :name OR email = :email;
        ");

        $stmt->execute(['name' => $emailOrName, 'email' => $emailOrName]);
        $usersArray = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $this->cacheManager->setUsersBySearchPhrase($emailOrName, $usersArray);

        return $this->userHydrator->hydrateUsers($usersArray);
    }
}