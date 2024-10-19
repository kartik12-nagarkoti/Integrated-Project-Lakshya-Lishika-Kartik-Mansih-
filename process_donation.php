<?php
// Database connection parameters
$servername = "localhost"; // Your database server name
$username = "root"; // Your database username
$password = ""; // Your database password
$dbname = "ngo_volunteer_network"; // Your database name
$port = 3307; // Database port number

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname, $port);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data and sanitize inputs
    $donor_name = $conn->real_escape_string(trim($_POST['donor_name']));
    $donor_email = $conn->real_escape_string(trim($_POST['donor_email']));
    $amount = $conn->real_escape_string(trim($_POST['amount']));
    $message = $conn->real_escape_string(trim($_POST['message']));
    $payment_method = $conn->real_escape_string(trim($_POST['payment_method']));

    // Prepare and execute the SQL statement
    $sql = "INSERT INTO donations (donor_name, donor_email, amount, message, payment_method) 
            VALUES ('$donor_name', '$donor_email', '$amount', '$message', '$payment_method')";

    if ($conn->query($sql) === TRUE) {
    // Success message
    echo '<div style="background-color: #f9f9f9; padding: 20px; border-radius: 5px; margin-top: 20px; width: 300px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); text-align: center; margin-left: auto; margin-right: auto;">'; // Centered
    echo "<h2 style='color: #28a745;'>Thank you for your donation!</h2>"; // Success message in green
    echo "<p><strong>Donor Name:</strong> $donor_name</p>";
    echo "<p><strong>Amount Donated:</strong> ₹$amount</p>";
    echo "<p><strong>Payment Method:</strong> $payment_method</p>";
    echo "<p><strong>Message:</strong> $message</p>";
    echo "</div>";
}
 else {
        // Error message
        echo '<div style="background-color: #f9d6d5; padding: 20px; border-radius: 5px; margin-top: 20px; width: 300px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); text-align: center;">';
        echo "<h2 style='color: #dc3545;'>Error:</h2>"; // Error message in red
        echo "<p>" . $sql . "<br>" . $conn->error . "</p>";
        echo "</div>";
    }
}

// Close the database connection
$conn->close();
?>
