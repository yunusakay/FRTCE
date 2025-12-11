<?php include 'includes/header.php'; ?>

<h1 class="text-primary border-bottom pb-2">Araştırma Hipotezi: Hibrit Model</h1>
<p class="lead">
    Araştırmalar, modern bir sohbet uygulaması için tek bir teknolojinin yetersiz kaldığını göstermektedir.
    "Yazıyor..." göstergesini sadece <strong>Firebase</strong> üzerinden yönetmek, aşırı veritabanı yazma işlemine ve yüksek maliyete neden olur.
    Diğer taraftan, sadece <strong>WebSocket</strong> kullanarak güvenli bir kimlik doğrulama sistemi kurmak karmaşık ve risklidir.
</p>
<div class="alert alert-info border-start border-4 border-info">
    <strong>Sonuç:</strong> En optimum çözüm, Firebase'in <em>Durum ve Güvenlik</em> yönetimini üstlendiği, WebSocket'in ise <em>Gerçek Zamanlı Olayları</em> yönettiği entegre bir mimaridir.
</div>

<div class="diagram-box">
    SONUÇ: Hibrit Mimari En Uygun Çözümdür.
</div>

<h3 class="mt-4">Neden İkisini Birlikte Kullanmalıyız?</h3>
<ul class="list-group list-group-flush">
    <li class="list-group-item"><i class="fa-solid fa-shield text-success me-2"></i> <strong>Güvenlik:</strong> Firebase Authentication, JWT Token yönetimini üstlenir.</li>
    <li class="list-group-item"><i class="fa-solid fa-bolt text-warning me-2"></i> <strong>Hız:</strong> WebSocket, mesajların veritabanına uğramadan RAM üzerinden akmasını sağlar.</li>
    <li class="list-group-item"><i class="fa-solid fa-wallet text-danger me-2"></i> <strong>Maliyet:</strong> Gerçek zamanlı durum güncellemeleri (Online/Offline) Socket üzerinden sıfır veritabanı maliyetiyle yönetilir.</li>
</ul>

<?php include 'includes/footer.php'; ?>