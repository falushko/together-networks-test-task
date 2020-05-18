<?php

namespace TestTask\Validator;

use TestTask\DTO\User;
use TestTask\Interfaces\ValidatorInterface;

/**
 * Class UserValidator
 * @package TestTask\Validator
 */
class UserValidator implements ValidatorInterface
{
    /**
     * @var array
     */
    protected $errors;

    /**
     * @param User $user
     * @return bool
     */
    public function isValid($user): bool
    {
        $this->errors = [];
        $this->validateId($user);
        $this->validateName($user);
        $this->validateEmail($user);
        $this->validateCurrency($user);
        $this->validateSum($user);

        return empty($this->errors);
    }

    /**
     * @return array
     */
    public function getErrors(): array
    {
        return $this->errors;
    }

    /**
     * @param User $user
     */
    protected function validateId(User $user)
    {
        if (empty($user->getId()) || strlen($user->getId()) > 36) {
            $this->errors['id'] = 'User\'s id is invalid';
        }
    }

    /**
     * @param User $user
     */
    protected function validateName(User $user)
    {
        if (empty($user->getName()) || strlen($user->getName()) > 30) {
            $this->errors['name'] = 'User\'s name is invalid';
        }
    }

    /**
     * @param User $user
     */
    protected function validateEmail(User $user)
    {
        if (empty($user->getEmail()) || strlen($user->getEmail()) > 30) {
            $this->errors['email'] = 'User\'s email is invalid';
        }
    }

    /**
     * @param User $user
     */
    protected function validateCurrency(User $user)
    {
        if (empty($user->getCurrency()) || strlen($user->getCurrency()) > 5) {
            $this->errors['name'] = 'User\'s currency is invalid';
        }
    }

    /**
     * @param User $user
     */
    protected function validateSum(User $user)
    {
        if (empty($user->getSum()) || strlen((string) $user->getSum()) > 6) {
            $this->errors['sum'] = 'User\'s sum is invalid';
        }
    }
}