<?php

namespace TestTask\Interfaces;

/**
 * Interface ConfigManagerInterface
 * @package TestTask\Interfaces
 */
interface ConfigManagerInterface
{
    /**
     * @return array
     */
    public function getDatabaseConfig(): array;

    /**
     * @return array
     */
    public function getRedisConfig(): array;
}