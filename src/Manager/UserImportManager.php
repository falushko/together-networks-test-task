<?php

namespace TestTask\Manager;

use PDO;
use TestTask\DTO\User;
use TestTask\Interfaces\ValidatorInterface;
use TestTask\Validator\UserValidator;

class UserImportManager
{
    /**
     * @var PDO
     */
    protected $pdo;

    /**
     * @var UserValidator
     */
    protected $userValidator;

    /**
     * @param PDO $pdo
     * @param ValidatorInterface $userValidator
     */
    public function __construct(PDO $pdo, ValidatorInterface $userValidator)
    {
        $this->pdo = $pdo;
        $this->userValidator = $userValidator;
    }

    /**
     * Takes around 10 seconds to import 600k rows with the batch size 100
     * @param string $source
     * @param int $batchSize
     */
    public function importUsersFromCsvBatch(string $source, int $batchSize = 100)
    {
        $file = fopen($source, 'r');
        list($query, $parameters, $batchCounter) = $this->reset();
        $user = new User();

        while ($row = fgetcsv($file)) {
            if ($batchCounter >= $batchSize) {
                $query = rtrim($query, ', ');
                $stmt = $this->pdo->prepare($query);
                $stmt->execute($parameters);
                list($query, $parameters, $batchCounter) = $this->reset();
            }

            $user->setId($row[0]);
            $user->setName($row[1]);
            $user->setEmail($row[2]);
            $user->setSum($row[3]);
            $user->setCurrency($row[4]);

            if ($this->userValidator->isValid($user)) {
                $query .= "(?,?,?,?,?), ";
                $parameters = array_merge($parameters, $row);
                $batchCounter++;
            }
        }

        $stmt = $this->pdo->prepare(rtrim($query, ', '));
        $stmt->execute($parameters);
    }

    /**
     * Returns $query, $parameters and $batchCounter
     * @return array
     */
    private function reset()
    {
        return ["INSERT INTO users (id, name, email, sum, currency) VALUES ", [], 0];
    }
}