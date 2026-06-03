<?php
session_start();
include('../server/connection.php');

if (!isset($_SESSION['admin_logged_in'])) {
    header('location: admin_login.php');
    exit;
}

if (isset($_GET['order_id'])) {
    $order_id = $_GET['order_id'];

    $query = "DELETE FROM orders WHERE order_id=?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('i', $order_id);

    if ($stmt->execute()) {
        header('location: admin_dashboard.php?message=Order deleted successfully');
    } else {
        header('location: admin_dashboard.php?message=Error deleting order');
    }
} else {
    header('location: admin_dashboard.php');
}
?>
