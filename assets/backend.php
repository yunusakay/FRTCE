<?php include 'includes/header.php'; ?>

<h1>Backend: WebSocket Server Code</h1>
<p>
    The server uses Node.js and the ws library.
</p>

<h3>server.js</h3>
<div class="code-display">
const WebSocket = require('ws');
const admin = require('firebase-admin');

const wss = new WebSocket.Server({ port: 8080 });

const serviceAccount = require('./firebase-service-account.json');
admin.initializeApp({
  credential: admin.credential.cert(serviceAccount)
});

wss.on('connection', async (ws, req) => {
    
    const params = new URLSearchParams(req.url.replace('/?', ''));
    const idToken = params.get('token');

    if (!idToken) {
        ws.close(1008, 'Token missing');
        return;
    }

    try {
        const decodedToken = await admin.auth().verifyIdToken(idToken);
        ws.userId = decodedToken.uid;
        
        ws.on('message', (message) => {
            const data = JSON.parse(message);
            broadcastMessage(data, ws.userId);
        });

    } catch (error) {
        ws.close(1008, 'Invalid Token');
    }
});

function broadcastMessage(data, senderId) {
    wss.clients.forEach(client => {
        if (client.readyState === WebSocket.OPEN) {
            client.send(JSON.stringify({
                sender: senderId,
                content: data.content,
                timestamp: Date.now()
            }));
        }
    });
}
</div>

<?php include 'includes/footer.php'; ?>