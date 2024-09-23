<?php
include 'includes/db_connect.php';
include 'includes/header.php';

// Fetch products from the database
$category_id = 4; // Assume 'Consoles' has an ID of 1
$sql = "SELECT * FROM products WHERE category_id = $category_id";
$result = $conn->query($sql);
?>

<h1 style="text-align: center;">Headphones</h1>
<p style="text-align: center;">Explore our range of gaming Headphones.</p>

<!-- Products Section -->
<section class="products" style="display: flex; flex-direction: column; gap: 20px; max-width: 75%; margin: 0 auto;">
    <?php if ($result->num_rows > 0): ?>
        <?php while($row = $result->fetch_assoc()): ?>
            <article class="product" style="display: flex; align-items: center; width: 100%; padding: 20px; border: 1px solid #ccc; border-radius: 10px; gap: 20px; box-sizing: border-box;">
                <img src="<?php echo $row['image_url']; ?>" alt="<?php echo $row['name']; ?>" class="product-image" style="width: 150px; height: auto; object-fit: cover; border-radius: 10px;">
                <div style="flex-grow: 1;">
                    <h2 style="font-size: 1.5rem; margin: 0 0 10px;"><?php echo $row['name']; ?></h2>
                    <p style="font-size: 1rem; color: #555;"><?php echo $row['description']; ?></p>
                    <p class="price" style="font-size: 1.2rem; color: #28a745; font-weight: bold;">₹<?php echo number_format($row['price']); ?></p>
                    <form class="add-to-cart-form" data-product-id="<?php echo $row['id']; ?>" style="display: flex; gap: 10px; align-items: center; margin-top: 10px;">
                        <input type="number" name="quantity" min="1" value="1" max="10" class="quantity-input" style="width: 60px; padding: 5px;">
                        <button type="submit" class="add-to-cart" style="padding: 10px 20px; background-color: #007bff; color: white; border: none; border-radius: 5px; cursor: pointer;">Add to Cart</button>
                    </form>
                </div>
            </article>
        <?php endwhile; ?>
    <?php else: ?>
        <p>No products found.</p>
    <?php endif; ?>
</section>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    $('.add-to-cart-form').on('submit', function(e) {
        e.preventDefault();

        var form = $(this);
        var product_id = form.data('product-id');
        var quantity = form.find('input[name="quantity"]').val();

        $.ajax({
            url: 'add_to_cart.php',
            type: 'POST',
            data: {
                product_id: product_id,
                quantity: quantity
            },
            success: function(response) {
                var data = JSON.parse(response);
                alert(data.message); // Show success or error message
            },
            error: function() {
                alert('An error occurred while adding the item to the cart.');
            }
        });
    });
});
</script>

<?php
include 'includes/footer.php';
$conn->close();
?>
