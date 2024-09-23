<?php
session_start();
include 'includes/db_connect.php';
include 'includes/header.php';

// Check if the user is logged in; if not, redirect to auth.php
if (!isset($_SESSION['user_id'])) {
    header("Location: auth.php");
    exit;
}

// Get the logged-in user's ID
$user_id = $_SESSION['user_id'];

// Fetch orders for the logged-in user
$sql = "SELECT * FROM orders WHERE user_id = ? ORDER BY order_date DESC";
$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $user_id);
$stmt->execute();
$result = $stmt->get_result();

?>

<h1 style="font-size: 2.5rem; text-align: center; margin-bottom: 20px;">My Orders</h1>

<?php
if ($result->num_rows > 0) {
    echo "<div style='max-width: 800px; margin: 0 auto;'>";
    // Loop through and display each order
    while ($order = $result->fetch_assoc()) {
        echo "<div style='border: 1px solid #ddd; padding: 20px; margin-bottom: 20px; background-color: #f9f9f9; border-radius: 10px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);'>";
        echo "<h2 style='font-size: 1.8rem; margin-bottom: 10px;'>Order ID: " . $order['id'] . "</h2>";
        echo "<p style='font-size: 1rem; margin-bottom: 10px;'>Order Date: " . date("F j, Y, g:i a", strtotime($order['order_date'])) . "</p>";
        echo "<p style='font-size: 1rem; margin-bottom: 10px;'>Total Amount: ₹" . number_format($order['total_amount'], 2) . "</p>";
        
        // Fetch order items with product name for this order
        $order_id = $order['id'];
        $sql_items = "
            SELECT order_items.*, products.name AS product_name 
            FROM order_items 
            JOIN products ON order_items.product_id = products.id 
            WHERE order_items.order_id = ?";
        $stmt_items = $conn->prepare($sql_items);
        $stmt_items->bind_param('i', $order_id);
        $stmt_items->execute();
        $result_items = $stmt_items->get_result();
        
        if ($result_items->num_rows > 0) {
            echo "<h3 style='font-size: 1.5rem; margin-top: 20px; margin-bottom: 10px;'>Order Items</h3>";
            echo "<ul style='list-style-type: none; padding: 0;'>";
            while ($item = $result_items->fetch_assoc()) {
                echo "<li style='border-bottom: 1px solid #ddd; padding: 10px 0;'>";
                echo "<strong>Product:</strong> " . $item['product_name'] . " <br>";
                echo "<strong>Quantity:</strong> " . $item['quantity'] . " <br>";
                echo "<strong>Price:</strong> ₹" . number_format($item['price'], 2);
                echo "</li>";
            }
            echo "</ul>";
        }
        echo "</div>";
    }
    echo "</div>";
} else {
    echo "<p style='text-align: center; font-size: 1.2rem; color: #888;'>You have not placed any orders yet.</p>";
}

include 'includes/footer.php';
$stmt->close();
$conn->close();
?>
