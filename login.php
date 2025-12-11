<?php
session_start();
require 'db.php';

if (isset($_SESSION['activeUserId'])) {
    header("Location: index.php");
    exit;
}

$errorMessage = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $inputUsername = $_POST['username'];
    $inputPassword = $_POST['password'];

    $query = "SELECT * FROM admins WHERE username = :username AND password = :password";
    $statement = $databaseConnection->prepare($query);
    $statement->execute(['username' => $inputUsername, 'password' => $inputPassword]);
    $userRecord = $statement->fetch();

    if ($userRecord) {
        $_SESSION['activeUserId'] = $userRecord['id'];
        header("Location: index.php");
        exit;
    } else {
        $errorMessage = "Invalid credentials.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login - FRTCE</title>
    <style>
        body { font-family: 'Segoe UI', sans-serif; background: #e3f2fd; display: flex; justify-content: center; align-items: center; height: 100vh; margin: 0; }
        .login-container { background: white; padding: 2rem; border-radius: 10px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); width: 100%; max-width: 350px; text-align: center; }
        h2 { color: #1565c0; margin-bottom: 1.5rem; }
        input { width: 100%; padding: 12px; margin-bottom: 1rem; border: 1px solid #ddd; border-radius: 4px; box-sizing: border-box; }
        button { width: 100%; padding: 12px; background: #1565c0; color: white; border: none; border-radius: 4px; cursor: pointer; font-size: 1rem; font-weight: bold; }
        button:hover { background: #0d47a1; }
        .error-message { background: #ffebee; color: #c62828; padding: 10px; border-radius: 4px; margin-bottom: 1rem; font-size: 0.9rem; }
    </style>
</head>
<body>
    <div class="login-container">
        <h2>FRTCE Panel</h2>
        <?php if ($errorMessage): ?>
            <div class="error-message"><?= $errorMessage ?></div>
        <?php endif; ?>
        <form method="POST">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Login</button>
        </form>
    </div>
</body>
</html>