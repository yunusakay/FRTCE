<?php include 'includes/header.php'; ?>

<h1 class="text-primary border-bottom pb-2">NoSQL Veritabanı Tasarımı</h1>
<p class="lead">
    Firestore maliyetlerini optimize etmek için <strong>Denormalizasyon</strong> tekniği kullanılmıştır.
    Aşağıdaki şema, okuma sayılarını en aza indirmek için tasarlanmıştır.
</p>

<h3 class="mt-4">Koleksiyon Yapısı (JSON)</h3>
<pre class="code-block">
📂 users (Koleksiyon)
  └─ 📄 uid_12345
       ├─ kullaniciAdi: "Ahmet"
       ├─ avatarUrl: "https://ornek.com/foto.jpg"
       └─ olusturulmaTarihi: TIMESTAMP

📂 chats (Koleksiyon)
  └─ 📄 chat_id_abc
       ├─ katilimcilar: ["uid_12345", "uid_67890"]
       ├─ sonMesaj: "Projeyi tamamladın mı?"  // <-- Liste ekranı için kopya
       ├─ sonMesajZamani: TIMESTAMP
       └─ okunmamisSayisi: 2

📂 messages (Alt Koleksiyon)
  └─ 📄 msg_id_xyz
       ├─ gonderenId: "uid_12345"
       ├─ icerik: "Projeyi tamamladın mı?"
       ├─ tip: "text" (veya "image")
       └─ zamanDamgasi: TIMESTAMP
</pre>

<h3 class="mt-4">Optimizasyon Notları</h3>
<ul class="list-group">
    <li class="list-group-item">
        <i class="fa-solid fa-check text-success"></i> 
        <strong>Veri Tekrarı:</strong> Sohbet listesinde her seferinde alt koleksiyona sorgu atmamak için son mesaj bilgisi üst dökümanda tutulur.
    </li>
    <li class="list-group-item">
        <i class="fa-solid fa-check text-success"></i> 
        <strong>Yazma Tasarrufu:</strong> "Yazıyor..." veya "Çevrimiçi" durumları buraya ASLA yazılmaz, sadece WebSocket üzerinden iletilir.
    </li>
</ul>

<?php include 'includes/footer.php'; ?>