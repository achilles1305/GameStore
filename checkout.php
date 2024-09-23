<?php
session_start();
include 'includes/db_connect.php';
include 'includes/header.php';

// Check if the cart is empty; if so, redirect back to cart
if (empty($_SESSION['cart'])) {
    header("Location: cart.php");
    exit;
}

// Check if the user is logged in; if not, redirect to auth.php
if (!isset($_SESSION['user_id'])) {
    header("Location: auth.php");
    exit;
}

// Check if the order was placed successfully
if (isset($_GET['success']) && $_GET['success'] == 'true') {
    echo "<script>alert('Order Placed Successfully!');</script>";
}

// Fetch user details if logged in
$user_id = $_SESSION['user_id'];
$sql = "SELECT * FROM users WHERE id = $user_id";
$result = $conn->query($sql);
$user = $result->fetch_assoc();

?>

<h1 style="font-size: 2.5rem; text-align: center; margin-bottom: 20px;">Checkout</h1>
<p style="text-align: center; font-size: 1.2rem; margin-bottom: 30px;">Please provide your details to complete the purchase.</p>

<!-- Checkout Form -->
<form action="process_checkout.php" method="post" class="checkout-form" style="max-width: 600px; margin: 0 auto; padding: 20px; background-color: #f9f9f9; border-radius: 10px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
    <h2 style="font-size: 1.8rem; margin-bottom: 15px; color: #333;">Billing Information</h2>
    <label for="name" style="display: block; margin-bottom: 10px; font-size: 1rem;">Full Name:</label>
    <input type="text" id="name" name="name" value="<?php echo $user['username']; ?>" required style="width: 100%; padding: 10px; margin-bottom: 20px; border: 1px solid #ccc; border-radius: 5px; font-size: 1rem;">

    <label for="email" style="display: block; margin-bottom: 10px; font-size: 1rem;">Email:</label>
    <input type="email" id="email" name="email" value="<?php echo $user['email']; ?>" required style="width: 100%; padding: 10px; margin-bottom: 20px; border: 1px solid #ccc; border-radius: 5px; font-size: 1rem;">

    <label for="address" style="display: block; margin-bottom: 10px; font-size: 1rem;">Address:</label>
    <textarea id="address" name="address" required style="width: 100%; padding: 10px; margin-bottom: 20px; border: 1px solid #ccc; border-radius: 5px; font-size: 1rem; height: 100px;"></textarea>

    <h2 style="font-size: 1.8rem; margin-bottom: 15px; color: #333;">Payment Method</h2>
    <label style="display: block; margin-bottom: 10px; font-size: 1rem;">
        <input type="radio" name="payment_method" value="credit_card" required style="margin-right: 10px;"> Credit Card
    </label>
    <label style="display: block; margin-bottom: 10px; font-size: 1rem;">
        <input type="radio" name="payment_method" value="debit_card" required style="margin-right: 10px;"> Debit Card
    </label>
    <label style="display: block; margin-bottom: 10px; font-size: 1rem;">
        <input type="radio" name="payment_method" value="net_banking" required style="margin-right: 10px;"> Net Banking
    </label>
    <label style="display: block; margin-bottom: 20px; font-size: 1rem;">
        <input type="radio" name="payment_method" value="cod" required style="margin-right: 10px;"> Cash on Delivery
    </label>

    <button type="submit" class="checkout-submit" style="width: 100%; padding: 12px; background-color: #28a745; color: white; font-size: 1.2rem; border: none; border-radius: 5px; cursor: pointer;">Complete Purchase</button>
</form>

<?php
include 'includes/footer.php';
?>
