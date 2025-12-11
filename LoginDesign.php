<?php include 'includes/header.php'; ?>

<h1>User Login UI & Logic</h1>
<p>
    The Login Page is the secure entry point that generates the JWT Token required for WebSocket security.
</p>

<h3>1. Design Logic</h3>
<div class="diagram-box">
    [ Logo ]<br>
    [ Email Input ]<br>
    [ Password Input ]<br>
    [ LOGIN BUTTON (Firebase Auth) ]<br>
    ⬇️<br>
    Success -> Get Token -> Connect Socket -> Navigate Home
</div>

<h3>2. Flutter Implementation</h3>

<div class="code-display">
import 'package:flutter/material.dart';
import 'package:firebase_auth/firebase_auth.dart';
import 'socket_service.dart';

class LoginScreen extends StatefulWidget {
  @override
  _LoginScreenState createState() => _LoginScreenState();
}

class _LoginScreenState extends State<LoginScreen> {
  final _emailInput = TextEditingController();
  final _passwordInput = TextEditingController();
  
  Future<void> _handleLogin() async {
    try {
      UserCredential userCredential = await FirebaseAuth.instance
          .signInWithEmailAndPassword(
              email: _emailInput.text.trim(),
              password: _passwordInput.text.trim()
          );

      String? token = await userCredential.user!.getIdToken();
      
      await SocketService().connect();

      Navigator.pushReplacementNamed(context, '/chat');

    } on FirebaseAuthException catch (e) {
      ScaffoldMessenger.of(context).showSnackBar(
        SnackBar(content: Text("Login Failed: ${e.message}"))
      );
    }
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      body: Padding(
        padding: EdgeInsets.all(20),
        child: Column(
          children: [
            TextField(controller: _emailInput),
            TextField(controller: _passwordInput, obscureText: true),
            ElevatedButton(
              onPressed: _handleLogin,
              child: Text("LOGIN"),
            )
          ],
        ),
      ),
    );
  }
}
</div>

<?php include 'includes/footer.php'; ?>