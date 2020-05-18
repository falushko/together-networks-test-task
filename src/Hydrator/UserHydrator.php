<?php

namespace TestTask\Hydrator;

use TestTask\DTO\User;

/**
 * Class UserHydrator
 * @package TestTask\Hydrator
 */
class UserHydrator
{
    /**
     * @param array $user
     * @return User
     */
    public function hydrateUser(array $user)
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
    public function hydrateUsers(array $users)
    {
        $userDTOArray = [];
        foreach ($users as $user) {
            $userDTOArray[] = $this->hydrateUser($user);
        }

        return $userDTOArray;
    }

}