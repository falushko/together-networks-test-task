<?php

use TestTask\DTO\User;
use TestTask\Factory\Factory;

require __DIR__ . '/../vendor/autoload.php';

$factory = new Factory();
$userRepository = $factory->createUserRepository();

if (!array_key_exists(1, $argv)) {
    echo "Please provide email or name for the search!\n\r";
    exit();
}

$users = $userRepository->getUsersByEmailOrName($argv[1]);

/** @var User $user */
foreach ($users as $user) {
    echo
        $user->getId() . ": " .
        $user->getName() . " " .
        $user->getEmail() . " " .
        $user->getCurrency() .
        $user->getSum() . "\r\n";
}