<?php include 'includes/header.php'; ?>

<h1>NoSQL Veritabanı Tasarımı</h1>
<p>
    Hibrit mimaride Firestore, sadece "Kalıcı Veri" (Persistent Data) için kullanılır. 
    Aşağıda, maliyeti düşürmek için optimize edilmiş koleksiyon yapısı gösterilmiştir.
</p>

<h3>Koleksiyon Yapısı (JSON Schema)</h3>
<div class="code-block">
📂 users (Collection)
  └─ 📄 user_id_123
       ├─ username: "Yunus"
       ├─ avatar: "url..."
       └─ last_seen: TIMESTAMP

📂 chats (Collection)
  └─ 📄 chat_id_abc
       ├─ participants: ["user_123", "user_456"]
       └─ last_message: "Projeyi bitirdin mi?" (Önizleme için)

📂 messages (Sub-Collection)
  └─ 📄 message_id_xyz
       ├─ sender_id: "user_123"
       ├─ content: "Projeyi bitirdin mi?"
       ├─ type: "text" (veya image)
       └─ created_at: TIMESTAMP
</div>

<h3>Optimizasyon Notları</h3>
<ul class="feature-list">
    <li><strong>Denormalizasyon:</strong> Sohbet listesinde her seferinde mesajları çekmemek için <code>last_message</code> alanı üst dökümanda tutulur.</li>
    <li><strong>Yazma Tasarrufu:</strong> "Yazıyor..." veya "Çevrimiçi" durumları buraya ASLA yazılmaz (Socket ile taşınır).</li>
</ul>

<?php include 'includes/footer.php'; ?>