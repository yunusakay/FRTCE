<?php include 'includes/header.php'; ?>

<h1>Data Workflow</h1>
<p>The four-stage process that occurs when the user opens the application.</p>

<h3>Step 1: Auth Handshake</h3>
<p>
    The user logs in. Firebase returns an ID Token.
    Flutter takes this token and sends a connection request to the WebSocket server.
</p>
<div class="code-display">
socket.connect('wss://api.chat.com', headers: {
    'Authorization': 'Bearer ' + firebaseUser.getIdToken()
});
</div>

<h3>Step 2: Sync</h3>
<p>
    While the socket connects, the application simultaneously fetches the last 50 messages from Firestore using lazy loading.
</p>

<h3>Step 3: Sending Message</h3>
<p>
    When the user presses send:
    <ol>
        <li>The message is delivered instantly via WebSocket.</li>
        <li>The message is backed up to Firestore asynchronously.</li>
    </ol>
</p>

<h3>Step 4: Notifications</h3>
<p>
    When the user types, a typing packet is sent to the socket server.
    This packet is never written to the database, ensuring zero storage cost.
</p>

<?php include 'includes/footer.php'; ?>