<?php
session_start();
include("baglanti.php"); // baglanti.php dosyasını dahil et

if (!isset($_SESSION['ogrenciNo'])) {
    header("Location: cikis.php");
    exit();
}

$ogrenciNo = $_SESSION['ogrenciNo'];

$sql = "SELECT ogrenciAdi FROM ogrenciler WHERE ogrenciNo = '$ogrenciNo'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$ogrenciAdi = $row['ogrenciAdi'];


if (isset($_POST['talepEt'])) {
    $defterSorgu = "SELECT * FROM defterler WHERE ogrenciNo = '$ogrenciNo'";
    $defterSonuc = $conn->query($defterSorgu);

    // Öğrenciye ait kayıt yoksa, yeni bir kayıt oluşturabilirsiniz
    $ekle = "INSERT INTO defterler (ogrenciNo, ogrenciAdi, defterAktif) VALUES ('$ogrenciNo', '$ogrenciAdi', 'false')";
    $conn->query($ekle);
    

    header("Location: ogrenciPanel.php");
    exit();
}
?>
