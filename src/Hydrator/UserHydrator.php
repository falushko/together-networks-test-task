<?php

namespace TestTask\Hydrator;

use TestTask\DTO\User;
use TestTask\Interfaces\UserHydratorInterface;

/**
 * Class UserHydrator
 * @package TestTask\Hydrator
 */
class UserHydrator implements UserHydratorInterface
{
    /**
     * @param array $user
     * @return User
     */
    public function hydrateUser(array $user): User
    {
        $userDTO = new User();
        $userDTO->setId($user['id']);
        $userDTO->setName($user['name']);
        $userDTO->setEmail($user['email']);
        $userDTO->setSum($user['sum']);
        $userDTO->setCurrency($user['currency']);

        return $userDTO;
    }

    /**
     * @param array $users
     * @return array
     */
    public function hydrateUsers(array $users): array
    {
        $userDTOArray = [];
        foreach ($users as $user) {
            $userDTOArray[] = $this->hydrateUser($user);
        }

        return $userDTOArray;
    }
}