<?php include 'includes/header.php'; ?>

<h1 class="text-primary border-bottom pb-2">Performans ve Maliyet Analizi</h1>
<p>
    10.000 anlık kullanıcı senaryosunda "Sadece Firebase" yaklaşımı ile "Hibrit FRTCE Modeli" karşılaştırması.
</p>

<h3 class="mt-4">1. Aylık Maliyet Projeksiyonu</h3>
<table class="table table-hover mt-3">
    <thead class="table-dark">
        <tr>
            <th>Metrik</th>
            <th>Geleneksel Firebase</th>
            <th>Hibrit FRTCE</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td><strong>Veritabanı Yazma</strong></td>
            <td>Çok Yüksek</td>
            <td>Düşük</td>
        </tr>
        <tr>
            <td><strong>Bant Genişliği</strong></td>
            <td>Yüksek</td>
            <td>Düşük</td>
        </tr>
        <tr>
            <td><strong>Tahmini Maliyet</strong></td>
            <td class="text-danger fw-bold">$450 / Ay</td>
            <td class="text-success fw-bold">$60 / Ay</td>
        </tr>
    </tbody>
</table>

<h3 class="mt-4">2. Gecikme (Latency)</h3>
<div class="diagram-box">
    Firebase Snapshot: 600ms - 1500ms<br>
    WebSocket Tüneli: 50ms - 200ms
</div>

<?php include 'includes/footer.php'; ?>