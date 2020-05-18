<?php

namespace Manager;

use PHPUnit\Framework\TestCase;
use Predis\Client;
use TestTask\Manager\CacheManager;

class CacheManagerTest extends TestCase
{
    public function testGetUsersBySearchPhrase()
    {
        $emailOrName = 'test';

        $redisMock = $this->getMockBuilder(Client::class)->setMethods(['get'])->getMock();
        $redisMock->expects($this->once())->method('get')->with(CacheManager::USERS_PREFIX . $emailOrName);

        $cacheManager = new CacheManager($redisMock);
        $cacheManager->getUsersBySearchPhrase($emailOrName);
    }

    public function testSetUsersBySearchPhrase()
    {
        $emailOrName = 'test';

        $redisMock = $this->getMockBuilder(Client::class)->setMethods(['set'])->getMock();
        $redisMock->expects($this->once())->method('set')->with(CacheManager::USERS_PREFIX . $emailOrName);

        $cacheManager = new CacheManager($redisMock);
        $cacheManager->setUsersBySearchPhrase($emailOrName, []);
    }
}