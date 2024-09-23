<?php
session_start();
include 'includes/db_connect.php'; // Include your database connection

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $payment_method = $_POST['payment_method'];

    // Initialize total amount
    $total_amount = 0;

    // Check if the user is logged in
    if (isset($_SESSION['user_id'])) {
        $user_id = $_SESSION['user_id'];
    } else {
        // If not logged in, redirect to auth.php
        header("Location: auth.php");
        exit;
    }

    // Calculate total amount from the session cart
    foreach ($_SESSION['cart'] as $product_id => $quantity) {
        $sql = "SELECT price FROM products WHERE id = $product_id";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $product = $result->fetch_assoc();
            $total_amount += $product['price'] * $quantity;
        }
    }

    // Insert the order into the orders table
    $sql = "INSERT INTO orders (user_id, name, email, address, payment_method, total_amount) 
            VALUES ('$user_id', '$name', '$email', '$address', '$payment_method', '$total_amount')";

    if ($conn->query($sql) === TRUE) {
        $order_id = $conn->insert_id; // Get the last inserted order ID

        // Insert each cart item into the order_items table
        foreach ($_SESSION['cart'] as $product_id => $quantity) {
            $sql = "SELECT price FROM products WHERE id = $product_id";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                $product = $result->fetch_assoc();
                $price = $product['price'];
                $total_price = $price * $quantity;

                // Insert into order_items table
                $sql = "INSERT INTO order_items (order_id, product_id, quantity, price, total_price) 
                        VALUES ('$order_id', '$product_id', '$quantity', '$price', '$total_price')";
                $conn->query($sql);
            }
        }

        // Clear the cart
        unset($_SESSION['cart']);

        // Redirect to payment success page
        header("Location: checkout.php?success=true");
        exit;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
