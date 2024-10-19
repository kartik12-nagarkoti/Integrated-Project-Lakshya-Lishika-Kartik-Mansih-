<?php
// Database connection parameters
$servername = "localhost"; // Your database server name
$username = "root"; // Your database username
$password = ""; // Your database password
$dbname = "ngo_volunteer_network"; // Your database name
$port = 3307; // Your database port number

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname, $port);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data and sanitize inputs
    $ngo_name = $conn->real_escape_string(trim($_POST['ngo_name']));
    $contact_person = $conn->real_escape_string(trim($_POST['contact_person']));
    $email = $conn->real_escape_string(trim($_POST['email']));
    $phone = $conn->real_escape_string(trim($_POST['phone']));
    $address = $conn->real_escape_string(trim($_POST['address']));

    // Prepare and execute the SQL statement
    $sql = "INSERT INTO NGOs (ngo_name, contact_person, email, phone, address) 
            VALUES ('$ngo_name', '$contact_person', '$email', '$phone', '$address')";

    if ($conn->query($sql) === TRUE) {
        echo "<p>New NGO registered successfully!</p>";
    } else {
        echo "<p>Error: " . $sql . "<br>" . $conn->error . "</p>";
    }
}

// Close the database connection
$conn->close();
?>
