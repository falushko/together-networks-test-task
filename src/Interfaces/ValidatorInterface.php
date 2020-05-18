<?php

namespace TestTask\Interfaces;

/**
 * Interface Validator
 * @package TestTask\Interfaces
 */
interface ValidatorInterface
{
    /**
     * @param ValidatableInterface $validatable
     * @return bool
     */
    public function isValid(ValidatableInterface $validatable): bool;

    /**
     * @return array
     */
    public function getErrors(): array;
}