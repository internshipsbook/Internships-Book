<?php
session_start();
include("baglanti.php");

if (isset($_SESSION['ogrenciNo']) && isset($_FILES['dosya'])) {
    $dosya = $_FILES['dosya'];
    $dosyaAdi = $dosya['name'];
    $dosyaYolu = $dosya['tmp_name'];
    $firmaNumara = $_POST['firmaNumara'];
    $defterID = $_POST['defterID'];

    // Öğrencinin numarasını al
    $ogrenciNo = $_SESSION['ogrenciNo'];

    // Dosyayı kaydet
    $hedefKlasor = "uploads/";
    $hedefDosya = $hedefKlasor . basename($dosyaAdi);

    if (move_uploaded_file($dosyaYolu, $hedefDosya)) {
        // Dosya başarıyla yüklendi, veritabanına ekle
        $dosyaEkleSorgu = "INSERT INTO dosyalar (ogrenciNo, defterID, dosya, dosyaOnay, firmaNumara) VALUES ('$ogrenciNo', '$defterID', '$hedefDosya', FALSE, $firmaNumara)";
        $conn->query($dosyaEkleSorgu);

        echo "<script>alert('Dosya yükleme başarılı!'); window.location='ogrenciPanel.php';</script>";
        exit();
    } else {
        echo "<script>alert('Dosya yüklenirken bir hata oluştu.');  window.location='ogrenciPanel.php';</script>";
    }
} else {
    echo "<script>alert('Lütfen bir dosya seçin.');  window.location='ogrenciPanel.php';</script>";
}
?>
