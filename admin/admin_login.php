<?php
session_start();
include('../server/connection.php'); // Adjusted path

if (isset($_SESSION['admin_logged_in'])) {
    header('location:admin_dashboard.php');
    exit;
}

if (isset($_POST['admin_login_btn'])) {
    $email = $_POST['email'];
    $password = md5($_POST['password']); // Assuming passwords are stored using MD5 hashing

    $stmt = $conn->prepare("SELECT admin_id, admin_name, admin_email FROM admins WHERE admin_email = ? AND admin_password = ? LIMIT 1");
    $stmt->bind_param('ss', $email, $password);

    if ($stmt->execute()) {
        $stmt->bind_result($admin_id, $admin_name, $admin_email);
        $stmt->store_result();

        if ($stmt->num_rows == 1) {
            $stmt->fetch();
            $_SESSION['admin_id'] = $admin_id;
            $_SESSION['admin_name'] = $admin_name;
            $_SESSION['admin_email'] = $admin_email;
            $_SESSION['admin_logged_in'] = true;
            header('location:admin_dashboard.php?message=Logged in successfully!');
        } else {
            header('location:admin_login.php?error=Could not verify your account!');
        }
    } else {
        header('location:admin_login.php?error=Something went wrong');
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        .navbar {
            background-color: #343a40; /* Dark background for the navbar */
        }
        .navbar-brand {
            font-size: 2rem;
            font-weight: bold;
            color: coral; /* Coral color for the navbar brand */
        }
        .container {
            max-width: 600px;
        }
        .error-message {
            color: red;
            margin-bottom: 1rem; /* Add space below error message */
        }
        .btn-custom {
            background-color: black; /* Black background for the button */
            color: white; /* White text color */
            border: none; /* Remove default border */
            margin-top: 1rem; /* Vertical spacing */
        }
        .btn-custom:hover {
            background-color: coral; /* Coral background on hover */
            color: black; /* Change text color to black on hover */
        }
        .form-group {
            margin-bottom: 1.5rem; /* Space between form groups */
        }
        .user-link {
            position: absolute; /* Absolute positioning relative to the parent container */
            top: 100px; /* Adjust this value based on the height of your navbar */
            right: 20px; /* Distance from the right edge */
            font-size: 14px;
            color: #007bff;
            text-decoration: none;
            background-color: #f8f9fa; /* Light background for better visibility */
            padding: 5px 10px;
            border-radius: 5px; /* Rounded corners */
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); /* Optional shadow for better visibility */
        }

        .user-link i {
            margin-right: 5px;
        }

        .user-link:hover {
            text-decoration: underline;
        }

        .login-container {
            position: relative; /* Ensure the container is relative for absolute positioning */
        }
    </style>
</head>
<body>
    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container d-flex justify-content-center">
            <a class="navbar-brand" href="admin_dashboard.php">BuyBay</a>
        </div>
    </nav>

    <!-- User Login Link -->
    <div class="container text-center">
        <a href="http://localhost:8000/login.php" class="user-link">
            <i class="fas fa-user"></i> User Login
        </a>
    </div>

    <!-- Main Content -->
    <section class="my-5 py-5">
        <div class="container text-center">
            <h2 class="font-weight-bold">Admin Login</h2>
            <hr class="mx-auto" style="width: 50%;"/>
        </div>
    </section>
    
    <div class="container text-center">
        <form method="POST" action="admin_login.php">
            <p class="error-message"><?php if (isset($_GET['error'])) echo $_GET['error']; ?></p>
            <div class="form-group">
                <label for="email"><h6>Email</h6></label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Email" required>
            </div>
            <div class="form-group">
                <label for="password"><h6>Password</h6></label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-custom" name="admin_login_btn" value="Login">
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
