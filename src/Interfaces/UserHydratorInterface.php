<?php

namespace TestTask\Interfaces;

use TestTask\DTO\User;

/**
 * Interface UserHydratorInterface
 * @package TestTask\Interfaces
 */
interface UserHydratorInterface
{
    /**
     * @param array $user
     * @return User
     */
    public function hydrateUser(array $user): User;

    /**
     * @param array $users
     * @return array
     */
    public function hydrateUsers(array $users): array;
}