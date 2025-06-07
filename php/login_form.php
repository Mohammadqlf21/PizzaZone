<?php session_start(); ?>
<html>

<head>

    <title>Login</title>

</head>

<body>
    <?php
if (isset($_SESSION['error'])) {
    echo '<p style="color:red; font-weight:bold;">' . $_SESSION['error'] . '</p>';
    unset($_SESSION['error']);
}
?>

    <h2>Login</h2>
    <form action="login.php" method="POST">
        <?php include 'db.php'; ?>
        <input type="email" name="email" placeholder="Email" value="<?= htmlspecialchars($form_data['email']) ?>" required><br><br>
        <input type="password" name="password" placeholder="Password" required><br><br>
        <button type="submit">Login</button>
</form>

</body>
</html>