<?php
session_start();

// Database connection
$con = new mysqli('localhost', 'root', '', 'blood_bank');

// Check connection
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

// Retrieve and sanitize inputs
$user = isset($_POST['user']) ? $con->real_escape_string($_POST['user']) : '';
$password = isset($_POST['pass']) ? $_POST['pass'] : '';
$confirmnewpassword = isset($_POST['confirmnewpassword']) ? $_POST['confirmnewpassword'] : '';

if (empty($user) || empty($password) || empty($confirmnewpassword)) {
    echo "All fields are required.";
    exit;
}

// Fetch the user's current password
$sql = "SELECT pass FROM user_info WHERE user_id = ?";
$stmt = $con->prepare($sql);
$stmt->bind_param("s", $user);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo "The username you entered does not exist.";
} else {
    $row = $result->fetch_assoc();
    $stored_password = $row['pass'];

    // Verify the entered password
    if (!password_verify($password, $stored_password)) {
        echo "You entered an incorrect password.";
    } else {
        // Check if new password matches confirmation
        if ($password === $confirmnewpassword) {
            echo "New password cannot be the same as the current password.";
        } elseif ($confirmnewpassword !== $password) {
            $new_password_hashed = password_hash($confirmnewpassword, PASSWORD_DEFAULT);
            
            // Update the password in the database
            $update_sql = "UPDATE user_info SET pass = ? WHERE user_id = ?";
            $update_stmt = $con->prepare($update_sql);
            $update_stmt->bind_param("ss", $new_password_hashed, $user);
            if ($update_stmt->execute()) {
                echo "Congratulations! You have successfully changed your password.";
            } else {
                echo "Error updating password. Please try again.";
            }
        } else {
            echo "Passwords do not match.";
        }
    }
}

// Close database connection
$con->close();
?>
