<?php
// Database connection details
$host = 'localhost';
$dbname = 'ngo_volunteer_network';
$username = 'root';
$password = ''; // Your database password

try {
    // Create a PDO instance
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;port=3307;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Prepare and execute the insert statement
    $stmt = $pdo->prepare("INSERT INTO applications (opportunity_name, full_name, email, phone, cover_letter) VALUES (:opportunity_name, :full_name, :email, :phone, :cover_letter)");
    
    // Bind parameters
    $stmt->bindParam(':opportunity_name', $_POST['opportunityName']);
    $stmt->bindParam(':full_name', $_POST['fullName']);
    $stmt->bindParam(':email', $_POST['email']);
    $stmt->bindParam(':phone', $_POST['phone']);
    $stmt->bindParam(':cover_letter', $_POST['message']);
    
    // Execute the statement
    $stmt->execute();

    // Display success message
    echo '<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Application Submitted</title>
        <style>
            body {
                font-family: Arial, sans-serif;
                background-color: #f7f7f7;
                display: flex;
                justify-content: center;
                align-items: center;
                height: 100vh;
                margin: 0;
            }
            .success-message {
                background-color: #e0f7fa; /* Light cyan background */
                border: 2px solid #009688; /* Teal border */
                border-radius: 10px; /* Rounded corners */
                padding: 30px; /* Padding */
                text-align: center; /* Center text */
                box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2); /* Subtle shadow */
                max-width: 500px; /* Max width */
            }
            h1 {
                color: #009688; /* Teal text color */
                font-size: 24px; /* Font size */
                margin: 0; /* Remove margin */
            }
            p {
                color: #333; /* Dark text color */
                margin: 10px 0; /* Margin */
            }
            a {
                text-decoration: none; /* No underline */
                color: #ffffff; /* White text */
                background-color: #009688; /* Teal background */
                padding: 10px 20px; /* Button padding */
                border-radius: 5px; /* Rounded corners */
                transition: background-color 0.3s; /* Transition */
            }
            a:hover {
                background-color: #00796b; /* Darker teal on hover */
            }
        </style>
    </head>
    <body>
        <div class="success-message">
            <h1>Application Submitted Successfully!</h1>
            <p>Thank you for applying. We will review your application and get back to you soon.</p>
            <a href="index.html">Back to Opportunities</a>
        </div>
    </body>
    </html>';
} catch (PDOException $e) {
    echo 'Error: ' . $e->getMessage();
}
?>
