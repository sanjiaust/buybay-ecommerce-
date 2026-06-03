<?php
session_start();
include('server/connection.php');

if (isset($_SESSION['order_id']) && isset($_SESSION['order_total'])) {
    // Accessed from order details or after placing an order
    $order_id = $_SESSION['order_id'];
    $total = $_SESSION['order_total'];

    $stmt = $conn->prepare("SELECT order_status FROM orders WHERE order_id = ?");
    $stmt->bind_param('i', $order_id);
    $stmt->execute();
    $order = $stmt->get_result()->fetch_assoc();
    $status = $order['order_status'];
} else {
    // Default case (should not happen ideally)
    header('Location: index.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        .modal-body {
            text-align: center;
        }
        .payment-options {
            display: flex;
            justify-content: center;
            gap: 1rem;
        }
        .payment-option {
            cursor: pointer;
        }
        .payment-option img {
            width: 100px;
            height: auto;
        }
        .success-message {
            color: green;
            font-weight: bold;
            display: none;
        }
        .loading-indicator {
            display: none;
        }
        .modal-footer {
            justify-content: center;
        }
    </style>
</head>
<body>
<?php include('layout/header.php'); ?>

<section class="my-5 py-5">
    <div class="container text-center mt-3 pt-5">
        <h2 class="font-weight-bold">Payment Page</h2>
        <hr class="mx-auto">
    </div>
    <div class="container text-center">
        <p>Total Amount: $<?php echo number_format($total, 2); ?></p>
        <?php if ($status != 'Paid & Shipped'): ?>
            <button id="payNowBtn" class="btn btn-primary">Pay Now</button>
        <?php else: ?>
            <p>You have paid for this order and your product is shipped.</p>
        <?php endif; ?>
    </div>
</section>

<!-- Payment Modal -->
<div class="modal fade" id="paymentModal" tabindex="-1" aria-labelledby="paymentModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="paymentModalLabel">Select Payment Method</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="payment-options">
                    <div class="payment-option" data-payment-method="Bkash">
                        <img src="assets/imgs/Bkash.png" alt="Bkash" />
                    </div>
                    <div class="payment-option" data-payment-method="PayPal">
                        <img src="assets/imgs/PayPal.png" alt="PayPal" />
                    </div>
                    <div class="payment-option" data-payment-method="Visa">
                        <img src="assets/imgs/Visa.png" alt="Visa" />
                    </div>
                </div>
                <div class="loading-indicator" id="loadingIndicator">
                    <p>Processing your payment, please wait...</p>
                </div>
                <p class="success-message" id="successMessage">Your payment has been successful!</p>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    var payNowBtn = document.getElementById('payNowBtn');
    var paymentModal = new bootstrap.Modal(document.getElementById('paymentModal'));
    var paymentOptions = document.querySelectorAll('.payment-option');
    var successMessage = document.getElementById('successMessage');
    var loadingIndicator = document.getElementById('loadingIndicator');

    payNowBtn.addEventListener('click', function() {
        paymentModal.show();
    });

    paymentOptions.forEach(function(option) {
        option.addEventListener('click', function() {
            var paymentMethod = this.getAttribute('data-payment-method');
            loadingIndicator.style.display = 'block';
            successMessage.style.display = 'none';

            // Simulate payment processing
            setTimeout(function() {
                loadingIndicator.style.display = 'none';
                successMessage.style.display = 'block';
                updateOrderStatus(paymentMethod);
            }, 2000);
        });
    });

    function updateOrderStatus(paymentMethod) {
        fetch('server/update_order_status.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                order_id: <?php echo $order_id; ?>,
                status: 'Paid & Shipped',
                payment_method: paymentMethod
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                payNowBtn.style.display = 'none';
                successMessage.innerText = 'Your payment has been successful!';
                setTimeout(function() {
                    paymentModal.hide();
                    window.location.reload();
                }, 3000);
            } else {
                console.error('Error updating order status:', data.error);
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
    }
});

</script>

<?php include('layout/footer.php'); ?>
</body>
</html>
