<?php

use TestTask\Factory\Factory;

require __DIR__ . '/../vendor/autoload.php';

$factory = new Factory();

try {
    echo "Importing...\n\r";
    $start = microtime(true);

    $factory->createUserImportManager()->importUsersFromCsvBatch('resources/users.csv');

    $end = microtime(true);

    echo "Import finished in " . round($end - $start) . " seconds. \n\r";
} catch (Exception $exception) {
    echo $exception->getMessage();
}



