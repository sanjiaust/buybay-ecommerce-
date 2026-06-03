<?php
session_start();
include('../server/connection.php');

// Check if admin is logged in
if (!isset($_SESSION['admin_logged_in'])) {
    header('location:admin_login.php');
    exit;
}

// Pagination settings
$limit = 10; // Number of products per page
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $limit;

// Get total number of products
$result = $conn->query("SELECT COUNT(*) as total FROM products");
$row = $result->fetch_assoc();
$total_products = $row['total'];
$total_pages = ceil($total_products / $limit);

// Fetch products for the current page
$stmt = $conn->prepare("SELECT product_id, product_name, product_image, product_price, product_category, product_description FROM products LIMIT ?, ?");
$stmt->bind_param('ii', $offset, $limit);
$stmt->execute();
$products = $stmt->get_result();

// Handle delete product action
if (isset($_GET['delete'])) {
    $product_id = $_GET['delete'];
    $stmt = $conn->prepare("DELETE FROM products WHERE product_id = ?");
    $stmt->bind_param('i', $product_id);
    if ($stmt->execute()) {
        header('Location: admin_products.php?message=Product deleted successfully');
        exit;
    } else {
        echo "Error deleting product.";
    }
}

// Close connection
$stmt->close();
$conn->close();
?>

<?php include('HD_SD.php'); ?>

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <h2>Products</h2>
    <?php if (isset($_GET['message'])): ?>
        <div class="alert alert-success" role="alert">
            <?php echo $_GET['message']; ?>
        </div>
    <?php endif; ?>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Product ID</th>
                <th>Name</th>
                <th>Image</th>
                <th>Price</th>
                <th>Category</th>
                <th>Description</th>
                <th>Edit</th>
                <th>Edit Image</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($product = $products->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $product['product_id']; ?></td>
                    <td><?php echo $product['product_name']; ?></td>
                    <td><img src="../assets/imgs/<?php echo $product['product_image']; ?>" alt="<?php echo $product['product_name']; ?>" width="100"></td>
                    <td><?php echo $product['product_price']; ?></td>
                    <td><?php echo $product['product_category']; ?></td>
                    <td><?php echo $product['product_description']; ?></td>
                    <td><a href="edit_products.php?id=<?php echo $product['product_id']; ?>" class="btn btn-warning btn-sm">Edit</a></td>
                    <td><a href="edit_images.php?id=<?php echo $product['product_id']; ?>" class="btn btn-info btn-sm">Edit Image</a></td>
                    <td><a href="admin_products.php?delete=<?php echo $product['product_id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this product?')">Delete</a></td>
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
