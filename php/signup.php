<?php
session_start();
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $conn->real_escape_string($_POST['username']);
    $email = $conn->real_escape_string($_POST['email']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    
    if ($password !== $confirm_password) {
        $_SESSION['error'] = "Passwords do not match.";
        $_SESSION['form_data'] = [
            'username' => $_POST['username'],
            'email' => $_POST['email']
        ];
        header("Location:  signup_form.php");
        exit();
    }

    
    $sql_check = "SELECT * FROM users WHERE username='$username'";
    $result = $conn->query($sql_check);

    if ($result->num_rows > 0) {
        $_SESSION['error'] = "Username is already taken, please choose another.";
        header("Location: signup_form.php");
         $_SESSION['form_data'] = [
            'username' => $_POST['username'],
            'email' => $_POST['email']
        ];
        exit();
    }

    $sql_check = "SELECT * FROM users WHERE email='$email'";
    $result = $conn->query($sql_check);
    if ($result->num_rows > 0) {
        $_SESSION['error'] = "Email is already used.";
         $_SESSION['form_data'] = [
            'username' => $_POST['username'],
            'email' => $_POST['email']
        ];
        header("Location: signup_form.php");
        exit();
    }
    
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $sql_insert = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$hashed_password')";

    if ($conn->query($sql_insert) === TRUE) {
        unset($_SESSION['error']);
        header("Location: index.php"); 
        exit();
    } else {
        $_SESSION['error'] = "Error: " . $conn->error;
        header("Location: signup_form.php");
        exit();
    }
}
?>
