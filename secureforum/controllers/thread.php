<?php

//$db_file = 'db\phpsqlite.db';
/*try {
    $pdo = new PDO("sqlite:$db_file");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error: Could not connect to the SQLite database. " . $e->getMessage());
}*/

// use App\SQLiteConnection;

// $sqliteConnection = new SQLiteConnection();
// $pdo = $sqliteConnection->connect();

use App\SQLiteConnection;

$pdo = (new SQLiteConnection())->connect();

// Get the thread ID from the URL
if (isset($_GET['thread_id'])) {
    $thread_id = (int)$_GET['thread_id'];
} else if (isset($_POST['id'])) {
    $thread_id = (int)$_POST['id'];
}

// Fetch the thread from the database
try {
    $stmt = $pdo->prepare("SELECT * FROM threads WHERE thread_id = :thread_id LIMIT 1");
    $stmt->bindParam(':thread_id', $thread_id, PDO::PARAM_INT);
    $stmt->execute();
    $thread = $stmt->fetch(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Error: Could not fetch the thread. " . $e->getMessage());
}


// If the thread does not exist, give 404 response
if (!$thread) {
    abort(404);
}

// Handle comment submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name']);
    $content = trim($_POST['content']);

    if (!empty($name) && !empty($content)) {
        try {
            $stmt = $pdo->prepare("INSERT INTO comments (thread_id, content) VALUES (:thread_id, :content)");
            $stmt->bindParam(':thread_id', $thread_id, PDO::PARAM_INT);
            $stmt->bindParam(':content', $content, PDO::PARAM_STR);
            $stmt->execute();
        } catch (PDOException $e) {
            die("Error: Could not save the content. " . $e->getMessage());
        }
    }
}

// Fetch comments for the thread
try {
    $stmt = $pdo->prepare("SELECT * FROM comments WHERE thread_id = :thread_id ORDER BY created_at DESC");
    $stmt->bindParam(':thread_id', $thread_id, PDO::PARAM_INT);
    $stmt->execute();
    $comments = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Error: Could not fetch comments. " . $e->getMessage());
}

require "views/thread.view.php";
