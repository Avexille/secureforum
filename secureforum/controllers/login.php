<?php

session_start();

// $db_file = 'db\phpsqlite.db';
// try {
//     $pdo = new PDO("sqlite:$db_file");
//     $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
// } catch (PDOException $e) {
//     die("Error: Could not connect to the SQLite database. " . $e->getMessage());
// }

use App\SQLiteConnection;

$pdo = (new SQLiteConnection())->connect();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // var_dump($_POST);
    $username = $_POST['username'];
    $pass = $_POST['pass'];

    // Vulnerable SQL query (directly embedding user input)
    $query = "SELECT * FROM users WHERE username = '$username' AND pass = '$pass'";
    $result = $pdo->query($query);

    // Fetch the user if exists
    $user = $result->fetch(PDO::FETCH_ASSOC);
    // var_dump($user);

    // Check if the user exists
    if ($user) {
        // Set session variables
        $_SESSION['user_id'] = $user['user_id'];
        $_SESSION['username'] = $user['username'];

        // Redirect to dashboard - logged in user
        header('Location: dashboard');
        exit();
    } else {
        // Invalid username or password
        echo '<p style="color: red;">Invalid username or password!</p>';
    }
}

$title = 'Login';
require 'views\login.view.php';
