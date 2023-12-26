<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = password_hash($_POST["psw"], PASSWORD_BCRYPT); // Hash the password for security

    // Database connection (adjust the credentials as needed)
    $conn = new mysqli("localhost", "root", "", "travel_users");

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Insert user data into the database
    $sql = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$password')";

    if ($conn->query($sql) === TRUE) {
        // Redirect to the login page upon successful registration
        header("Location: login.html");
        exit; // Ensure no further code execution after the redirect
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
