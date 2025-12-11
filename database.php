<?php include 'includes/header.php'; ?>

<h1 class="text-primary border-bottom pb-2">NoSQL Veritabanı Tasarımı</h1>
<p>
    Firestore, maliyetleri optimize etmek amacıyla sadece kalıcı veriler için kullanılır.
    Aşağıdaki şema, okuma işlemlerini azaltmak için <strong>Denormalizasyon</strong> tekniğini kullanır.
</p>

<h3 class="mt-4">Koleksiyon Yapısı</h3>
<div class="code-block">
users (Koleksiyon)
  └─ uid_12345
       ├─ kullaniciAdi: "Ahmet"
       ├─ avatarUrl: "https://..."
       └─ olusturulmaTarihi: ZAMAN_DAMGASI

chats (Koleksiyon)
  └─ chat_id_789
       ├─ katilimcilar: ["uid_12345", "uid_67890"]
       ├─ sonMesaj: "Yarın görüşürüz."
       ├─ sonMesajZamani: ZAMAN_DAMGASI
       └─ okunmamisSayisi: 2

messages (Alt Koleksiyon)
  └─ msg_id_001
       ├─ gonderenId: "uid_12345"
       ├─ icerik: "Yarın görüşürüz."
       ├─ tip: "metin"
       └─ zamanDamgasi: ZAMAN_DAMGASI
</div>

<h3 class="mt-4">Tasarım Kararları</h3>
<ul class="list-group">
    <li class="list-group-item"><strong>Veri Tekrarı:</strong> Son mesaj, sohbet listesinde alt koleksiyonu sorgulamamak için üst sohbet dökümanına kopyalanır.</li>
    <li class="list-group-item"><strong>Yazma Optimizasyonu:</strong> "Yazıyor" veya "Çevrimiçi" gibi durum güncellemeleri asla Firestore'a yazılmaz.</li>
</ul>

<?php include 'includes/footer.php'; ?>