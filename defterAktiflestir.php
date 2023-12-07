<?php
include("baglanti.php");

    if (isset($_POST['submit'])) {
        $ogrenciNo = $_POST['ogrenciNo'];

        // DefterAktif değerini güncelle
        $update_sql = "UPDATE defterler SET defterAktif = true WHERE ogrenciNo = $ogrenciNo";
        $update_result = $conn->query($update_sql);
        

        if ($update_result === TRUE) {
            echo '<script>alert("Defter aktifleştirildi");
            window.location.href="danismanPanel.php";</script>';
        } else {
            echo "Güncelleme sırasında bir hata oluştu: " . $conn->error;
        }
    }
?>