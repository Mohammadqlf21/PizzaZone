<?php
session_start();
include 'db.php';  

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $conn->real_escape_string($_POST['email']);
    $password = $_POST['password'];

    
    $sql = "SELECT * FROM users WHERE email='$email'";
    $result = $conn->query($sql);

    if ($result->num_rows == 0) {
        
        $_SESSION['login_error'] = "No email registered.";
        $_SESSION['form_data'] = [
            'email' => $_POST['email']
        ];
        header("Location: index.php");
        exit();
    }

    $user = $result->fetch_assoc();

    /* 
        
        $user['id']
        $user['email']
        $user['password']
        It "fetches" the info from the result and puts it into the $user array 

    */

    if (!password_verify($password, $user['password'])) {
        
        $_SESSION['login_error'] = "Wrong credentials.";
        $_SESSION['form_data'] = [
            'email' => $_POST['email']
        ];
        header("Location: index.php");
        exit();
    }
    
    $_SESSION['user_id'] = $user['id']; 
    $_SESSION['user_email'] = $user['email'];

    error_log("User logged in: " . $user['email']);

    header("Location: Home_Page.php");
    exit();
}
?>
