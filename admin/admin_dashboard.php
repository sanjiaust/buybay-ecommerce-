<?php
session_start();
include('../server/connection.php');

if (!isset($_SESSION['admin_logged_in'])) {
    header('location: admin_login.php');
    exit;
}

// Handle delete action
if (isset($_GET['delete'])) {
    $order_id = $_GET['delete'];

    // Prepare and execute the delete statement
    $stmt = $conn->prepare("DELETE FROM orders WHERE order_id=?");
    $stmt->bind_param('i', $order_id);

    if ($stmt->execute()) {
        header('Location: admin_dashboard.php?message=Order deleted successfully');
    } else {
        header('Location: admin_dashboard.php?message=Error deleting order');
    }
    exit;
}

// Pagination setup
$limit = 10; // Number of orders per page
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$start = ($page - 1) * $limit;

// Fetch total number of orders
$result = $conn->query("SELECT COUNT(*) AS total FROM orders");
$row = $result->fetch_assoc();
$total_orders = $row['total'];
$total_pages = ceil($total_orders / $limit);

// Fetch orders with pagination
$query = "SELECT * FROM orders LIMIT ?, ?";
$stmt = $conn->prepare($query);
$stmt->bind_param('ii', $start, $limit);
$stmt->execute();
$result = $stmt->get_result();
?>

<?php include('HD_SD.php'); ?>

            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <h2>Admin Dashboard</h2>
                <p>Welcome, <?php echo htmlspecialchars($_SESSION['admin_name']); ?>!</p>

                <?php if (isset($_GET['message'])): ?>
                    <div class="alert alert-info alert-dismissible fade show" role="alert">
                        <?php echo htmlspecialchars($_GET['message']); ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif; ?>

                <table class="table table-striped table-sm">
                    <thead>
                        <tr>
                            <th scope="col">Order ID</th>
                            <th scope="col">Order Status</th>
                            <th scope="col">User ID</th>
                            <th scope="col">Order Date</th>
                            <th scope="col">User Phone</th>
                            <th scope="col">Address</th>
                            <th scope="col">Edit</th>
                            <th scope="col">Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = $result->fetch_assoc()): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($row['order_id']); ?></td>
                                <td><?php echo htmlspecialchars($row['order_status']); ?></td>
                                <td><?php echo htmlspecialchars($row['user_id']); ?></td>
                                <td><?php echo htmlspecialchars($row['order_date']); ?></td>
                                <td><?php echo htmlspecialchars($row['user_phone']); ?></td>
                                <td><?php echo htmlspecialchars($row['user_address']); ?></td>
                                <td><a href="edit_order.php?order_id=<?php echo htmlspecialchars($row['order_id']); ?>" class="btn btn-warning btn-sm">Edit</a></td>
                                <td><a href="admin_orders.php?delete=<?php echo htmlspecialchars($row['order_id']); ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this order?')">Delete</a></td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>

                <nav aria-label="Page navigation">
                    <ul class="pagination justify-content-center">
                        <?php if ($page > 1): ?>
                            <li class="page-item"><a class="page-link" href="?page=<?php echo $page - 1; ?>">Previous</a></li>
                        <?php endif; ?>
                        <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                            <li class="page-item <?php if ($page == $i) echo 'active'; ?>"><a class="page-link" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
                        <?php endfor; ?>
                        <?php if ($page < $total_pages): ?>
                            <li class="page-item"><a class="page-link" href="?page=<?php echo $page + 1; ?>">Next</a></li>
                        <?php endif; ?>
                    </ul>
                </nav>
            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
