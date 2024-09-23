<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Game Store</title>
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
<header>
    <div class="header-container">
        <div class="header-left">
            <h3>Game Store</h3>
        </div>
        <div class="header-right">
            <nav>
                <a href="index.php">
                    <i class="fas fa-home"></i> Home
                </a>
                <a href="cart.php">
                    <i class="fas fa-shopping-cart"></i> Cart
                </a>
                
                <?php if (isset($_SESSION['username'])): ?>
                    <div class="dropdown">
                        <a class="dropbtn">
                            <i class="fas fa-user-circle"></i> <?php echo $_SESSION['username']; ?>
                </a>
                        <div class="dropdown-content">
                            <a href="profile.php">Profile</a>
                            <a href="update.php">Update</a>
                            <a href="orders.php">Orders</a>
                            <a href="logout.php">Sign Out</a>
                        </div>
                    </div>
                <?php else: ?>
                    <a href="auth.php">
                        <i class="fas fa-sign-in-alt"></i> Login
                    </a>
                <?php endif; ?>
            </nav>
        </div>
    </div>
</header>

<style>

</style>
</body>
</html>
