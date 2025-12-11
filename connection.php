<?php
$veritabaniSunucu = 'localhost';
$veritabaniAdi = 'FRTCEDB';
$veritabaniKullanici = 'root';
$veritabaniSifre = '';

try {
    $baglanti = new PDO("mysql:host=$veritabaniSunucu;dbname=$veritabaniAdi;charset=utf8", $veritabaniKullanici, $veritabaniSifre);
    $baglanti->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Bağlantı hatası: " . $e->getMessage());
}
?>