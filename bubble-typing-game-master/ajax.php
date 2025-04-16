<?php
// Show all errors (turn this off on production)
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Database config
$host = "localhost";
$user = "root";
$password = "";
$dbname = "bubble";

// Create connection
$conn = new mysqli($host, $user, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check for POST request and correct action
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'register_score') {

    // Get and sanitize inputs
    $username = $_POST['username'] ?? '';
    $characters = (int)($_POST['characters'] ?? 0);
    $seconds = (int)($_POST['seconds'] ?? 0);

    // Validate inputs
    if ($username === '' || $characters <= 0 || $seconds <= 0) {
        echo "Invalid input values.";
        exit;
    }

    // Prepare the query
    $stmt = $conn->prepare("INSERT INTO scoreboard (username, characters, seconds) VALUES (?, ?, ?)");
    if (!$stmt) {
        echo "Prepare failed: " . $conn->error;
        exit;
    }

    $stmt->bind_param("sii", $username, $characters, $seconds);

    // Execute and respond
    if ($stmt->execute()) {
        echo "Success";
    } else {
        echo "Database insert failed: " . $stmt->error;
    }

    $stmt->close();

} else {
    echo "No valid POST request received.";
}

$conn->close();
?>
