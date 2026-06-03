<?php
session_start();
include('../server/connection.php');

// Check if admin is logged in
if (!isset($_SESSION['admin_logged_in'])) {
    header('location:admin_login.php');
    exit;
}
?>

<?php include('HD_SD.php'); ?>
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <h2 class="mt-4">Admin Help</h2>
    <div class="accordion" id="helpAccordion">
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingOne">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                    Dashboard Overview
                </button>
            </h2>
            <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#helpAccordion">
                <div class="accordion-body">
                    <strong>Dashboard Overview:</strong> Welcome to the BuyBay admin dashboard! This section provides a comprehensive overview of your admin panel, including quick access to managing orders, products, users, and more. Our team has designed this dashboard to be intuitive and user-friendly, ensuring you can manage your store efficiently.
                </div>
            </div>
        </div>
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingTwo">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                    Managing Products
                </button>
            </h2>
            <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#helpAccordion">
                <div class="accordion-body">
                    <strong>Managing Products:</strong> This section provides detailed instructions on how to add, edit, and delete products in your store. You'll learn how to update product details, manage images, and ensure your product catalog is up-to-date. Our goal is to make product management as seamless as possible for you.
                </div>
            </div>
        </div>
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingThree">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                    Managing Orders
                </button>
            </h2>
            <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#helpAccordion">
                <div class="accordion-body">
                    <strong>Managing Orders:</strong> Here, you'll find guidance on how to view, process, and update orders. This section covers everything from managing order statuses to handling customer inquiries, ensuring you can efficiently oversee your store's order fulfillment process.
                </div>
            </div>
        </div>
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingFour">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                    User Management
                </button>
            </h2>
            <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour" data-bs-parent="#helpAccordion">
                <div class="accordion-body">
                    <strong>User Management:</strong> This section details how to manage user accounts, including adding, editing, and deleting users. You'll also learn about handling user permissions and roles to ensure that everyone has the appropriate level of access.
                </div>
            </div>
        </div>
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingFive">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                    Troubleshooting
                </button>
            </h2>
            <div id="collapseFive" class="accordion-collapse collapse" aria-labelledby="headingFive" data-bs-parent="#helpAccordion">
                <div class="accordion-body">
                    <strong>Troubleshooting:</strong> In case you encounter any issues while using the admin panel, this section offers solutions for common problems. From login issues to product update glitches, we provide helpful tips to get you back on track quickly.
                </div>
            </div>
        </div>
    </div>
    <div class="mt-4">
        <p>If you need further assistance or have specific questions about the BuyBay admin panel, feel free to reach out to us directly:</p>
        <ul>
            <li><strong>Ridwanul Islam Sanji</strong> - Full Stack Project Architect, Lead Developer</li>
            <li><strong>Muhaiminul Huq Mumit</strong> - Backend Specialist</li>
            <li><strong>Sumi Akter</strong> - Frontend Developer</li>
        </ul>
        <p>We are here to help you make the most out of your BuyBay experience!</p>
    </div>
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
