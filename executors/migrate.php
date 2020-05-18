<?php

use TestTask\Factory\Factory;

require __DIR__ . '/../vendor/autoload.php';

$pdo = (new Factory())->createPDO();

/** Clear previous data */
$pdo->query('DROP TABLE IF EXISTS users;');

/** Create users table */
$pdo->query('
    CREATE TABLE IF NOT EXISTS users (
        id VARCHAR(36) PRIMARY KEY,
        name VARCHAR(30) NOT NULL,
        email VARCHAR(30) NOT NULL,
        currency CHAR(5) NOT NULL,
        sum INT NOT NULL
    );
');

/** Create indexes */
$pdo->query('
    CREATE INDEX name_idx ON users (name);
    CREATE INDEX email_idx ON users (email);
');