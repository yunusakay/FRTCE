<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$mevcutSayfa = basename($_SERVER['PHP_SELF']);

// Giriş yapılmamışsa login sayfasına at
if (!isset($_SESSION['aktifKullaniciId']) && $mevcutSayfa != 'login.php') {
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FRTCE Araştırma Projesi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body { background-color: #f8f9fa; }
        .navbar-brand { font-weight: bold; color: #0d6efd !important; }
        .diagram-box { background-color: #e7f1ff; border: 2px dashed #0d6efd; padding: 20px; text-align: center; border-radius: 10px; margin: 20px 0; color: #084298; font-weight: bold; }
        .code-block { background-color: #212529; color: #00ff41; padding: 15px; border-radius: 5px; font-family: monospace; overflow-x: auto; margin: 15px 0; }
        .main-content { min-height: 80vh; padding-bottom: 50px; }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="index.php"><i class="fa-solid fa-comments"></i> FRTCE Projesi</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="index.php">Özet</a></li>
                    <li class="nav-item"><a class="nav-link" href="architecture.php">Mimari</a></li>
                    <li class="nav-item"><a class="nav-link" href="workflow.php">Akış</a></li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">Teknik</a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="login_design.php">Giriş Tasarımı</a></li>
                            <li><a class="dropdown-item" href="database.php">Veritabanı</a></li>
                            <li><a class="dropdown-item" href="security.php">Güvenlik</a></li>
                            <li><a class="dropdown-item" href="performance.php">Performans</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">Kodlar</a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="backend.php">Sunucu (Node.js)</a></li>
                            <li><a class="dropdown-item" href="client.php">İstemci (Flutter)</a></li>
                        </ul>
                    </li>
                    <li class="nav-item ms-2">
                        <a class="btn btn-danger btn-sm mt-1" href="logout.php">
                            <i class="fa-solid fa-power-off"></i> Çıkış
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    
    <div class="container main-content mt-4 bg-white p-5 rounded shadow">