<?php

namespace TestTask\Interfaces;

/**
 * Interface Validator
 * @package TestTask\Interfaces
 */
interface ValidatorInterface
{
    /**
     * @param mixed $dto
     * @return bool
     */
    public function isValid($dto): bool;

    /**
     * @return array
     */
    public function getErrors(): array;
}