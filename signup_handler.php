<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup Page</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        
        <!-- PHP Code -->
        <?php
        // Include database connection
        include('admin/db_connect.php');

        // Check if form is submitted
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Prepare and bind the SQL statement
            $stmt = $conn->prepare("INSERT INTO users (name, address, contact, username, password, type) VALUES (?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("ssssss", $name, $address, $contact, $username, $password, $type);

            // Set parameters from the form data
            $name = $_POST['name'];
            $address = $_POST['address'];
            $contact = $_POST['contact'];
            $username = $_POST['username'];
            $password = $_POST['password'];
            $type = $_POST['type'];
            
            
            // Check if the username already exists
            $check_stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
            $check_stmt->bind_param("s", $username);
            $check_stmt->execute();
            $result = $check_stmt->get_result();

            if ($result->num_rows > 0) {
                // Username already exists, display error message and a button to redirect to login page
                echo '<div class="alert alert-danger" role="alert">
                        User with the same username already exists! Please login or try a different username.
                      </div>';
                echo '<a href="login.php" class="btn btn-primary">Login</a>';
            } else {
                // Execute the prepared statement to insert the new user
                if ($stmt->execute()) {
                    // Success message with Bootstrap alert component
                    $success_message = '
                    <div class="alert alert-success" role="alert">
                        <h4 class="alert-heading">Signup Successful!</h4>
                        <p>Thank you for signing up. Click <a href="login.php" class="alert-link">here</a> to login now.</p>
                    </div>';
                    // Output the success message
                    echo $success_message;
                } else {
                    // Display error message if execution fails
                    echo '<div class="alert alert-danger" role="alert">
                            Error occurred while signing up. Please try again later.
                          </div>';


                }
            }

            // Close statements and connection
            $check_stmt->close();
            $stmt->close();
            $conn->close();
        }
        ?>
    </div>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
