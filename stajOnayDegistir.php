<?php
include("baglanti.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Öğrenci numarasını al
    $ogrenciNo = $_POST['ogrenciNo'];

    // stajOnay değerini true olarak güncelle
    $sql = "UPDATE defterler SET stajOnay = true WHERE ogrenciNo = '$ogrenciNo'";

    if ($conn->query($sql) === TRUE) {
        echo '<script>alert("Öğrencinin stajı başarıyla onaylandı!"); 
            window.location.href="idarePanel.php";</script>';
    } else {
        echo "Hata oluştu: " . $conn->error;
    }
} else {
    echo "Geçersiz istek.";
}
?>