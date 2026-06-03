<?php
session_start();
include('../server/connection.php');

if (!isset($_SESSION['admin_logged_in'])) {
    header('location: admin_login.php');
    exit;
}

if (isset($_POST['order_id'])) {
    $order_id = $_POST['order_id'];
    $order_status = $_POST['order_status'];
    $user_phone = $_POST['user_phone'];
    $user_address = $_POST['user_address'];

    // Prepare and execute the update statement
    $stmt = $conn->prepare("UPDATE orders SET order_status = ?, user_phone = ?, user_address = ? WHERE order_id = ?");
    $stmt->bind_param('sssi', $order_status, $user_phone, $user_address, $order_id);

    if ($stmt->execute()) {
        header('Location: admin_dashboard.php?message=Order updated successfully');
    } else {
        header('Location: admin_dashboard.php?message=Error updating order');
    }
    exit;
} else {
    header('Location: admin_dashboard.php');
    exit;
}
