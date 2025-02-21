<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "prefix";

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get form data
$name = $_POST['name'] ?? '';  // Avoid undefined index error
$email = $_POST['email'] ?? '';
$phone = $_POST['phone'] ?? '';

// Prepare SQL statement
$stmt = $conn->prepare("INSERT INTO fix (name, email, phone) VALUES (?, ?, ?)");

if ($stmt) {
    $stmt->bind_param("sss", $name, $email, $phone); // Bind parameters correctly

    if ($stmt->execute()) {
        echo "Data inserted successfully!";
    } else {
        echo "Error executing statement: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "Error preparing statement: " . $conn->error;
}

$conn->close();
?>
