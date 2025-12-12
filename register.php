<?php
session_start();
require 'connection.php';

// Zaten giriş yapmışsa panele yönlendir
if (isset($_SESSION['aktifKullaniciId'])) {
    header("Location: index.php");
    exit;
}

$mesaj = '';
$mesajTuru = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $kullaniciAdi = trim($_POST['kullanici_adi']);
    $sifre = trim($_POST['sifre']);

    if (empty($kullaniciAdi) || empty($sifre)) {
        $mesaj = "Lütfen tüm alanları doldurun.";
        $mesajTuru = "danger";
    } else {
        // Kullanıcı adı var mı kontrol et
        $kontrolSorgusu = $baglanti->prepare("SELECT id FROM admins WHERE username = ?");
        $kontrolSorgusu->execute([$kullaniciAdi]);
        
        if ($kontrolSorgusu->rowCount() > 0) {
            $mesaj = "Bu kullanıcı adı zaten alınmış.";
            $mesajTuru = "warning";
        } else {
            // Yeni kullanıcıyı ekle
            $ekleSorgusu = $baglanti->prepare("INSERT INTO admins (username, password) VALUES (?, ?)");
            $sonuc = $ekleSorgusu->execute([$kullaniciAdi, $sifre]);

            if ($sonuc) {
                $mesaj = "Kayıt başarılı! Giriş yapabilirsiniz.";
                $mesajTuru = "success";
                // İstersen burada header("Location: login.php") ile yönlendirebilirsin
            } else {
                $mesaj = "Bir hata oluştu.";
                $mesajTuru = "danger";
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kayıt Ol - FRTCE</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light d-flex align-items-center justify-content-center vh-100">

    <div class="card shadow-lg p-4" style="width: 100%; max-width: 400px; border-radius: 15px;">
        <div class="card-body">
            <h3 class="text-center text-success mb-4 fw-bold">Yeni Hesap Oluştur</h3>
            
            <?php if ($mesaj): ?>
                <div class="alert alert-<?= $mesajTuru ?> text-center"><?= $mesaj ?></div>
            <?php endif; ?>

            <form method="POST" class="d-flex flex-column gap-3">
                <div>
                    <label class="form-label fw-bold">Kullanıcı Adı Belirle</label>
                    <input type="text" name="kullanici_adi" class="form-control form-control-lg" placeholder="Örn: yunus" required>
                </div>
                
                <div>
                    <label class="form-label fw-bold">Şifre Belirle</label>
                    <input type="password" name="sifre" class="form-control form-control-lg" placeholder="******" required>
                </div>

                <button type="submit" class="btn btn-success btn-lg mt-2 fw-bold">Kayıt Ol</button>
            </form>
            
            <div class="text-center mt-3">
                <a href="login.php" class="text-decoration-none">Zaten hesabın var mı? <strong>Giriş Yap</strong></a>
            </div>
        </div>
    </div>

</body>
</html>