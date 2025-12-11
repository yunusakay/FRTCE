<?php
session_start();
require 'connection.php';

if (isset($_SESSION['aktifKullaniciId'])) {
    header("Location: index.php");
    exit;
}

$hataMesaji = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $girilenKullanici = $_POST['kullanici_adi'];
    $girilenSifre = $_POST['sifre'];

    $sorgu = "SELECT * FROM admins WHERE username = :kullanici AND password = :sifre";
    $ifade = $baglanti->prepare($sorgu);
    $ifade->execute(['kullanici' => $girilenKullanici, 'sifre' => $girilenSifre]);
    $kullaniciKaydi = $ifade->fetch();

    if ($kullaniciKaydi) {
        $_SESSION['aktifKullaniciId'] = $kullaniciKaydi['id'];
        header("Location: index.php");
        exit;
    } else {
        $hataMesaji = "Hatalı kullanıcı adı veya şifre.";
    }
}
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giriş Yap - FRTCE</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light d-flex align-items-center justify-content-center vh-100">

    <div class="card shadow-lg p-4" style="width: 100%; max-width: 400px; border-radius: 15px;">
        <div class="card-body">
            <h3 class="text-center text-primary mb-4 fw-bold">FRTCE Panel</h3>
            
            <?php if ($hataMesaji): ?>
                <div class="alert alert-danger text-center"><?= $hataMesaji ?></div>
            <?php endif; ?>

            <form method="POST" class="d-flex flex-column gap-3">
                <div>
                    <label class="form-label fw-bold">Kullanıcı Adı</label>
                    <input type="text" name="kullanici_adi" class="form-control form-control-lg" placeholder="admin" required>
                </div>
                
                <div>
                    <label class="form-label fw-bold">Şifre</label>
                    <input type="password" name="sifre" class="form-control form-control-lg" placeholder="1234" required>
                </div>

                <button type="submit" class="btn btn-primary btn-lg mt-2 fw-bold">Giriş Yap</button>
            </form>
        </div>
        <div class="card-footer text-center text-muted border-0 bg-white">
            <small>Araştırma Projesi Giriş Ekranı</small>
        </div>
    </div>

</body>
</html>