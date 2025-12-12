<?php include 'includes/header.php'; ?>

<h1 class="text-primary border-bottom pb-2">Sunucu Kodu (Node.js)</h1>
<p class="lead">
    Sunucu tarafında, WebSocket bağlantılarını yönetmek ve Firebase Token doğrulamasını yapmak için 
    <strong>Node.js</strong> ve <strong>ws</strong> kütüphanesi kullanılmıştır.
</p>

<div class="alert alert-warning">
    <i class="fa-solid fa-triangle-exclamation"></i> 
    Bu kod, sunucunun <code>server.js</code> dosyasının temel yapısıdır.
</div>

<h3 class="mt-4">server.js</h3>
<pre class="code-block">
const WebSocket = require('ws');
const admin = require('firebase-admin');

// 1. WebSocket Sunucusunu 8080 portunda başlat
const wss = new WebSocket.Server({ port: 8080 });

// 2. Firebase Admin SDK Kurulumu
// (Firebase Konsolundan indirilen gizli anahtar dosyası)
const serviceAccount = require('./firebase-service-account.json');

admin.initializeApp({
  credential: admin.credential.cert(serviceAccount)
});

console.log("WebSocket Sunucusu Başlatıldı: Port 8080");

// 3. İstemci Bağlantılarını Dinle
wss.on('connection', async (ws, req) => {
    
    // URL'den Token parametresini ayıkla
    // Örnek: ws://localhost:8080?token=EYJhbGci...
    const params = new URLSearchParams(req.url.replace('/?', ''));
    const idToken = params.get('token');

    if (!idToken) {
        console.log("Bağlantı Reddedildi: Token Yok");
        ws.close(1008, 'Token Eksik');
        return;
    }

    try {
        // 4. KRİTİK ADIM: Token Doğrulama
        // Firebase sunucularına bu tokenin gerçek olup olmadığını soruyoruz
        const decodedToken = await admin.auth().verifyIdToken(idToken);
        
        // Doğrulama başarılı ise kullanıcı ID'sini sokete kaydet
        ws.userId = decodedToken.uid;
        console.log(`Güvenli Bağlantı Kuruldu: ${ws.userId}`);
        
        // Gelen mesajları dinle
        ws.on('message', (message) => {
            const data = JSON.parse(message);
            
            // Mesajı diğer kullanıcılara ilet
            tumKullanicilaraYay(data, ws.userId);
        });

    } catch (error) {
        console.error('Yetkisiz Giriş Denemesi:', error.message);
        ws.close(1008, 'Geçersiz Token');
    }
});

// Yardımcı Fonksiyon: Mesajı Yay (Broadcast)
function tumKullanicilaraYay(data, gonderenId) {
    wss.clients.forEach(client => {
        // Sadece bağlantısı açık olanlara gönder
        if (client.readyState === WebSocket.OPEN) {
            client.send(JSON.stringify({
                gonderen: gonderenId,
                icerik: data.content,
                zaman: Date.now()
            }));
        }
    });
}
</pre>

<?php include 'includes/footer.php'; ?>