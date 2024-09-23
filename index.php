<?php
session_start();
include 'includes/header.php';
?>

<h1>Welcome to the World of Gaming</h1>
<p>A game's emotions range from the excitement of victory to the frustration of defeat, creating a powerful connection between the player and the experience. Every challenge faced and achievement earned evokes feelings of immersion and investment, making the journey more than just a game—it's a reflection of real emotions and experiences.</p>

<!-- Categories Section -->
<section class="categories">
    <a href="console.php" class="category-card">
        <img src="images/consoles.jpg" alt="Consoles" class="category-image">
        <h2>Consoles</h2>
        <p>Explore our range of gaming consoles.</p>
    </a>
    <a href="controllers.php" class="category-card">
        <img src="images/controllers.jpg" alt="Controllers" class="category-image">
        <h2>Controllers</h2>
        <p>Find the perfect controller for your gaming needs.</p>
    </a>
    <a href="games.php" class="category-card">
        <img src="images/games.jpg" alt="Games" class="category-image">
        <h2>Games</h2>
        <p>Discover the latest games and trending titles.</p>
    </a>
    <a href="headphones.php" class="category-card">
        <img src="images/headphones.jpg" alt="Headphones" class="category-image">
        <h2>Headphones</h2>
        <p>Upgrade your audio experience with our headphones.</p>
    </a>
    <a href="chairs.php" class="category-card">
        <img src="images/chairs.jpg" alt="Chairs" class="category-image">
        <h2>Chairs</h2>
        <p>Find comfortable and stylish chairs for gaming.</p>
    </a>
    <a href="accessories.php" class="category-card">
        <img src="images/accessories.jpg" alt="Accessories" class="category-image">
        <h2>Accessories</h2>
        <p>Enhance your gaming experience with our accessories.</p>
    </a>
</section>


<?php
include 'includes/footer.php';
?>