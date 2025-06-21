<?php
// --- Database Configuration ---
$host = "localhost:3310";       // Usually localhost
$user = "root";            // Your DB username
$password = "";            // Your DB password
$dbname = "myresume"; // Your DB name

// --- Create DB Connection ---
$conn = new mysqli($host, $user, $password, $dbname);

// --- Check DB Connection ---
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// --- Get Form Data ---
$name = $_POST['name'] ?? '';
$email = $_POST['email'] ?? '';
$subject = $_POST['subject'] ?? '';
$message = $_POST['message'] ?? '';

// --- Validate Inputs ---
if (empty($name) || empty($email) || empty($subject) || empty($message)) {
    echo "All fields are required.";
    exit;
}

// --- Prepare SQL Query ---
$stmt = $conn->prepare("INSERT INTO messages (name, email, subject, message) VALUES (?, ?, ?, ?)");
$stmt->bind_param("ssss", $name, $email, $subject, $message);

// --- Execute Query ---
if ($stmt->execute()) {
    echo "OK";  // You can check for this in your frontend
} else {
    echo "Failed to send message.";
}

$stmt->close();
$conn->close();
?>
