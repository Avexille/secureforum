<?php

use App\SQLiteConnection;

$pdo = (new SQLiteConnection())->connect();

$title = 'Dashboard';

session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    // Redirect to login page if not logged in
    header('Location: /login');
    exit();
}

$user_id = $_SESSION['user_id'];
$username = $_SESSION['username'];


// Handle thread submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['title']);
    $content = trim($_POST['content']);

    if (!empty($title) && !empty($content)) {
        try {
            $stmt = $pdo->prepare("INSERT INTO threads (user_id, title, content) VALUES (:user_id, :title, :content)");
            $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
            $stmt->bindParam(':title', $title, PDO::PARAM_STR);
            $stmt->bindParam(':content', $content, PDO::PARAM_STR);
            $stmt->execute();

            echo "<p style='color: green;'>Thread created successfully!</p>";
    
        } catch (PDOException $e) {
            die("Error: Could not create thread. " . $e->getMessage());
        }
    }
}


require "views\dashboard.view.php";


