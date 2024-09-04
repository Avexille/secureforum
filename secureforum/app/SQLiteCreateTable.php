<?php

namespace App;

/**
 * SQLite Create Table
 */
class SQLiteCreateTable
{

    /**
     * PDO object
     * @var \PDO
     */
    private $pdo;

    /**
     * connect to the SQLite database
     */
    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    /**
     * create tables 
     */
    public function createTables()
    {
        $commands = [
            'CREATE TABLE IF NOT EXISTS users (
                        user_id   INTEGER PRIMARY KEY,
                        username VARCHAR(255) NOT NULL,
                        pass VARCHAR(255) NOT NULL,
                        banned BOOLEAN NOT NULL,
                        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
                      )',
            'CREATE TABLE IF NOT EXISTS threads (
                    thread_id INTEGER PRIMARY KEY,
                    user_id  INTEGER NOT NULL,
                    title VARCHAR(255) NOT NULL,
                    content TEXT NOT NULL,
                    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                    FOREIGN KEY (user_id)
                    REFERENCES users (user_id) )',
            'CREATE TABLE IF NOT EXISTS comments (
                                    comment_id INTEGER PRIMARY KEY,
                                    thread_id  INTEGER NOT NULL,
                                    content TEXT NOT NULL,
                                    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                                    FOREIGN KEY (thread_id)
                                    REFERENCES threads (thread_id) )'
        ];
        // execute the sql commands to create new tables
        foreach ($commands as $command) {
            $this->pdo->exec($command);
        }
    }

    /**
     * get the table list in the database
     */
    public function getTableList()
    {

        $stmt = $this->pdo->query("SELECT name
                                   FROM sqlite_master
                                   WHERE type = 'table'
                                   ORDER BY name");
        $tables = [];
        while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            $tables[] = $row['name'];
        }

        return $tables;
    }
}
