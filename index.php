<?php include 'includes/header.php'; ?>

<h1>Research Hypothesis: The Hybrid Model</h1>
<p>
    Research indicates that a single technology is insufficient for a modern chat application.
    Attempting to run "Typing Indicators" on <strong>Firebase</strong> results in excessive database writes and costs.
    Conversely, building a secure authentication system solely on <strong>WebSockets</strong> is complex and risky.
</p>
<p>
    <strong>Conclusion:</strong> The optimal solution is an integrated architecture where Firebase handles 
    <em>State & Security</em>, while WebSockets handle <em>Real-time Events</em>.
</p>

<?php include 'includes/footer.php'; ?>