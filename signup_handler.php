<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
</body>
</html>



<?php
// Include database connection
include('admin/db_connect.php');

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Prepare and bind the SQL statement
    $stmt = $conn->prepare("INSERT INTO users (name, username, password, type) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("sssi", $name, $username, $password, $type);

    // Set parameters from the form data
    $name = $_POST['name'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $type = $_POST['type'];

    // Execute the prepared statement
    if ($stmt->execute()) {
        
        echo "signup sucessfull";


    } else {
        echo 0; // Error response
    }

    // Close statement and connection
    $stmt->close();
    $conn->close();
}
?>
