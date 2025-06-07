<?php
session_start();
include 'db.php';

// Handle order deletion
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_order_id'])) {
    $order_id = intval($_POST['delete_order_id']);
    $conn->query("DELETE FROM orders WHERE id = $order_id");
    // Refresh to show updated orders
    header("Location: myorders.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Orders</title>
    <link rel="stylesheet" href="../css/myorders.css">
</head>

<body>
    <div class="container">
        <a href="Home_Page.php" class="home-btn" style="display:inline-block;margin-bottom:20px;padding:10px 20px;background:#b22222;color:#fff;border-radius:5px;text-decoration:none;font-weight:bold;">Home</a>
        <h1>My Orders</h1>
        <form method="POST">
            <input type="email" name="user_email" placeholder="Enter your email" required>
            <button type="submit">Show My Orders</button>
        </form>

        <?php
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['user_email'])) {
            // Store email in session for download verification
            $_SESSION['user_email'] = $_POST['user_email'];
            
            $email = $conn->real_escape_string($_POST['user_email']);
            $sql = "SELECT * FROM orders WHERE user_email = '$email'";
            $result = $conn->query($sql);

            if ($result && $result->num_rows > 0) {
                echo '<div class="orders"><table>
                        <tr>
                            <th>Pizza</th>
                            <th>Size</th>
                            <th>Crust</th>
                            <th>Price</th>
                            <th>Payment</th>
                            <th>Address</th>
                            <th>Instructions</th>
                            <th>Promo</th>
                            <th>Bill</th>
                        </tr>';
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                        <td>" . htmlspecialchars($row['pizza_name']) . "</td>
                        <td>" . htmlspecialchars($row['size']) . "</td>
                        <td>" . htmlspecialchars($row['crust']) . "</td>
                        <td>" . htmlspecialchars($row['price']) . " JD</td>
                        <td>" . htmlspecialchars($row['payment_method']) . "</td>
                        <td>" . htmlspecialchars($row['address']) . "</td>
                        <td>" . htmlspecialchars($row['instructions']) . "</td>
                        <td>" . htmlspecialchars($row['promo_code']) . "</td>
                        <td>
                            <form method='GET' action='download_bill.php' style='display:inline;'>
                                <input type='hidden' name='order_id' value='" . $row['id'] . "'>
                                <button type='submit'>Download</button>
                            </form>
                            <form method='POST' style='display:inline; margin-left:5px;'>
                                <input type='hidden' name='delete_order_id' value='" . $row['id'] . "'>
                                <button type='submit' onclick=\"return confirm('Are you sure you want to delete this order?');\">Delete</button>
                            </form>
                        </td>
                    </tr>";
                }
                echo '</table></div>';
            } else {
                echo '<p class="error">No orders found for this email.</p>';
            }
        }
        ?>
    </div>
</body>
</html>