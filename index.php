<?php include 'includes/header.php'; ?>

<h1>Araştırma Hipotezi: Hibrit Model</h1>
<p>
    Modern sohbet uygulamalarında tek bir teknolojiye (Sadece Firebase veya Sadece WebSocket) güvenmek yetersiz kalmaktadır. 
    Örneğin; "Yazıyor..." (Typing Indicator) özelliğini sadece <strong>Firebase Firestore</strong> üzerinde çalıştırmak, 
    veritabanına saniyede onlarca kez yazma işlemi yapacağından aşırı maliyet ve yavaşlığa neden olur.
</p>
<p>
    Öte yandan, sadece <strong>WebSocket</strong> kullanmak da; kullanıcı doğrulama (Auth) ve mesaj geçmişini güvenle saklama 
    konularında güvenlik riskleri ve geliştirme zorlukları doğurur.
</p>

<div class="diagram-box">
    SONUÇ: En optimum çözüm Hibrit Mimari'dir.
</div>

<h3>Neden Birlikte Kullanmalıyız?</h3>
<ul class="feature-list">
    <li><strong>Güvenlik İçin:</strong> Firebase Authentication (JWT Token yönetimi bizden çıkar).</li>
    <li><strong>Hız İçin:</strong> WebSocket (Mesajlar veritabanına uğramadan RAM üzerinden akar).</li>
    <li><strong>Maliyet İçin:</strong> Anlık durumlar (Online/Offline) Socket üzerinden bedavaya yönetilir.</li>
</ul>

<?php include 'includes/footer.php'; ?>