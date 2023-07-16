<?php
// Database configuration
$host = 'localhost';
$dbUsername = 'your_username';
$dbPassword = 'your_password';
$dbName = 'your_database';

// Create database connection
$conn = new mysqli($host, $dbUsername, $dbPassword, $dbName);

// Check if the connection was successful
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];

    // Prepare and execute the SQL query to insert data into the database
    $stmt = $conn->prepare("INSERT INTO students (name, email, phone) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $name, $email, $phone);
    $stmt->execute();

    // Check if the data was successfully inserted
    if ($stmt->affected_rows > 0) {
        echo "Registration successful!";
    } else {
        echo "Error: Unable to register.";
    }

    // Close the statement
    $stmt->close();
}

// Close the database connection
$conn->close();
?>
