<?php include 'includes/header.php'; ?>

<h1 class="text-primary border-bottom pb-2">Backend: WebSocket Sunucu Kodu</h1>
<p>
    Sunucu tarafında <strong>Node.js</strong> ve <strong>ws</strong> kütüphanesi kullanılmaktadır.
</p>

<h3 class="mt-4">server.js</h3>
<div class="code-block">
const WebSocket = require('ws');
const admin = require('firebase-admin');

// Sunucuyu başlat
const wss = new WebSocket.Server({ port: 8080 });

// Firebase ayarları
const serviceAccount = require('./firebase-service-account.json');
admin.initializeApp({
  credential: admin.credential.cert(serviceAccount)
});

wss.on('connection', async (ws, req) => {
    
    // Token kontrolü
    const params = new URLSearchParams(req.url.replace('/?', ''));
    const idToken = params.get('token');

    if (!idToken) {
        ws.close(1008, 'Token eksik');
        return;
    }

    try {
        const decodedToken = await admin.auth().verifyIdToken(idToken);
        ws.userId = decodedToken.uid;
        
        ws.on('message', (message) => {
            const data = JSON.parse(message);
            mesajiYayinla(data, ws.userId);
        });

    } catch (error) {
        ws.close(1008, 'Geçersiz Token');
    }
});
</div>

<?php include 'includes/footer.php'; ?>