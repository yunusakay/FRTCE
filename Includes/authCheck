<?php
session_start();

// Eğer oturum açılmamışsa, login sayfasına gönder
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}
?>