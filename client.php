<?php include 'includes/header.php'; ?>

<h1>Client: Flutter Socket Service</h1>
<p>
    The client uses a Singleton pattern to manage the persistent connection.
</p>

<h3>socket_service.dart</h3>
<div class="code-display">
import 'package:web_socket_channel/io.dart';
import 'package:firebase_auth/firebase_auth.dart';

class SocketService {
  static final SocketService _instance = SocketService._internal();
  factory SocketService() => _instance;
  SocketService._internal();

  IOWebSocketChannel? _channel;

  Future<void> connect() async {
    User? user = FirebaseAuth.instance.currentUser;
    if (user == null) return;
    
    String? token = await user.getIdToken();

    final url = 'ws://192.168.1.50:8080?token=$token';
    _channel = IOWebSocketChannel.connect(Uri.parse(url));

    _channel!.stream.listen(
      (message) {
        // Handle incoming message
      },
      onError: (error) => print(error),
      onDone: () => print("Disconnected"),
    );
  }

  void sendMessage(String text) {
    if (_channel != null) {
      _channel!.sink.add('{"content": "$text"}');
    }
  }
  
  void disconnect() {
    _channel?.sink.close();
  }
}
</div>

<?php include 'includes/footer.php'; ?>