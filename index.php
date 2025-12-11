<?php include 'includes/header.php'; ?>

<h1>Research Hypothesis: Hybrid Model</h1>
<p>
    Research indicates that a single technology is insufficient for a modern chat application.
    Running typing indicators solely on Firebase results in excessive database writes and costs.
    Conversely, building a secure authentication system solely on WebSockets is complex and risky.
</p>
<p>
    The optimal solution is an integrated architecture where Firebase handles 
    state and security, while WebSockets handle real-time events.
</p>

<div class="diagram-box">
    CONCLUSION: The Hybrid Architecture is the optimal solution.
</div>

<h3>Why Use Both?</h3>
<ul class="feature-list">
    <li><strong>Security:</strong> Firebase Authentication handles JWT Token management.</li>
    <li><strong>Speed:</strong> WebSockets allow messages to flow through RAM without hitting the database.</li>
    <li><strong>Cost:</strong> Real-time status updates are managed via Sockets at zero database cost.</li>
</ul>

<?php include 'includes/footer.php'; ?>