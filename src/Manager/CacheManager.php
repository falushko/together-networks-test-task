<?php

namespace TestTask\Manager;

use Predis\Client;

/**
 * Class CacheManager
 * @package TestTask\Manager
 */
class CacheManager
{
    const USERS_PREFIX = 'users_search_';

    /** @var Client  */
    protected $redis;

    /**
     * CacheManager constructor.
     * @param $redis
     */
    public function __construct(Client $redis)
    {
        $this->redis = $redis;
    }

    /**
     * @param string $emailOrName
     * @return array
     */
    public function getUsersBySearchPhrase(string $emailOrName): ?array
    {
        return json_decode($this->redis->get(self::USERS_PREFIX . $emailOrName), true);
    }

    /**
     * @param string $emailOrName
     * @param array $users
     */
    public function setUsersBySearchPhrase(string $emailOrName, array $users)
    {
        $this->redis->set(self::USERS_PREFIX . $emailOrName, json_encode($users));
    }
}