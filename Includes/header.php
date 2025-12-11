<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$currentPage = basename($_SERVER['PHP_SELF']);

if (!isset($_SESSION['activeUserId']) && $currentPage != 'login.php') {
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FRTCE Research Project</title>
    <link rel="stylesheet" href="assets/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <header>
        <div class="project-logo">FRTCE Research</div>
        <nav>
            <ul>
                <li><a href="index.php">Summary</a></li>
                <li><a href="architecture.php">Architecture</a></li>
                <li><a href="workflow.php">Workflow</a></li>
                <li><a href="login_design.php">Login UI</a></li>
                <li><a href="database.php">Database</a></li>
                <li><a href="security.php">Security</a></li>
                <li><a href="performance.php">Performance</a></li>
                <li><a href="backend.php">Backend Code</a></li>
                <li><a href="client.php">Client Code</a></li>
                <li class="logout-item">
                    <a href="logout.php" class="logout-button">
                        <i class="fa-solid fa-right-from-bracket"></i> Logout
                    </a>
                </li>
            </ul>
        </nav>
    </header>
    <main class="main-content">