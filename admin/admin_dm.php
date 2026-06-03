<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header('location:admin_login.php');
    exit;
}

include('../server/connection.php');

// Handle message deletion
if (isset($_GET['action']) && $_GET['action'] === 'delete' && isset($_GET['message_id'])) {
    $message_id = $_GET['message_id'];

    // Delete message from database
    $delete_query = "DELETE FROM message WHERE message_id = $message_id";
    if (mysqli_query($conn, $delete_query)) {
        $delete_msg = "Message deleted successfully.";
    } else {
        echo "Error deleting message: " . mysqli_error($conn);
    }
}

// Fetch all messages for display
$query_all_messages = "SELECT * FROM message";
$result_all_messages = mysqli_query($conn, $query_all_messages);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Messages</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<?php include('HD_SD.php'); ?>

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <h2>User Messages</h2>
    <?php if (isset($delete_msg)) : ?>
    <div class="alert alert-success" role="alert">
        <?php echo $delete_msg; ?>
    </div>
    <?php endif; ?>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Message ID</th>
                <th>User ID</th>
                <th>Name</th>
                <th>User Email</th>
                <th>Message</th>
                <th>Message Time</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = mysqli_fetch_assoc($result_all_messages)) { ?>
            <tr>
                <td><?php echo $row['message_id']; ?></td>
                <td><?php echo $row['user_id']; ?></td>
                <td><?php echo $row['user_name']; ?></td>
                <td><?php echo $row['user_email']; ?></td>
                <td><?php echo nl2br(htmlspecialchars($row['user_message'])); ?></td>
                <td><?php echo $row['message_date']; ?></td>
                <td>
                    <a href="admin_dm.php?action=delete&message_id=<?php echo $row['message_id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this message?');">Delete</a>
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
