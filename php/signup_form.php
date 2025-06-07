<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Sign Up</title>
    <link rel="stylesheet" href="..\css\signup_style.css">
    
</head>
<body>

<div class="container">
    <h2>Sign Up</h2>

    <?php
    if (isset($_SESSION['error'])) {
        echo '<p style="color:red; font-weight:bold;">' . $_SESSION['error'] . '</p>';
        unset($_SESSION['error']);
    }

    $form_data = $_SESSION['form_data'] ?? ['username' => '', 'email' => ''];
    unset($_SESSION['form_data']);
?>

    <form id="form" action="signup.php" method="POST" onsubmit="return validateForm()">
        <input type="text" name="username" placeholder="Username" value="<?= htmlspecialchars($form_data['username']) ?>" required /><br>
        <input type="email" name="email" placeholder="Email"  value="<?= htmlspecialchars($form_data['email']) ?>" required /><br>
        <input type="password" id="password" name="password" placeholder="Password" required /><br>
        <input type="password" id="confirm_password" name="confirm_password" placeholder="Confirm Password" required /><br><br>
        <button type="submit">Sign Up</button><br><br>
        
    </form>
    <button id="go_back" type="button"  onclick="window.location.href='index.php'" >Go Back </button>
    
 </div>

</body>
</html>