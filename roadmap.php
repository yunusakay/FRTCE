<?php include 'includes/header.php'; ?>

<h1 class="text-primary border-bottom pb-2">Teknik Entegrasyon Süreci</h1>
<p class="lead">
    Bu proje, soyut bir fikir değil, teknik bir uygulamadır. Aşağıda, <strong>Firebase</strong> ve <strong>WebSocket</strong> teknolojilerinin 
    Flutter projesine adım adım nasıl entegre edildiği kod örnekleriyle açıklanmıştır.
</p>

<div class="step-card">
    <div class="d-flex align-items-center mb-2">
        <span class="step-number">01</span>
        <h4 class="mb-0">Kütüphanelerin Eklenmesi (pubspec.yaml)</h4>
    </div>
    <p>Projenin kalbi olan iki temel paket projeye dahil edildi.</p>
    <pre class="code-block">
dependencies:
  flutter:
    sdk: flutter
  # Firebase Çekirdek ve Kimlik Doğrulama
  firebase_core: ^2.24.2
  firebase_auth: ^4.16.0
  
  # WebSocket İletişimi İçin
  web_socket_channel: ^2.4.0
    </pre>
</div>

<div class="step-card" style="border-left-color: #ffc107;">
    <div class="d-flex align-items-center mb-2">
        <span class="step-number" style="color: #ffc107;">02</span>
        <h4 class="mb-0">Firebase Başlatma (main.dart)</h4>
    </div>
    <p>Uygulama açılır açılmaz Firebase ile el sıkışması gerekir. Bu kod <code>main()</code> fonksiyonuna eklendi.</p>
    <pre class="code-block">
void main() async {
  WidgetsFlutterBinding.ensureInitialized();
  
  // Firebase'i başlat
  await Firebase.initializeApp(
    options: DefaultFirebaseOptions.currentPlatform,
  );
  
  runApp(const MyApp());
}
    </pre>
</div>

<div class="step-card" style="border-left-color: #198754;">
    <div class="d-flex align-items-center mb-2">
        <span class="step-number" style="color: #198754;">03</span>
        <h4 class="mb-0">Hibrit Bağlantı Mantığı (Core Logic)</h4>
    </div>
    <p>
        Burası projenin kilit noktasıdır. Firebase'den alınan <strong>Güvenli Token</strong>, 
        WebSocket bağlantısına <strong>Header</strong> olarak eklenir.
    </p>
    <div class="alert alert-light border">
        <strong>Neden?</strong> Sunucu, gelen kişinin kim olduğunu ancak bu Token sayesinde anlayabilir.
    </div>
    <pre class="code-block">
// 1. Firebase'den o anki kullanıcının Token'ını al
String? token = await FirebaseAuth.instance.currentUser?.getIdToken();

// 2. Bu Token'ı WebSocket bağlantısına ekle
final channel = IOWebSocketChannel.connect(
  Uri.parse('wss://sunucu-adresi.com/ws'),
  headers: {
    'Authorization': 'Bearer $token' // <-- İşte Entegrasyon Burada!
  },
);
    </pre>
</div>

<div class="step-card" style="border-left-color: #dc3545;">
    <div class="d-flex align-items-center mb-2">
        <span class="step-number" style="color: #dc3545;">04</span>
        <h4 class="mb-0">Gerçek Zamanlı Dinleme (StreamBuilder)</h4>
    </div>
    <p>Gelen mesajları ekrana basmak için WebSocket kanalı bir "Stream" olarak UI'a verilir.</p>
    <pre class="code-block">
StreamBuilder(
  stream: channel.stream, // Soketten gelen veriyi dinle
  builder: (context, snapshot) {
    return Text(snapshot.hasData ? '${snapshot.data}' : 'Mesaj bekleniyor...');
  },
)
    </pre>
</div>

<?php include 'includes/footer.php'; ?>