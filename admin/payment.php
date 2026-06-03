<?php
session_start();
include('../server/connection.php');

// Check if admin is logged in
if (!isset($_SESSION['admin_logged_in'])) {
    header('location:admin_login.php');
    exit;
}

// Pagination settings
$limit = 10; // Number of payments per page
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $limit;

// Get total number of payments
$result = $conn->query("SELECT COUNT(*) as total FROM payment");
$row = $result->fetch_assoc();
$total_payments = $row['total'];
$total_pages = ceil($total_payments / $limit);

// Fetch payments for the current page with user details
$stmt = $conn->prepare("
    SELECT p.payment_id, p.order_id, p.payment_amount, p.payment_date, u.user_id, u.user_name
    FROM payment p
    JOIN users u ON p.user_id = u.user_id
    ORDER BY p.payment_id DESC
    LIMIT ?, ?
");
$stmt->bind_param('ii', $offset, $limit);
$stmt->execute();
$payments = $stmt->get_result();

// Close statement
$stmt->close();

// Close connection
$conn->close();
?>

<?php include('HD_SD.php'); ?>

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <h2>Payments</h2>
    <?php if ($payments->num_rows > 0): ?>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Payment ID</th>
                    <th>Order ID</th>
                    <th>Payment Amount</th>
                    <th>Payment Date</th>
                    <th>User ID</th>
                    <th>User Name</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($payment = $payments->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $payment['payment_id']; ?></td>
                        <td><?php echo $payment['order_id']; ?></td>
                        <td>$<?php echo number_format($payment['payment_amount'], 2); ?></td>
                        <td><?php echo $payment['payment_date']; ?></td>
                        <td><?php echo $payment['user_id']; ?></td>
                        <td><?php echo $payment['user_name']; ?></td>
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
    <?php else: ?>
        <div class="alert alert-warning" role="alert">
            No payment records found.
        </div>
    <?php endif; ?>
</main>
