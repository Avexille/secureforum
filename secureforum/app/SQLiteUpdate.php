<?php

namespace App;


class SQLiteUpdate 
{

    /**
     * PDO object
     * @var \PDO
     */
    private $pdo;

    /**
     * Initialize the object with a specified PDO object
     */
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function banUser(int $userId) {
        // Updating user to being banned
        $sql = "UPDATE users "
                . "SET banned = 1 "
                . "WHERE user_id = :user_id";

        $stmt = $this->pdo->prepare($sql);

        // passing values to the parameters
        $stmt->bindValue(':user_id', $userId);

        // execute the update statement
        return $stmt->execute();
    }
}