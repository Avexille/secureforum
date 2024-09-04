<?php
/*
require 'vendor/autoload.php';

// connecting to SQLite database
use App\SQLiteConnection;

$pdo = (new SQLiteConnection())->connect();

// redirecting to the frontpage
    header("Location:frontpage.php");
    exit();
*/

// connecting to SQLite database
// $db_file = 'db\phpsqlite.db';
// try {
//     $pdo = new PDO("sqlite:$db_file");
//     $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
// } catch (PDOException $e) {
//     die("Error: Could not connect to the SQLite database. " . $e->getMessage());
// }

use App\SQLiteConnection;

$pdo = (new SQLiteConnection())->connect();
// Fetch threads from the database
try {
    $query = $pdo->query("SELECT * FROM threads");
    $threads = $query->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Error: Could not fetch threads. " . $e->getMessage());
}

// loading view 
$title = 'SecureForum';
require "views\index.view.php";
