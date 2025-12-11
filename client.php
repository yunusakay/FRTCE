<?php include 'includes/header.php'; ?>

<h1 class="text-primary border-bottom pb-2">İstemci: Flutter Socket Servisi</h1>
<p>
    İstemci tarafı, kalıcı bağlantıyı yönetmek için Singleton tasarım desenini kullanır.
</p>

<h3 class="mt-4">socket_service.dart</h3>
<div class="code-block">
import 'package:web_socket_channel/io.dart';
import 'package:firebase_auth/firebase_auth.dart';

class SocketService {
  static final SocketService _ornek = SocketService._dahili();
  factory SocketService() => _ornek;
  SocketService._dahili();

  IOWebSocketChannel? _kanal;

  Future<void> baglan() async {
    User? kullanici = FirebaseAuth.instance.currentUser;
    if (kullanici == null) return;
    
    String? token = await kullanici.getIdToken();

    final url = 'ws://192.168.1.50:8080?token=$token';
    _kanal = IOWebSocketChannel.connect(Uri.parse(url));

    _kanal!.stream.listen(
      (mesaj) {
        // Gelen mesajı işle
      },
      onError: (hata) => print(hata),
      onDone: () => print("Bağlantı koptu"),
    );
  }
}
</div>

<?php include 'includes/footer.php'; ?>