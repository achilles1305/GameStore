<?php
session_start();
include 'includes/header.php';

$order_id = $_GET['order_id'];
?>

<h1>Thank You for Your Order!</h1>
<p>Your order ID is <strong><?php echo $order_id; ?></strong>.</p>
<p>We will send a confirmation email to you shortly.</p>

<?php
include 'includes/footer.php';
?>
