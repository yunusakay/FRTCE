<?php include 'includes/header.php'; ?>

<h1 class="text-primary border-bottom pb-2">Güvenlik Protokolü</h1>
<p>
    WebSocket bağlantıları, Firebase Auth ile Token Tabanlı El Sıkışma mekanizması kullanılarak korunmaktadır.
</p>

<h3 class="mt-4">Güvenlik Akışı</h3>
<div class="alert alert-danger">
    <strong>Risk:</strong> Bir saldırgan, Firebase tarafından imzalanmış geçerli bir ID Token olmadan soket sunucusuna bağlanamaz.
</div>

<h3 class="mt-4">Sunucu Tarafı Doğrulama</h3>

<div class="code-block">
wss.on('connection', async (socket, request) => {
    // URL'den token'ı al
    const token = request.url.query.authToken;

    try {
        // Firebase ile doğrula
        const decodedToken = await admin.auth().verifyIdToken(token);
        
        socket.userId = decodedToken.uid;
        
    } catch (error) {
        // Token geçersizse bağlantıyı kopar
        socket.close(4001, "Yetkisiz Erişim");
    }
});
</div>

<?php include 'includes/footer.php'; ?>