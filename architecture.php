<?php include 'includes/header.php'; ?>

<h1>System Architecture and Design</h1>

<p>The FRTCE Architecture is designed to manage two distinct communication channels simultaneously.</p>

<h3>1. Architecture Diagram</h3>
<div class="diagram-box">
    [ FLUTTER CLIENT ]
    <br>⬇️ &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ⬇️<br>
    (HTTPS) &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; (WSS)<br>
    ⬇️ &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ⬇️<br>
    [ FIREBASE ] &nbsp;&nbsp; [ WEBSOCKET SERVER ]
</div>

<h3>2. Channel Responsibilities</h3>
<table>
    <tr>
        <th>Channel</th>
        <th>Technology</th>
        <th>Data Type</th>
    </tr>
    <tr>
        <td><strong>Slow Path (Secure)</strong></td>
        <td>Firebase Firestore</td>
        <td>User Profiles, Message History, Media Files</td>
    </tr>
    <tr>
        <td><strong>Fast Path (Live)</strong></td>
        <td>Node.js / Socket</td>
        <td>Instant Messages, Typing Indicators, Online Status</td>
    </tr>
</table>

<h3>3. Data Protocol</h3>
<p>The WebSocket data packet structure:</p>

<div class="code-display">
{
  "type": "MESSAGE_NEW",
  "payload": {
    "senderId": "uid_12345",
    "authToken": "firebase_jwt_xyz", 
    "content": "Hello world",
    "timestamp": 1715420000
  }
}
</div>

<?php include 'includes/footer.php'; ?>