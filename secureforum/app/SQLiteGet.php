<?php

namespace App;

/**
 * PHP SQLite Insert
 */
class SQLiteGet {
    
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
        /**
     * Get all threads
     * @return type
     */
    public function getThreads() {
        $stmt = $this->pdo->query('SELECT thread_id, title, content '
                . 'FROM threads');
        $threads = [];
        while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            $threads[] = [
                'thread_id' => $row['thread_id'],
                'title' => $row['title'],
                'content' => $row['content']
            ];
        }
        return $threads;
    }

    public function getComments() {
        $stmt = $this->pdo->query('SELECT comment_id, thread_id, content '
                . 'FROM comments');
        $comments = [];
        while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            $comments[] = [
                'thread_id' => $row['thread_id'],
                'comment_id' => $row['comment_id'],
                'content' => $row['content']
            ];
        }
        return $comments;
    }
}