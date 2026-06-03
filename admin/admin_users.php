<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header('location:admin_login.php');
    exit;
}

include('../server/connection.php');

// Check if action is 'edit' and user_id is provided
if (isset($_GET['action']) && $_GET['action'] === 'edit' && isset($_GET['user_id'])) {
    $user_id = $_GET['user_id'];
    
    // Fetch user details from database based on user_id
    $query = "SELECT * FROM users WHERE user_id = $user_id";
    $result = mysqli_query($conn, $query);
    
    if (mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);
    } else {
        echo "User not found.";
        exit;
    }
}

// Update user name if form submitted
$update_msg = "";
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_user'])) {
    $new_user_name = $_POST['user_name'];
    $update_query = "UPDATE users SET user_name = '$new_user_name' WHERE user_id = $user_id";
    
    if (mysqli_query($conn, $update_query)) {
        $update_msg = "User name updated successfully.";
        // Refresh user details after update
        $user_query = "SELECT * FROM users WHERE user_id = $user_id";
        $user_result = mysqli_query($conn, $user_query);
        if (mysqli_num_rows($user_result) > 0) {
            $user = mysqli_fetch_assoc($user_result);
        } else {
            echo "User not found after update.";
        }
    } else {
        echo "Error updating user name: " . mysqli_error($conn);
    }
}

// Fetch all users for display
$query_all_users = "SELECT * FROM users";
$result_all_users = mysqli_query($conn, $query_all_users);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Users</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<?php include('HD_SD.php'); ?>

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <h2>Users</h2>
    <?php if (!empty($update_msg)) : ?>
    <div class="alert alert-success" role="alert">
        <?php echo $update_msg; ?>
    </div>
    <?php endif; ?>
    
    <table class="table table-striped">
        <thead>
            <tr>
                <th>User ID</th>
                <th>User Name</th>
                <th>Email</th>
                <th>Edit</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = mysqli_fetch_assoc($result_all_users)) { ?>
            <tr>
                <td><?php echo $row['user_id']; ?></td>
                <td>
                    <?php if (isset($user) && $user['user_id'] == $row['user_id']) : ?>
                    <form method="POST">
                        <div class="input-group">
                            <input type="text" class="form-control" name="user_name" value="<?php echo $user['user_name']; ?>">
                            <?php if (empty($update_msg)) : ?>
                            <button type="submit" class="btn btn-success" name="update_user">Update</button>
                            <?php endif; ?>
                        </div>
                    </form>
                    <?php else : ?>
                    <?php echo $row['user_name']; ?>
                    <?php endif; ?>
                </td>
                <td><?php echo $row['user_email']; ?></td>
                <td>
                    <?php if (!isset($user) || $user['user_id'] != $row['user_id']) : ?>
                    <a href="admin_users.php?action=edit&user_id=<?php echo $row['user_id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                    <?php endif; ?>
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
