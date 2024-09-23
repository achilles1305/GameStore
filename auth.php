<?php
include 'includes/db_connect.php';
session_start();
$message = '';

// Handle Signup
if (isset($_POST['signup'])) {
    $username = $_POST['signup_username'];
    $email = $_POST['signup_email'];
    $password = password_hash($_POST['signup_password'], PASSWORD_DEFAULT);
    $role = 'user'; // Default role is 'user'

    $sql = "INSERT INTO Users (username, email, password, role) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $username, $email, $password, $role);
    
    if ($stmt->execute()) {
        $message = 'User registered successfully. You can now log in!';
    } else {
        $message = 'Registration failed';
    }
    $stmt->close();
}

// Handle Login
if (isset($_POST['login'])) {
    $username = $_POST['login_username'];
    $password = $_POST['login_password'];

    $sql = "SELECT * FROM Users WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['role'] = $user['role'];

        if ($user['role'] == 'admin') {
            header('Location: admin.php');
        } else {
            header('Location: index.php');
        }
        exit;
    } else {
        $message = 'Invalid username or password';
    }
    $stmt->close();
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Game Store - Signup/Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #74ebd5, #acb6e5);
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .card {
            width: 400px;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            background: #ffffff;
        }
        .card-header {
            background-color: #007bff;
            color: #fff;
            text-align: center;
            font-weight: bold;
            font-size: 1.5rem;
            padding: 15px;
        }
        .nav-tabs {
            justify-content: center;
        }
        .tab-content {
            padding: 20px;
        }
        .form-label {
            font-weight: bold;
        }
        .message {
            text-align: center;
            color: red;
        }
        .btn-primary, .btn-success {
            width: 100%;
        }
        .btn-primary:hover, .btn-success:hover {
            opacity: 0.9;
        }
    </style>
</head>
<body>
    <div class="card">
        <div class="card-header">
            Welcome to Game Store
        </div>
        <ul class="nav nav-tabs" id="authTab" role="tablist">
            <li class="nav-item" role="presentation">
                <a class="nav-link active" id="login-tab" data-bs-toggle="tab" href="#Login" role="tab">Login</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link" id="signup-tab" data-bs-toggle="tab" href="#Signup" role="tab">Signup</a>
            </li>
        </ul>

        <div class="tab-content" id="authTabContent">
            <div class="tab-pane fade show active" id="Login" role="tabpanel">
                <form method="POST">
                    <div class="mb-3">
                        <label for="login_username" class="form-label">Username</label>
                        <input type="text" name="login_username" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="login_password" class="form-label">Password</label>
                        <input type="password" name="login_password" class="form-control" required>
                    </div>
                    <button type="submit" name="login" class="btn btn-primary">Login</button>
                </form>
            </div>

            <div class="tab-pane fade" id="Signup" role="tabpanel">
                <form method="POST">
                    <div class="mb-3">
                        <label for="signup_username" class="form-label">Username</label>
                        <input type="text" name="signup_username" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="signup_email" class="form-label">Email</label>
                        <input type="email" name="signup_email" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="signup_password" class="form-label">Password</label>
                        <input type="password" name="signup_password" class="form-control" required>
                    </div>
                    <button type="submit" name="signup" class="btn btn-success">Signup</button>
                </form>
            </div>
        </div>

        <?php if ($message): ?>
            <p class="message"><?php echo $message; ?></p>
        <?php endif; ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
