<?php
session_start();
include 'db.php'; 

if (!isset($_GET['order_id'])) {
    die('Order ID not specified.');
}

$order_id = intval($_GET['order_id']);



$user_email = $_SESSION['user_email'];

// Fetch order info for this user and order id
$stmt = $conn->prepare("SELECT * FROM orders WHERE id = ? AND user_email = ?");
$stmt->bind_param("is", $order_id, $user_email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    die('Order not found or access denied.');
}

$order = $result->fetch_assoc();

// Prepare bill content
$bill = "----- Pizza Order Bill -----\n";
$bill .= "Order ID: " . $order['id'] . "\n";
$bill .= "Pizza: " . $order['pizza_name'] . "\n";
$bill .= "Size: " . $order['size'] . "\n";
$bill .= "Crust: " . $order['crust'] . "\n";
$bill .= "Price: " . number_format($order['price'], 2) . " JD\n";
$bill .= "Delivery Address: " . $order['address'] . "\n";
$bill .= "Payment Method: " . ucfirst($order['payment_method']) . "\n";
$bill .= "Order Date: " . $order['created_at'] . "\n";

if (!empty($order['instructions'])) {
    $bill .= "Special Instructions: " . $order['instructions'] . "\n";
}

if (!empty($order['promo_code'])) {
    $bill .= "Promo Code: " . $order['promo_code'] . "\n";
}

// Include order date since you've added the column
$bill .= "Order Date: " . $order['created_at'] . "\n";

$bill .= "---------------------------\n";
$bill .= "Thank you for ordering with Pizza Zone!\n";

header('Content-Type: text/plain');
header('Content-Disposition: attachment; filename="order_' . $order_id . '_bill.txt"');
header('Content-Length: ' . strlen($bill));

echo $bill;
exit;
?>