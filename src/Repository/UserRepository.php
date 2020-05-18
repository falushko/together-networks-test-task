<?php

namespace TestTask\Repository;

use PDO;
use TestTask\DTO\User;
use TestTask\Hydrator\UserHydrator;
use TestTask\Manager\CacheManager;

class UserRepository
{
    /**
     * @var PDO
     */
    protected $pdo;

    /**
     * @var CacheManager
     */
    protected $cacheManager;

    /**
     * @var UserHydrator
     */
    protected $userHydrator;

    /**
     * @param PDO $pdo
     * @param UserHydrator $userHydrator
     * @param CacheManager $cacheManager
     */
    public function __construct(PDO $pdo, UserHydrator $userHydrator, CacheManager $cacheManager)
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
        $stmt = $this->pdo->prepare("
            SELECT id, name, email, sum, currency 
            FROM users 
            WHERE name = :name OR email = :email
        ");

        $stmt->execute(['name' => $emailOrName, 'email' => $emailOrName]);

        $usersArray = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $this->userHydrator->hydrateUsers($usersArray);
    }
}