<?php
include("baglanti.php");

    if (isset($_POST['submit'])) {
        $ogrenciNo = $_POST['ogrenciNo'];

        // DefterAktif değerini güncelle
        $update_sql = "UPDATE ogrenciler SET ogrenciAktif = true WHERE ogrenciNo = $ogrenciNo";
        $update_result = $conn->query($update_sql);
        

        if ($update_result === TRUE) {
            echo '<script>alert("Öğrenci aktifleştirildi");
            window.location.href="idarePanel.php";</script>';
        } else {
            echo "Güncelleme sırasında bir hata oluştu: " . $conn->error;
        }
    }

?>
