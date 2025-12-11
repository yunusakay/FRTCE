<?php include 'includes/header.php'; ?>

<h1>NoSQL Database Design</h1>
<p>
    Firestore is used solely for persistent data to optimize costs.
    The schema below uses denormalization to reduce read operations.
</p>

<h3>Collection Structure</h3>
<div class="code-display">
users (Collection)
  └─ uid_12345
       ├─ username: "John"
       ├─ avatarUrl: "https://..."
       └─ createdAt: TIMESTAMP

chats (Collection)
  └─ chat_id_789
       ├─ participants: ["uid_12345", "uid_67890"]
       ├─ lastMessage: "See you tomorrow."
       ├─ lastMessageTime: TIMESTAMP
       └─ unreadCount: 2

messages (Sub-Collection)
  └─ msg_id_001
       ├─ senderId: "uid_12345"
       ├─ content: "See you tomorrow."
       ├─ type: "text"
       └─ timestamp: TIMESTAMP
</div>

<h3>Design Decisions</h3>
<ul class="feature-list">
    <li><strong>Duplication:</strong> The last message is copied to the parent chat document to avoid querying the sub-collection for the list view.</li>
    <li><strong>Write Optimization:</strong> Status updates like typing or online are never written to Firestore.</li>
</ul>

<?php include 'includes/footer.php'; ?>