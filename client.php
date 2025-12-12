<?php include 'includes/header.php'; ?>

<h1 class="text-primary border-bottom pb-2">İstemci Kodu (Flutter)</h1>
<p class="lead">
    Flutter tarafında, kopan bağlantıları yönetmek ve uygulama genelinde tek bir soket bağlantısı kullanmak için 
    <strong>Singleton</strong> tasarım deseni tercih edilmiştir.
</p>

<h3 class="mt-4">socket_service.dart</h3>
<pre class="code-block">
import 'package:web_socket_channel/io.dart';
import 'package:firebase_auth/firebase_auth.dart';

class SocketService {
  // Singleton Yapısı: Uygulamanın her yerinden aynı nesneye erişim sağlar
  static final SocketService _instance = SocketService._internal();
  factory SocketService() => _instance;
  SocketService._internal();

  IOWebSocketChannel? _channel;

  // Sunucuya Bağlanma Fonksiyonu
  Future<void> baglan() async {
    // 1. Firebase'den mevcut kullanıcıyı al
    User? user = FirebaseAuth.instance.currentUser;
    
    if (user == null) {
      print("Hata: Kullanıcı giriş yapmamış.");
      return;
    }
    
    // 2. Güvenlik için taze bir ID Token al
    String? token = await user.getIdToken();

    // 3. Token'ı URL parametresi olarak ekle
    final url = 'ws://192.168.1.50:8080?token=$token';
    
    try {
      _channel = IOWebSocketChannel.connect(Uri.parse(url));
      print("Socket bağlantısı başlatılıyor...");

      // 4. Gelen Mesajları Dinle (Stream)
      _channel!.stream.listen(
        (message) {
          print("Yeni Mesaj Geldi: $message");
          // Buradan sonra veri Provider veya Bloc'a aktarılır
        },
        onError: (error) => print("Socket Hatası: $error"),
        onDone: () => print("Bağlantı Sunucu Tarafından Kapatıldı"),
      );
      
    } catch (e) {
      print("Bağlantı Hatası: $e");
    }
  }

  // Mesaj Gönderme Fonksiyonu
  void mesajGonder(String metin) {
    if (_channel != null) {
      _channel!.sink.add('{"content": "$metin"}');
    } else {
      print("Hata: Socket bağlı değil.");
    }
  }
  
  // Bağlantıyı Temizle
  void baglantiyiKes() {
    _channel?.sink.close();
  }
}
</pre>

<h3 class="mt-4">Kullanım Örneği (UI)</h3>
<pre class="code-block">
// Bir butona tıklandığında mesaj gönderme örneği
ElevatedButton(
  onPressed: () {
    // Servisi çağır ve mesajı gönder
    SocketService().mesajGonder("Merhaba Dünya!");
  },
  child: Text("Gönder"),
)
</pre>

<?php include 'includes/footer.php'; ?>