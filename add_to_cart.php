<?php
session_start();
include 'includes/db_connect.php';

// Check if the request is via AJAX
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['product_id']) && isset($_POST['quantity'])) {
        $product_id = $_POST['product_id'];
        $quantity = (int)$_POST['quantity'];

        if ($quantity > 0) {
            $_SESSION['cart'][$product_id] = $quantity;
            $response = array('status' => 'success', 'message' => 'Item added to cart.');
        } else {
            $response = array('status' => 'error', 'message' => 'Invalid quantity.');
        }
    } else {
        $response = array('status' => 'error', 'message' => 'Invalid request.');
    }

    echo json_encode($response);
}
?>
