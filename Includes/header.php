<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$mevcutSayfa = basename($_SERVER['PHP_SELF']);

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
    <title>Flutter Gerçek Zamanlı Sohbet Açıklaması</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <link rel="stylesheet" href="assets/style.css"> 

    <style>
        .navbar-brand { font-weight: bold; color: #fff !important; font-size: 1.1rem; }
        .step-card { border-left: 5px solid #0d6efd; background: white; margin-bottom: 20px; padding: 20px; border-radius: 5px; box-shadow: 0 2px 5px rgba(0,0,0,0.05); }
        .step-number { font-size: 1.5rem; font-weight: bold; color: #0d6efd; margin-right: 10px; }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow">
        <div class="container">
            <a class="navbar-brand" href="index.php">
                <i class="fa-solid fa-comments"></i> Flutter Gerçek Zamanlı Sohbet Açıklaması
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="index.php">Özet</a></li>
                    <li class="nav-item"><a class="nav-link" href="roadmap.php">Entegrasyon Adımları</a></li>
                    <li class="nav-item"><a class="nav-link" href="architecture.php">Mimari</a></li>
                    
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">Teknik</a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="workflow.php">Veri Akışı</a></li>
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
    <div class="container main-content mt-4 bg-white p-5 rounded shadow-sm">