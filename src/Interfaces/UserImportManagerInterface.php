<?php

namespace TestTask\Interfaces;

/**
 * Interface UserImportManagerInterface
 * @package TestTask\Interfaces
 */
interface UserImportManagerInterface
{
    /**
     * @param string $source
     * @param int $batchSize
     */
    public function importUsersFromCsv(string $source, int $batchSize = 100);
}