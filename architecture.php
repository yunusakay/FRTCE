<?php include 'includes/header.php'; ?>

<h1 class="text-primary border-bottom pb-2">Sistem Mimarisi ve Tasarım</h1>

<p>FRTCE Mimarisi, iki farklı iletişim kanalını aynı anda yönetmek üzere tasarlanmıştır.</p>

<h3 class="mt-4">1. Mimari Diyagramı</h3>
<div class="diagram-box">
    [ FLUTTER İSTEMCİSİ ]
    <br>⬇️ &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ⬇️<br>
    (HTTPS) &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; (WSS)<br>
    ⬇️ &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ⬇️<br>
    [ FIREBASE ] &nbsp;&nbsp; [ WEBSOCKET SUNUCUSU ]
</div>

<h3 class="mt-4">2. Kanal Sorumlulukları</h3>
<table class="table table-bordered table-striped mt-3">
    <thead class="table-dark">
        <tr>
            <th>Kanal</th>
            <th>Teknoloji</th>
            <th>Veri Tipi</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td><strong>Yavaş Yol (Güvenli)</strong></td>
            <td>Firebase Firestore</td>
            <td>Kullanıcı Profilleri, Mesaj Geçmişi, Medya Dosyaları</td>
        </tr>
        <tr>
            <td><strong>Hızlı Yol (Canlı)</strong></td>
            <td>Node.js / Socket</td>
            <td>Anlık Mesajlar, Yazıyor Göstergesi, Çevrimiçi Durumu</td>
        </tr>
    </tbody>
</table>

<h3 class="mt-4">3. Veri Protokolü</h3>
<p>WebSocket veri paketi yapısı:</p>

<div class="code-block">
{
  "tip": "YENI_MESAJ",
  "veri": {
    "gonderenId": "uid_12345",
    "kimlikToken": "firebase_jwt_xyz", 
    "icerik": "Merhaba dünya",
    "zamanDamgasi": 1715420000
  }
}
</div>

<?php include 'includes/footer.php'; ?>