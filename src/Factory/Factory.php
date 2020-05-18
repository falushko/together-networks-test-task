<?php

namespace TestTask\Factory;

use PDO;
use TestTask\Hydrator\UserHydrator;
use TestTask\Interfaces\ValidatorInterface;
use TestTask\Manager\CacheManager;
use TestTask\Manager\ConfigManager;
use TestTask\Manager\UserImportManager;
use TestTask\Repository\UserRepository;
use TestTask\Validator\UserValidator;

class Factory
{
    /**
     * @return UserRepository
     */
    public function createUserRepository(): UserRepository
    {
        return new UserRepository($this->createPDO(), $this->createUserHydrator(), $this->createCacheManager());
    }

    /**
     * @return UserImportManager
     */
    public function createUserImportManager()
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
     * @return CacheManager
     */
    public function createCacheManager(): CacheManager
    {
        return new CacheManager();
    }

    /**
     * @return ValidatorInterface
     */
    public function createUserValidator(): ValidatorInterface
    {
        return new UserValidator();
    }

    /**
     * @return UserHydrator
     */
    public function createUserHydrator(): UserHydrator
    {
        return new UserHydrator();
    }
}