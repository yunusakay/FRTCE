<?php include 'includes/header.php'; ?>

<h1 class="text-primary border-bottom pb-2">Veri Akış Senaryosu</h1>
<p>Kullanıcı uygulamayı açtığında gerçekleşen dört aşamalı süreç aşağıdadır.</p>

<h3 class="mt-4 text-secondary">Adım 1: Kimlik Doğrulama (El Sıkışma)</h3>
<p>
    Kullanıcı giriş yapar. Firebase bir ID Token döndürür.
    Flutter bu token'ı alır ve WebSocket sunucusuna bağlantı isteği gönderir.
</p>
<div class="code-block">
socket.connect('wss://api.chat.com', headers: {
    'Authorization': 'Bearer ' + firebaseUser.getIdToken()
});
</div>

<h3 class="mt-4 text-secondary">Adım 2: Senkronizasyon (Sync)</h3>
<p>
    Soket bağlanırken, uygulama aynı anda "Tembel Yükleme" (Lazy Loading) kullanarak Firestore'dan son 50 mesajı çeker.
</p>

<h3 class="mt-4 text-secondary">Adım 3: Mesaj Gönderme</h3>
<div class="card bg-light border-0 p-3">
    Kullanıcı gönder butonuna bastığında:
    <ol>
        <li>Mesaj, <strong>WebSocket</strong> üzerinden anında iletilir.</li>
        <li>Mesaj, arka planda asenkron olarak <strong>Firestore</strong>'a yedeklenir.</li>
    </ol>
</div>

<h3 class="mt-4 text-secondary">Adım 4: Bildirimler</h3>
<p>
    Kullanıcı yazı yazarken, soket sunucusuna bir "yazıyor" paketi gönderilir.
    Bu paket asla veritabanına yazılmaz, böylece sıfır depolama maliyeti sağlanır.
</p>

<?php include 'includes/footer.php'; ?>