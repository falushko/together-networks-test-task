<?php

namespace TestTask\Interfaces;

use TestTask\DTO\User;

/**
 * Interface UserRepositoryInterface
 * @package TestTask\Interfaces
 */
interface UserRepositoryInterface
{
    /**
     * @param string $emailOrName
     * @return User[]
     */
    public function getUsersByEmailOrName(string $emailOrName): array;
}