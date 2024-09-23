<?php
include 'includes/db_connect.php'; // Adjust the path as necessary

// Fetch all products from the database
$product_sql = "SELECT * FROM products";
$product_result = $conn->query($product_sql);

$order_sql = "SELECT * FROM orders";
$order_result = $conn->query($order_sql);


?>
<link rel="stylesheet" href="css/styles.css">
<title> Admin Page</title>
<h1>Admin Dashboard</h1>

<!-- Admin Navigation -->
<nav class="admin-nav">
    <a href="#manage-products" class="admin-link">Manage Products</a>
    <a href="#view-orders" class="admin-link">View Orders</a>
    <a href="#customer-inquiries" class="admin-link">Customer Inquiries</a>
    <a href="logout.php" class="admin-link">Logout</a>
</nav>

<!-- Manage Products Section -->
<section id="manage-products" class="admin-section">
    <h2>Manage Products</h2>
    <form action="add_product.php" method="post" enctype="multipart/form-data" class="admin-form">
        <label for="product-name">Product Name:</label>
        <input type="text" id="product-name" name="product_name" required>
        
        <label for="product-description">Description:</label>
        <textarea id="product-description" name="product_description" required></textarea>
        
        <label for="product-price">Price:</label>
        <input type="text" id="product-price" name="product_price" required>
        
        <label for="product-image">Image:</label>
        <input type="file" id="product-image" name="product_image" required>
        
        <label for="product-category">Category:</label>
        <select id="product-category" name="category_id" required>
            <?php
            $category_sql = "SELECT * FROM categories";
            $category_result = $conn->query($category_sql);
            if ($category_result->num_rows > 0) {
                while ($category_row = $category_result->fetch_assoc()) {
                    echo "<option value='" . $category_row['id'] . "'>" . $category_row['name'] . "</option>";
                }
            }
            ?>
        </select>

        <button type="submit">Add Product</button>
    </form>
    
    <!-- List of Products -->
    <div class="product-list">
        <h3>Existing Products</h3>
        </div>
        <div class="product-list">
    <?php if ($product_result->num_rows > 0): ?>
        <?php while($row = $product_result->fetch_assoc()): ?>
            <div class="product-item">
                <img src="https://img.freepik.com/premium-photo/smily-emoji-yellow-color_970137-97705.jpg?w=740" alt="Product Image" class="admin-product-image">
                <div class="product-details">
                    <h4><?php echo $row['name']; ?></h4>
                    <p>₹<?php echo number_format($row['price']); ?></p>
                    <p><?php echo $row['description']; ?></p>
                    <a href="delete_product.php?id=<?php echo $row['id']; ?>" class="admin-delete btn">Delete</a>
                </div>
            </div>
        <?php endwhile; ?>
    <?php else: ?>
        <p>No products found.</p>
    <?php endif; ?>
</div>

</section>

<!-- View Orders Section -->
<section id="view-orders" class="admin-section">
    <h2>View Orders</h2>
    <table class="orders-table">
        <thead>
            <tr>
                <th>Order ID</th>
                <th>Customer</th>
                <th>Address</th>
                <th>Payment Type</th>
                <th>Status</th>
                <th>Total Amount</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($order_result->num_rows > 0): ?>
                <?php while($order_row = $order_result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $order_row['id']; ?></td>
                        <td><?php echo $order_row['name']; ?></td>
                        <td><?php echo $order_row['address']; ?></td>
                        <td><?php echo $order_row['payment_method']; ?></td>
                        <td><?php echo "Pending"; ?></td>
                        <td><?php echo $order_row['total_amount']; ?></td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr><td colspan="6">No orders found.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
</section>


<!-- Customer Inquiries Section -->
<section id="customer-inquiries" class="admin-section">
    <h2>Customer Inquiries</h2>
    <!-- Display customer inquiries with an option to respond -->
</section>


<?php
include 'includes/footer.php';
$conn->close();
?>
