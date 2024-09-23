<?php
session_start();
include 'includes/db_connect.php';
include 'includes/header.php';

// Check if the user is logged in
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
} else {
    $user_id = null;
}

// Handle cart updates
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Update cart quantities
    if (isset($_POST['update_cart'])) {
        foreach ($_POST['quantities'] as $product_id => $quantity) {
            if ($quantity > 0) {
                $_SESSION['cart'][$product_id] = $quantity;
            } else {
                unset($_SESSION['cart'][$product_id]);
            }
        }
    }

    // Remove product from cart
    if (isset($_POST['remove_product'])) {
        $product_id = $_POST['product_id'];
        unset($_SESSION['cart'][$product_id]);
    }
}

echo "<h1>Your Cart</h1>";

// Initialize a variable to store the total amount
$total_amount = 0;

// Check if the cart is empty
if (empty($_SESSION['cart'])) {
    echo "<p>Your cart is empty.</p>";
} else {
    echo "<form method='post' action='cart.php' style='font-family: Arial, sans-serif;'>";
    echo "<ul style='list-style-type: none; padding: 0;'>";

    foreach ($_SESSION['cart'] as $product_id => $quantity) {
        $sql = "SELECT * FROM products WHERE id = $product_id";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $product = $result->fetch_assoc();
            $product_total = $product['price'] * $quantity; // Calculate total for this product
            $total_amount += $product_total; // Add to the overall total

            echo "<li style='border: 1px solid #ddd; padding: 20px; margin-bottom: 20px; display: flex; align-items: center;'>";
            echo "<img src='" . $product['image_url'] . "' alt='" . $product['name'] . "' style='width: 150px; height: auto; margin-right: 20px;'>";
            echo "<div style='flex: 1;'>";
            echo "<h2 style='margin: 0 0 15px;'>". $product['name'] ."</h2>";
            echo "<label for='quantity_" . $product_id . "' style='display: block; margin-bottom: 10px;'>Quantity: </label>";
            echo "<input type='number' id='quantity_" . $product_id . "' name='quantities[" . $product_id . "]' value='" . $quantity . "' min='1' max='10' style='padding: 10px; margin-right: 10px; width: 70px;'>";
            echo "<p style='margin: 10px 0;'>Price: ₹" . number_format($product['price']) . "</p>";
            echo "<p style='margin: 10px 0;'>Total: ₹" . number_format($product_total) . "</p>";
            echo "<button type='submit' name='remove_product' value='Remove' style='background-color: #e74c3c; color: #fff; border: none; padding: 10px 15px; cursor: pointer; margin-top: 10px;'>Remove</button>";
            echo "<input type='hidden' name='product_id' value='" . $product_id . "'>";
            echo "</div>";
            echo "</li>";
        }
    }

    echo "</ul>";
    
    // Display the overall total amount
    echo "<h2 style='margin-top: 30px;'>Total Amount: ₹" . number_format($total_amount) . "</h2>";
    echo "<button type='submit' name='update_cart' value='Update Cart' style='background-color: #3498db; color: #fff; border: none; padding: 15px 30px; cursor: pointer; margin-top: 20px;'>Update Cart</button>";
    echo "</form>";

    // Save cart to the database if user is logged in
    if ($user_id) {
        $stmt = $conn->prepare("INSERT INTO cart (user_id, product_id, quantity, total_price) VALUES (?, ?, ?, ?) ON DUPLICATE KEY UPDATE quantity = ?, total_price = ?");
        foreach ($_SESSION['cart'] as $product_id => $quantity) {
            $sql = "SELECT price FROM products WHERE id = $product_id";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                $product = $result->fetch_assoc();
                $total_price = $product['price'] * $quantity;

                // Bind and execute the statement
                $stmt->bind_param('iiidid', $user_id, $product_id, $quantity, $total_price, $quantity, $total_price);
                $stmt->execute();
            }
        }
        $stmt->close();
    }

    // Redirect to the correct page
    if ($user_id) {
        echo "<a href='checkout.php' style='display: inline-block; background-color: #2ecc71; color: #fff; padding: 15px 30px; text-decoration: none; margin-top: 30px;'>Proceed to Checkout</a>";
    } else {
        echo "<a href='auth.php' style='display: inline-block; background-color: #e67e22; color: #fff; padding: 15px 30px; text-decoration: none; margin-top: 30px;'>Login or Signup to Checkout</a>";
    }
}

include 'includes/footer.php';
$conn->close();
?>
