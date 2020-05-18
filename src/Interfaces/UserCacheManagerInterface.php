<?php

namespace TestTask\Interfaces;

/**
 * Interface UserCacheManagerInterface
 * @package TestTask\Interfaces
 */
interface UserCacheManagerInterface
{
    /**
     * @param string $emailOrName
     * @return array
     */
    public function getUsersBySearchPhrase(string $emailOrName): ?array;

    /**
     * @param string $emailOrName
     * @param array $users
     */
    public function setUsersBySearchPhrase(string $emailOrName, array $users);
}