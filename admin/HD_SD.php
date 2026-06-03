<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Users</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>

</head>
<body>
    <header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
        <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="admin_dashboard.php">BuyBay Admin</a>
        <div class="navbar-nav">
            <div class="nav-item text-nowrap">
                <a class="nav-link px-3" href="logout.php?logout=1">Sign out</a>
            </div>
        </div>
    </header>

    <div class="container-fluid">
        <div class="row">
            <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
                <div class="position-sticky pt-3">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link" href="admin_dashboard.php">
                                <span data-feather="home"></span>
                                Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="admin_orders.php">
                                <span data-feather="file"></span>
                                Orders
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="payment.php">
                                <span data-feather="dollar-sign"></span>
                                Payment
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="admin_products.php">
                                <span data-feather="shopping-cart"></span>
                                Products
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="add_product.php">
                                <span data-feather="plus-circle"></span>
                                Add Products
                            </a>
                        </li>
                        <li class="nav-item">
                        <a class="nav-link active" href="admin_users.php">
                            <span data-feather="users"></span>
                            Users Account
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="admin_dm.php">
                            <span data-feather="mail"></span>
                            Request Message
                        </a>
                    </li>
                        <li class="nav-item">
                        <a class="nav-link" href="admin_help.php">
                            <span data-feather="help-circle"></span>
                            Help
                        </a>
                    </li>
                    </ul>
                </div>
            </nav>
            <script>
        feather.replace();
    </script>