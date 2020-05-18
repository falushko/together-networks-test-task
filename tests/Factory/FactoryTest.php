<?php

namespace Factory;

use PHPUnit\Framework\TestCase;
use Predis\Client;
use TestTask\Factory\Factory;
use TestTask\Manager\CacheManager;
use TestTask\Manager\UserImportManager;
use TestTask\Repository\UserRepository;
use TestTask\Validator\UserValidator;
use TestTask\Hydrator\UserHydrator;


class FactoryTest extends TestCase
{
    protected $factory;

    public function setUp()
    {
        $this->factory = new Factory();
    }

    public function testCreateUserRepository()
    {
        $this->assertTrue($this->factory->createUserRepository() instanceof UserRepository);
    }

    public function testCreateUserImportManager()
    {
        $this->assertTrue($this->factory->createUserImportManager() instanceof UserImportManager);
    }

    public function testCreatePDO()
    {
        $this->assertTrue($this->factory->createPDO() instanceof \PDO);
    }

    public function testCreateCacheManager()
    {
        $this->assertTrue($this->factory->createCacheManager() instanceof CacheManager);
    }

    public function testCreateRedisClient()
    {
        $this->assertTrue($this->factory->createRedisClient() instanceof Client);
    }

    public function testCreateUserValidator()
    {
        $this->assertTrue($this->factory->createUserValidator() instanceof UserValidator);
    }

    public function testCreateUserHydrator()
    {
        $this->assertTrue($this->factory->createUserHydrator() instanceof UserHydrator);
    }
}