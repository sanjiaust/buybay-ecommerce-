<?php
session_start();
include('../server/connection.php');

if (!isset($_SESSION['admin_logged_in'])) {
    header('location: admin_login.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $product_name = $_POST['product_name'];
    $product_category = $_POST['product_category'];
    $product_description = $_POST['product_description'];
    $product_price = $_POST['product_price'];
    $product_special_offer = isset($_POST['product_special_offer']) ? $_POST['product_special_offer'] : 0;
    $product_color = $_POST['product_color'];

    $target_dir = "../assets/imgs/";
    $uploadOk = 1;
    $images = ['product_image', 'product_image2', 'product_image3', 'product_image4'];
    $uploaded_files = [];

    foreach ($images as $image) {
        if (!empty($_FILES[$image]['name'])) {
            $file_name = basename($_FILES[$image]['name']);
            $imageFileType = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
            $check = getimagesize($_FILES[$image]['tmp_name']);

            if ($check === false) {
                echo "File is not an image.";
                $uploadOk = 0;
                break;
            }

            if ($_FILES[$image]['size'] > 5000000) {
                echo "Sorry, your file is too large.";
                $uploadOk = 0;
                break;
            }

            if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
                echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                $uploadOk = 0;
                break;
            }

            if ($uploadOk) {
                if (move_uploaded_file($_FILES[$image]['tmp_name'], $target_dir . $file_name)) {
                    $uploaded_files[$image] = $file_name;
                } else {
                    echo "Sorry, there was an error uploading your file.";
                    $uploadOk = 0;
                    break;
                }
            }
        } else {
            $uploaded_files[$image] = ''; // Handle cases where some images are not provided
        }
    }

    if ($uploadOk) {
        $stmt = $conn->prepare("INSERT INTO products (product_name, product_category, product_description, product_image, product_image2, product_image3, product_image4, product_price, product_special_offer, product_color) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param('ssssssssis', $product_name, $product_category, $product_description, $uploaded_files['product_image'], $uploaded_files['product_image2'], $uploaded_files['product_image3'], $uploaded_files['product_image4'], $product_price, $product_special_offer, $product_color);

        if ($stmt->execute()) {
            header('Location: admin_products.php?message=Product added successfully');
            exit;
        } else {
            echo "Error adding product: " . $stmt->error;
        }
        $stmt->close();
    }
    $conn->close();
}
?>

<?php include('HD_SD.php'); ?>

            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <h2>Add New Product</h2>
                
                <?php if (isset($_GET['message'])): ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <?php echo htmlspecialchars($_GET['message']); ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif; ?>

                <form action="add_product.php" method="post" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="product_name" class="form-label">Product Name</label>
                        <input type="text" class="form-control" id="product_name" name="product_name" required>
                    </div>
                    <div class="mb-3">
                        <label for="product_category" class="form-label">Product Category</label>
                        <input type="text" class="form-control" id="product_category" name="product_category" required>
                    </div>
                    <div class="mb-3">
                        <label for="product_description" class="form-label">Product Description</label>
                        <textarea class="form-control" id="product_description" name="product_description" rows="3" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="product_price" class="form-label">Product Price</label>
                        <input type="number" step="0.01" class="form-control" id="product_price" name="product_price" required>
                    </div>
                    <div class="mb-3">
                        <label for="product_special_offer" class="form-label">Special Offer (Optional)</label>
                        <input type="number" class="form-control" id="product_special_offer" name="product_special_offer" min="0">
                    </div>
                    <div class="mb-3">
                        <label for="product_color" class="form-label">Product Color</label>
                        <input type="text" class="form-control" id="product_color" name="product_color" required>
                    </div>
                    <div class="mb-3">
                        <label for="product_image" class="form-label">Image 1</label>
                        <input type="file" class="form-control" id="product_image" name="product_image" accept="image/*" required>
                    </div>
                    <div class="mb-3">
                        <label for="product_image2" class="form-label">Image 2</label>
                        <input type="file" class="form-control" id="product_image2" name="product_image2" accept="image/*">
                    </div>
                    <div class="mb-3">
                        <label for="product_image3" class="form-label">Image 3</label>
                        <input type="file" class="form-control" id="product_image3" name="product_image3" accept="image/*">
                    </div>
                    <div class="mb-3">
                        <label for="product_image4" class="form-label">Image 4</label>
                        <input type="file" class="form-control" id="product_image4" name="product_image4" accept="image/*">
                    </div>
                    <button type="submit" class="btn btn-primary">Add Product</button>
                </form>
            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
