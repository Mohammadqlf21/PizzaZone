<?php
session_start();
include 'db.php';
header('Content-Type: application/json');

$user_email = $_SESSION['user_email'] ?? null;


// Get POST data
$name = $_POST['pizza_name'] ?? '';
$size = $_POST['size'] ?? '';
$crust = $_POST['crust'] ?? '';
$price =(float)($_POST['price'] ?? 0);
$address = $_POST['address'] ?? '';
$payment = $_POST['payment_method'] ?? '';
$instructions = $_POST['instructions'] ?? null;
$promoCode = $_POST['promo_code'] ?? null;


$promoCode = $promoCode ? strtoupper(trim($promoCode)) : null;
if ($promoCode) {
    if ($promoCode === 'BIG20') {
        $price = $price * 0.8; // 20% off
    } elseif ($promoCode === 'WELCOME10') {
        $price = $price * 0.9; // 10% off
    }
    // Add more promo codes as needed
}

$stmt = $conn->prepare("INSERT INTO orders (user_email ,pizza_name, size, crust, price, address, payment_method, instructions, promo_code) VALUES (?,?, ?, ?, ?, ?, ?, ?, ?)");

if (!$stmt) {
    echo json_encode(['status' => 'error', 'message' => 'Prepare failed: ' . $conn->error]);
    exit();
}

$stmt->bind_param("ssssdssss",   $user_email ,$name, $size, $crust, $price, $address, $payment, $instructions, $promoCode);

if ($stmt->execute()) {
    echo json_encode(['status' => 'success']);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Execute failed: ' . $stmt->error]);
}

$stmt->close();
$conn->close();
?>
