<?php include 'includes/header.php'; ?>

<h1>Security Protocol</h1>
<p>
    WebSocket connections are secured using a Token-Based Handshake mechanism with Firebase Auth.
</p>

<h3>Security Flow</h3>
<div class="diagram-box">
    An attacker cannot connect to the socket server without a valid ID Token signed by Firebase.
</div>

<h3>Server Side Verification</h3>

<div class="code-display">
wss.on('connection', async (socket, request) => {
    const token = request.url.query.authToken;

    try {
        const decodedToken = await admin.auth().verifyIdToken(token);
        
        socket.userId = decodedToken.uid;
        
    } catch (error) {
        socket.close(4001, "Unauthorized");
    }
});
</div>

<?php include 'includes/footer.php'; ?>