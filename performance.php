<?php include 'includes/header.php'; ?>

<h1>Performance and Cost Analysis</h1>
<p>
    Comparison between a Pure Firebase approach and the Hybrid FRTCE Model with 10,000 concurrent users.
</p>

<h3>1. Monthly Cost Projection</h3>
<table>
    <tr>
        <th>Metric</th>
        <th>Legacy Firebase</th>
        <th>Hybrid FRTCE</th>
    </tr>
    <tr>
        <td><strong>Database Writes</strong></td>
        <td>Very High</td>
        <td>Low</td>
    </tr>
    <tr>
        <td><strong>Bandwidth</strong></td>
        <td>High</td>
        <td>Low</td>
    </tr>
    <tr>
        <td><strong>Estimated Cost</strong></td>
        <td style="color:red; font-weight:bold;">$450 / Month</td>
        <td style="color:green; font-weight:bold;">$60 / Month</td>
    </tr>
</table>

<h3>2. Latency</h3>
<div class="diagram-box">
    Firebase Snapshot: 600ms - 1500ms<br>
    WebSocket Tunnel: 50ms - 200ms
</div>

<?php include 'includes/footer.php'; ?>