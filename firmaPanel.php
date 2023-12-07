<?php
session_start();
include("baglanti.php"); // baglanti.php dosyasını dahil et

if (!isset($_SESSION['gorevliNo'])) {
    header("Location: cikis.php");
    exit();
}

$gorevliNo = $_SESSION['gorevliNo'];

$sql = "SELECT firmaIsim FROM firma WHERE firmaNumara = '$gorevliNo'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $firmaIsim = $row['firmaIsim'];
} else {
    header("Location: cikis.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Firma Paneli</title>
</head>
<body>
    <h2>Hoşgeldiniz <?php echo $firmaIsim; ?></h2>
    <!-- Diğer sayfa içeriği -->
    <a href="cikis.php">Çıkış Yap!</a> <br>

    <h2>Yüklenen dosyalar:</h2> <br>
    <?php
        // Dosyaları firmaNumara'ya göre çekme
        $dosyaSorgu = "SELECT * FROM dosyalar WHERE firmaNumara = '$gorevliNo'";
        $dosyaSonuc = $conn->query($dosyaSorgu);

        if ($dosyaSonuc->num_rows > 0) {
            while ($dosya = $dosyaSonuc->fetch_assoc()) {
                $ogrenciNo = $dosya['ogrenciNo'];
                $dosyaAdi = $dosya['dosya'];
                $dosyaOnay = $dosya['dosyaOnay'];
                $dosyaID = $dosya['dosyaID'];

                if(!$dosyaOnay) {
                echo "<form action='dosyaIslem.php' method='POST'>";
                echo "<p>Öğrenci Numarası: $ogrenciNo - Dosya Numarası: $dosyaID - Dosya Adı: ($dosyaAdi) - ";
                echo "<input type='hidden' name='dosyaID' value=$dosyaID>";
                echo "<button type='submit' name='dosyaOnayla' value='$dosyaAdi'>Onayla</button> - ";
                echo "<button type='submit' name='dosyaIndir' value='$dosyaAdi'>İndir</button> - ";
                echo "<button type='submit' name='dosyaSil'>Dosyayı Sil</button></p><br>";
                echo "</form>";
                }
            }
        } 
        
        else {
            echo "Dosya bulunamadı.";
        }
?>

</body>
</html>
