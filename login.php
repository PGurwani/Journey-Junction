<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Database connection (adjust the credentials as needed)
    $conn = new mysqli("localhost", "root", "", "travel_users");

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Check if the user exists
    $sql = "SELECT * FROM users WHERE username = '$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row["password"])) {
            // Successful login
            header("Location: explore.html"); // Redirect to the explore page or any other page
        } else {
            echo "Incorrect password";
        }
    } else {
        echo "User not found";
    }

    $conn->close();
}
?>
