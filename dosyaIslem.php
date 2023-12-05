<?php
session_start();
include("baglanti.php");

if (isset($_POST['dosyaOnayla'])) {
    $dosyaID = $_POST['dosyaID'];

    // DosyaOnayla fonksiyonu
    
    $updateQuery = "UPDATE dosyalar SET dosyaOnay = true WHERE dosyaID = '$dosyaID'";
    $updateResult = $conn->query($updateQuery);

    if ($updateResult === TRUE) {
        echo "<script>alert('Dosya başarıyla onaylandı!')"; 
        header("Location: firmaPanel.php");
        exit();
    } else {
        echo "Hata oluştu: " . $conn->error;
    }
}

if (isset($_POST['dosyaIndir'])) {
    $dosyaAdi = $_POST['dosya'];
    $dosyaYolu = "uploads/" . $dosyaAdi;

    if (file_exists($dosyaYolu)) {
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename=' . basename($dosyaYolu));
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($dosyaYolu));
        readfile($dosyaYolu);
        exit;
    } else {
        echo "Dosya bulunamadı.";
    }
}

if (isset($_POST['dosyaSil'])) {
    $dosyaID = $_POST['dosyaID'];

    // Dosyayı silme işlemi
    $dosyaSilSorgu = "DELETE FROM dosyalar WHERE dosyaID = $dosyaID";
    $dosyaSilResult = $conn->query($dosyaSilSorgu);
    // Burada sorguyu çalıştırabilir ve dosyayı silebilirsiniz
    if ($dosyaSilResult === TRUE) {
        echo "<script>alert('Dosya başarıyla silindi!')"; 
        header("Location: firmaPanel.php");
        exit();
    } else {
        echo "Hata oluştu: " . $conn->error;
    }
}


?>
