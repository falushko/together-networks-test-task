<?php

namespace TestTask\Factory;

use PDO;
use Predis\Client;
use TestTask\Hydrator\UserHydrator;
use TestTask\Interfaces\UserCacheManagerInterface;
use TestTask\Interfaces\UserHydratorInterface;
use TestTask\Interfaces\UserImportManagerInterface;
use TestTask\Interfaces\UserRepositoryInterface;
use TestTask\Interfaces\ValidatorInterface;
use TestTask\Manager\CacheManager;
use TestTask\Manager\ConfigManager;
use TestTask\Manager\UserImportManager;
use TestTask\Repository\UserRepository;
use TestTask\Validator\UserValidator;

/**
 * Class Factory
 * @package TestTask\Factory
 */
class Factory
{
    /**
     * @return UserRepositoryInterface
     */
    public function createUserRepository(): UserRepositoryInterface
    {
        return new UserRepository($this->createPDO(), $this->createUserHydrator(), $this->createCacheManager());
    }

    /**
     * @return UserImportManagerInterface
     */
    public function createUserImportManager(): UserImportManagerInterface
    {
        return new UserImportManager($this->createPDO(), $this->createUserValidator());
    }

    /**
     * @return PDO
     */
    public function createPDO(): PDO
    {
        $databaseConfig = (new ConfigManager())->getDatabaseConfig();
        $dsn = "mysql:dbname=" . $databaseConfig['dbname'] . ";host=" . $databaseConfig['host'] . ";port=" . $databaseConfig['port'];

        return new PDO($dsn, $databaseConfig['user'], $databaseConfig['password']);
    }

    /**
     * @return UserCacheManagerInterface
     */
    public function createCacheManager(): UserCacheManagerInterface
    {
        return new CacheManager($this->createRedisClient());
    }

    /**
     * @return Client
     */
    public function createRedisClient(): Client
    {
        $redisConfig = (new ConfigManager())->getRedisConfig();

        return new Client($redisConfig);
    }

    /**
     * @return ValidatorInterface
     */
    public function createUserValidator(): ValidatorInterface
    {
        return new UserValidator();
    }

    /**
     * @return UserHydratorInterface
     */
    public function createUserHydrator(): UserHydratorInterface
    {
        return new UserHydrator();
    }
}