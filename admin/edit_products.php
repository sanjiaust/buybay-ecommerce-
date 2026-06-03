<?php
session_start();
include('../server/connection.php');

// Check if admin is logged in
if (!isset($_SESSION['admin_logged_in'])) {
    header('location:admin_login.php');
    exit;
}

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

// Handle edit product action
if (isset($_POST['update'])) {
    $product_id = $_POST['product_id'];
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $product_category = $_POST['product_category'];
    $product_description = $_POST['product_description'];

    $stmt = $conn->prepare("UPDATE products SET product_name = ?, product_price = ?, product_category = ?, product_description = ? WHERE product_id = ?");
    $stmt->bind_param('sissi', $product_name, $product_price, $product_category, $product_description, $product_id);
    if ($stmt->execute()) {
        header('Location: admin_products.php?message=Product updated successfully');
        exit;
    } else {
        echo "Error updating product.";
    }
}

// Fetch product details if editing
$product = null;
if (isset($_GET['id'])) {
    $product_id = $_GET['id'];
    $stmt = $conn->prepare("SELECT product_id, product_name, product_price, product_category, product_description FROM products WHERE product_id = ?");
    $stmt->bind_param('i', $product_id);
    $stmt->execute();
    $product = $stmt->get_result()->fetch_assoc();
}

// Close connection
$conn->close();
?>

<?php include('HD_SD.php'); ?>

            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <h2><?php echo $product ? 'Edit Product' : 'Add New Product'; ?></h2>
                <form action="edit_products.php" method="POST">
                    <input type="hidden" name="product_id" value="<?php echo $product ? $product['product_id'] : ''; ?>">
                    <div class="mb-3">
                        <label for="product_name" class="form-label">Product Name</label>
                        <input type="text" class="form-control" id="product_name" name="product_name" value="<?php echo $product ? $product['product_name'] : ''; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="product_price" class="form-label">Product Price</label>
                        <input type="number" step="0.01" class="form-control" id="product_price" name="product_price" value="<?php echo $product ? $product['product_price'] : ''; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="product_category" class="form-label">Product Category</label>
                        <input type="text" class="form-control" id="product_category" name="product_category" value="<?php echo $product ? $product['product_category'] : ''; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="product_description" class="form-label">Product Description</label>
                        <textarea class="form-control" id="product_description" name="product_description" rows="3" required><?php echo $product ? $product['product_description'] : ''; ?></textarea>
                    </div>
                    <button type="submit" name="update" class="btn btn-primary">Save Changes</button>
                </form>
            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
