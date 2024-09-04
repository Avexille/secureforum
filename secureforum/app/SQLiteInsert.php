<?php

namespace App;

/**
 * PHP SQLite Insert
 */
class SQLiteInsert {

    /**
     * PDO object
     * @var \PDO
     */
    private $pdo;

    /**
     * Initialize the object with a specified PDO object
     * @param \PDO $pdo
     */
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

        //User table insert into username and password
    public function insertUser(string $userName,string $pass, bool $banned = false): int {
        $sql = 'INSERT INTO users (username,pass,banned) VALUES(:username,:pass,:banned)';
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':username', $userName);
        $stmt->bindValue(':pass', $pass);
        $stmt->execute();

        return $this->pdo->lastInsertId();
    }

        //Thread table insert into title, content and userID
    public function insertThread(string $title,string $content, int $userId): int {
        $sql = 'INSERT INTO threads (title,content,user_id) VALUES(:title,:content,:user_id)';
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':title', $title);
        $stmt->bindValue(':content', $content);
        $stmt->bindValue(':user_id', $userId);
        $stmt->execute();

        return $this->pdo->lastInsertId();
    }

        //Comments table insert into threadID and content
    public function insertComment(int $threadId,string $content): int {
        $sql = 'INSERT INTO comments (thread_id,content) VALUES(:thread_id,:content)';
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':thread_id', $threadId);
        $stmt->bindValue(':content', $content);
        $stmt->execute();

        return $this->pdo->lastInsertId();
    }

}