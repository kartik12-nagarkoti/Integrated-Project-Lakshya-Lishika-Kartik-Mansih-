<?php
// Database configuration
$servername = "localhost:3307"; // Specify the port number
$username = "root"; // Default MySQL username for XAMPP
$password = ""; // Default password for MySQL root user in XAMPP is empty
$dbname = "ngo_volunteer_network"; // Your MySQL database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect and sanitize input data
    $name = htmlspecialchars(trim($_POST['name']));
    $email = htmlspecialchars(trim($_POST['email']));
    $phone = htmlspecialchars(trim($_POST['phone']));
    $notes = htmlspecialchars(trim($_POST['notes']));

    // Validate input data
    if (empty($name) || empty($email) || empty($phone)) {
        echo "Please fill in all required fields.";
    } else {
        // Prepare and bind SQL statement
        $stmt = $conn->prepare("INSERT INTO volunteers (name, email, phone, notes) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $name, $email, $phone, $notes);

        // Execute the statement
        if ($stmt->execute()) {
            echo "Registration successful! Thank you for volunteering.";
        } else {
            echo "Error: " . $stmt->error;
        }

        // Close statement
        $stmt->close();
    }
}

// Close connection
$conn->close();
?>


