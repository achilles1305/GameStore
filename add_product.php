<?php
include 'includes/db_connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['product_name'];
    $description = $_POST['product_description'];
    $price = $_POST['product_price'];
    $category_id = $_POST['category_id'];

    // Handling image upload
    $image = $_FILES['product_image']['name'];
    $target_dir = "images/";
    $target_file = $target_dir . basename($image);
    move_uploaded_file($_FILES["product_image"]["tmp_name"], $target_file);

    $image_url = "images/" . basename($image);

    $sql = "INSERT INTO products (name, description, price, image_url, category_id) 
            VALUES ('$name', '$description', '$price', '$image_url', '$category_id')";

    if ($conn->query($sql) === TRUE) {
        echo "New product added successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>

<a href="admin.php">Redirect</a>
