<?php include 'includes/header.php'; ?>

<h1>Veri Akış Senaryosu (Workflow)</h1>
<p>Kullanıcı uygulamayı açtığında arka planda gerçekleşen 4 aşamalı süreç aşağıdadır.</p>

<h3>Adım 1: Kimlik Doğrulama (Auth Handshake)</h3>
<p>
    Kullanıcı şifresiyle giriş yapar. Firebase bir <strong>ID Token</strong> döner. 
    Flutter, bu token'ı alıp WebSocket sunucusuna bağlantı isteği (Handshake) gönderir.
</p>
<div class="code-block">
// Flutter Kodu (Örnek)
socket.connect('wss://api.chat.com', headers: {
    'Authorization': 'Bearer ' + firebaseUser.getIdToken()
});
</div>

<h3>Adım 2: Geçmişi Yükle (Sync)</h3>
<p>
    Socket bağlanırken, uygulama aynı anda Firestore'dan son 50 mesajı çeker (Lazy Loading). 
    Böylece kullanıcı bekletilmez.
</p>

<h3>Adım 3: Mesaj Gönderme</h3>
<p>
    Kullanıcı "Gönder" butonuna bastığında:
    <ol>
        <li>Mesaj <strong>WebSocket</strong> ile anında karşı tarafa iletilir (Milisaniyeler içinde).</li>
        <li>Mesaj arka planda (Asenkron) <strong>Firestore</strong> veritabanına yedeklenir.</li>
    </ol>
</p>

<h3>Adım 4: Anlık Bildirimler</h3>
<p>
    Kullanıcı yazı yazarken, Socket sunucusuna <code>{"type": "TYPING"}</code> paketi atılır. 
    Bu paket veritabanına kaydedilmez, sadece karşı tarafa iletilir. Bu sayede veritabanı maliyeti <strong>Sıfır</strong> olur.
</p>

<?php include 'includes/footer.php'; ?>