<?php include 'includes/header.php'; ?>

<h1 class="text-primary border-bottom pb-2">Kullanıcı Giriş Arayüzü ve Mantığı</h1>
<p>
    Giriş Sayfası, WebSocket güvenliği için gerekli olan JWT Token'ın üretildiği güvenli kapıdır.
</p>

<h3 class="mt-4">1. Tasarım Mantığı</h3>
<div class="diagram-box">
    [ Logo ]<br>
    [ E-posta Girişi ]<br>
    [ Şifre Girişi ]<br>
    [ GİRİŞ BUTONU (Firebase Auth) ]<br>
    ⬇️<br>
    Başarılı -> Token Al -> Sokete Bağlan -> Anasayfaya Git
</div>

<h3 class="mt-4">2. Flutter Uygulaması</h3>

<div class="code-block">
// Flutter Giriş Kodu Örneği
Future<void> _girisYap() async {
  try {
    // Firebase ile giriş
    UserCredential kullanici = await FirebaseAuth.instance
        .signInWithEmailAndPassword(email: _email.text, password: _sifre.text);

    // Token al
    String? token = await kullanici.user!.getIdToken();
    
    // Sokete bağlan
    await SocketService().baglan();

  } catch (e) {
    print("Hata: " + e.toString());
  }
}
</div>

<?php include 'includes/footer.php'; ?>