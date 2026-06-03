<?php
session_start();
include('../server/connection.php');

// Check if admin is logged in
if (!isset($_SESSION['admin_logged_in'])) {
    header('location:admin_login.php');
    exit;
}

// Pagination settings
$limit = 10; // Number of orders per page
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $limit;

// Get total number of orders
$result = $conn->query("SELECT COUNT(*) as total FROM orders");
$row = $result->fetch_assoc();
$total_orders = $row['total'];
$total_pages = ceil($total_orders / $limit);

// Fetch orders for the current page with user details
$stmt = $conn->prepare("
    SELECT o.order_id, o.order_cost, o.order_status, o.user_id, o.user_phone, u.user_name, o.user_address, o.order_date
    FROM orders o
    JOIN users u ON o.user_id = u.user_id
    LIMIT ?, ?
");
$stmt->bind_param('ii', $offset, $limit);
$stmt->execute();
$orders = $stmt->get_result();

// Handle delete order action
if (isset($_GET['delete'])) {
    $order_id = $_GET['delete'];
    $stmt = $conn->prepare("DELETE FROM orders WHERE order_id = ?");
    $stmt->bind_param('i', $order_id);
    if ($stmt->execute()) {
        header('Location: admin_orders.php?message=Order deleted successfully');
        exit;
    } else {
        echo "Error deleting order.";
    }
}

// Handle update order action
if (isset($_POST['update'])) {
    $order_id = $_POST['order_id'];
    $order_cost = $_POST['order_cost'];
    $order_status = $_POST['order_status'];
    $user_phone = $_POST['user_phone'];
    $user_address = $_POST['user_address'];
    
    // Prepare and execute the update statement
    $stmt = $conn->prepare("UPDATE orders SET order_cost = ?, order_status = ?, user_phone = ?, user_address = ? WHERE order_id = ?");
    $stmt->bind_param('dsssi', $order_cost, $order_status, $user_phone, $user_address, $order_id);
    
    if ($stmt->execute()) {
        header('Location: admin_orders.php?message=Order updated successfully');
        exit;
    } else {
        echo "Error updating order.";
    }
}

// Get the order to edit if 'edit' parameter is set
$order_to_edit = null;
if (isset($_GET['edit'])) {
    $edit_order_id = $_GET['edit'];
    $stmt = $conn->prepare("SELECT * FROM orders WHERE order_id = ?");
    $stmt->bind_param('i', $edit_order_id);
    $stmt->execute();
    $order_to_edit = $stmt->get_result()->fetch_assoc();
}

// Close connection
$stmt->close();
$conn->close();
?>

<?php include('HD_SD.php'); ?>

            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <h2>Orders</h2>
                <?php if (isset($_GET['message'])): ?>
                    <div class="alert alert-success" role="alert">
                        <?php echo $_GET['message']; ?>
                    </div>
                <?php endif; ?>

                <?php if ($order_to_edit): ?>
                    <div class="mb-4">
                        <h3>Edit Order</h3>
                        <form action="admin_orders.php" method="post">
                            <input type="hidden" name="order_id" value="<?php echo $order_to_edit['order_id']; ?>">
                            <div class="mb-3">
                                <label for="order_cost" class="form-label">Order Cost</label>
                                <input type="text" id="order_cost" name="order_cost" value="<?php echo $order_to_edit['order_cost']; ?>" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="order_status" class="form-label">Order Status</label>
                                <input type="text" id="order_status" name="order_status" value="<?php echo $order_to_edit['order_status']; ?>" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="user_phone" class="form-label">User Phone</label>
                                <input type="text" id="user_phone" name="user_phone" value="<?php echo $order_to_edit['user_phone']; ?>" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="user_address" class="form-label">User Address</label>
                                <input type="text" id="user_address" name="user_address" value="<?php echo $order_to_edit['user_address']; ?>" class="form-control">
                            </div>
                            <button type="submit" name="update" class="btn btn-primary">Update Order</button>
                        </form>
                    </div>
                <?php endif; ?>

                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Order ID</th>
                            <th>Order Price</th>
                            <th>Order Status</th>
                            <th>User ID</th>
                            <th>User Name</th>
                            <th>User Phone</th>
                            <th>User Address</th>
                            <th>Order Date</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($order = $orders->fetch_assoc()): ?>
                            <tr>
                                <td><?php echo $order['order_id']; ?></td>
                                <td><?php echo $order['order_cost']; ?></td>
                                <td><?php echo $order['order_status']; ?></td>
                                <td><?php echo $order['user_id']; ?></td>
                                <td><?php echo $order['user_name']; ?></td>
                                <td><?php echo $order['user_phone']; ?></td>
                                <td><?php echo $order['user_address']; ?></td>
                                <td><?php echo $order['order_date']; ?></td>
                                <td>
                                    <a href="admin_orders.php?edit=<?php echo $order['order_id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                                </td>
                                <td>
                                    <a href="admin_orders.php?delete=<?php echo $order['order_id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this order?')">Delete</a>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>

                <nav>
                    <ul class="pagination">
                        <li class="page-item <?php echo ($page <= 1) ? 'disabled' : ''; ?>">
                            <a class="page-link" href="?page=<?php echo ($page - 1); ?>">Previous</a>
                        </li>
                        <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                            <li class="page-item <?php echo ($i == $page) ? 'active' : ''; ?>">
                                <a class="page-link" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                            </li>
                        <?php endfor; ?>
                        <li class="page-item <?php echo ($page >= $total_pages) ? 'disabled' : ''; ?>">
                            <a class="page-link" href="?page=<?php echo ($page + 1); ?>">Next</a>
                        </li>
                    </ul>
                </nav>
            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>