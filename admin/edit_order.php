<?php
session_start();
include('../server/connection.php');

if (!isset($_SESSION['admin_logged_in'])) {
    header('location: admin_login.php');
    exit;
}

if (isset($_GET['order_id'])) {
    $order_id = $_GET['order_id'];

    // Fetch the order details
    $query = "SELECT * FROM orders WHERE order_id=?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('i', $order_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $order = $result->fetch_assoc();
} else {
    header('location: admin_dashboard.php');
    exit;
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Order</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Edit Order</h2>

        <?php if (isset($_GET['message'])): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?php echo htmlspecialchars($_GET['message']); ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <form action="edit_order_process.php" method="post">
            <input type="hidden" name="order_id" value="<?php echo $order['order_id']; ?>">
            <div class="mb-3">
                <label for="order_status" class="form-label">Order Status</label>
                <input type="text" class="form-control" id="order_status" name="order_status" value="<?php echo htmlspecialchars($order['order_status']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="user_phone" class="form-label">User Phone</label>
                <input type="text" class="form-control" id="user_phone" name="user_phone" value="<?php echo htmlspecialchars($order['user_phone']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="user_address" class="form-label">User Address</label>
                <input type="text" class="form-control" id="user_address" name="user_address" value="<?php echo htmlspecialchars($order['user_address']); ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Update Order</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
