<?php include 'includes/header.php'; ?>

<h1>Sistem Mimarisi ve Tasarım</h1>

<p>Bu projede tasarlanan <strong>FRTCE Mimarisi</strong>, Flutter istemcisinin iki farklı kanalı aynı anda yönetmesi prensibine dayanır.</p>

<h3>1. Mimari Diyagramı</h3>
<div class="diagram-box">
    [ FLUTTER UYGULAMASI ]
    <br>⬇️ &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ⬇️<br>
    (HTTPS) &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; (WSS)<br>
    ⬇️ &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ⬇️<br>
    [ FIREBASE ] &nbsp;&nbsp; [ WEBSOCKET SUNUCU ]
</div>

<h3>2. Kanal Görevleri</h3>
<p>Sistemdeki veri trafiği iki ana yola ayrılmıştır:</p>

<table border="1" cellpadding="10" style="width:100%; border-collapse:collapse; border-color:#eee;">
    <tr style="background:#f1f8e9;">
        <th>Kanal</th>
        <th>Teknoloji</th>
        <th>Taşıdığı Veri</th>
    </tr>
    <tr>
        <td><strong>Yavaş Yol (Güvenli)</strong></td>
        <td>Firebase Firestore</td>
        <td>Kullanıcı Profilleri, Geçmiş Mesajlar, Medya Dosyaları</td>
    </tr>
    <tr>
        <td><strong>Hızlı Yol (Canlı)</strong></td>
        <td>Node.js / PHP Socket</td>
        <td>Anlık Chat Mesajı, "Yazıyor" bilgisi, "Görüldü" bilgisi</td>
    </tr>
</table>

<h3>3. Veri Protokolü (JSON)</h3>
<p>WebSocket üzerinden akan veri paketi şu formattadır:</p>

<div class="code-block">
{
  "type": "MESSAGE_NEW",
  "payload": {
    "sender_id": "uid_12345",
    "auth_token": "firebase_jwt_xyz...", 
    "content": "Merhaba, proje hazır mı?",
    "timestamp": 1715420000
  }
}
</div>
<small>*Token her mesajda doğrulanarak güvenlik sağlanır.</small>

<?php include 'includes/footer.php'; ?>