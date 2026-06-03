<?php
session_start();
include('../server/connection.php');

// Check if admin is logged in
if (!isset($_SESSION['admin_logged_in'])) {
    header('location:admin_login.php');
    exit;
}

// Fetch product details if editing
$product = null;
if (isset($_GET['id'])) {
    $product_id = $_GET['id'];
    $stmt = $conn->prepare("SELECT product_id, product_image, product_image2, product_image3, product_image4 FROM products WHERE product_id = ?");
    $stmt->bind_param('i', $product_id);
    $stmt->execute();
    $product = $stmt->get_result()->fetch_assoc();
}

// Handle image update
if (isset($_POST['update_images'])) {
    $product_id = $_POST['product_id'];
    $product_image1 = $_POST['product_image1'];
    $product_image2 = $_POST['product_image2'];
    $product_image3 = $_POST['product_image3'];
    $product_image4 = $_POST['product_image4'];

    $stmt = $conn->prepare("UPDATE products SET product_image = ?, product_image2 = ?, product_image3 = ?, product_image4 = ? WHERE product_id = ?");
    $stmt->bind_param('ssssi', $product_image1, $product_image2, $product_image3, $product_image4, $product_id);
    if ($stmt->execute()) {
        header('Location: admin_products.php?message=Images updated successfully');
        exit;
    } else {
        echo "Error updating images.";
    }
}

// Close connection
$stmt->close();
$conn->close();
?>

<?php include('HD_SD.php'); ?>
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <h2>Edit Product Images</h2>
                <form action="edit_images.php" method="POST">
                    <input type="hidden" name="product_id" value="<?php echo $product ? $product['product_id'] : ''; ?>">
                    <div class="mb-3">
                        <label for="product_image1" class="form-label">Image 1</label>
                        <input type="text" class="form-control" id="product_image1" name="product_image1" value="<?php echo $product ? $product['product_image'] : ''; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="product_image2" class="form-label">Image 2</label>
                        <input type="text" class="form-control" id="product_image2" name="product_image2" value="<?php echo $product ? $product['product_image2'] : ''; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="product_image3" class="form-label">Image 3</label>
                        <input type="text" class="form-control" id="product_image3" name="product_image3" value="<?php echo $product ? $product['product_image3'] : ''; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="product_image4" class="form-label">Image 4</label>
                        <input type="text" class="form-control" id="product_image4" name="product_image4" value="<?php echo $product ? $product['product_image4'] : ''; ?>" required>
                    </div>
                    <button type="submit" name="update_images" class="btn btn-primary">Save Changes</button>
                </form>
            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
