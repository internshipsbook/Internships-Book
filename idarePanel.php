<?php
session_start();
include("baglanti.php"); // baglanti.php dosyasını dahil et

if (!isset($_SESSION['gorevliNo'])) {
    header("Location: cikis.php");
    exit();
}

$gorevliNo = $_SESSION['gorevliNo'];

$sql = "SELECT idareIsim FROM idare WHERE idareNumara = '$gorevliNo'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $idareIsim = $row['idareIsim'];
} else {
    header("Location: cikis.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>İdare Paneli</title>
</head>
<body>
    <h2>Hoşgeldiniz <?php echo $idareIsim; ?></h2>
    <!-- Diğer sayfa içeriği -->
    <a href="cikis.php">Çıkış Yap!</a> <br>
    <br>
    <h2>Öğrenci verileri:</h2> <br>

<?php
    // Defterler tablosundan sadece defterAktif değeri false olan verileri çek
    $sql = "SELECT ogrenciNo, ogrenciAdi, ogrenciAktif FROM ogrenciler WHERE ogrenciAktif = 'false'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "Öğrenci Numarası: " . $row["ogrenciNo"]. " - Öğrenci Adı: " . $row["ogrenciAdi"]. "<br>";
            echo '<form method="POST" action="ogrenciAktiflestir.php">';
            echo '<input type="hidden" name="ogrenciNo" value="' . $row["ogrenciNo"] . '">';
            echo '<input type="submit" name="submit" value="Aktifleştir">';
            echo '</form>';
        }
    } else {
        echo "Pasif defter bulunamadı.";
    }
?>

<h2>Stajı tamamlanan öğrenci</h2> <br>

<?php
// SQL sorgusu
$sql = "SELECT d.ogrenciNo, COUNT(*) AS dosyaSayisi 
        FROM dosyalar AS d
        INNER JOIN defterler AS de ON d.ogrenciNo = de.ogrenciNo
        WHERE d.dosyaOnay = true AND de.stajOnay = false
        GROUP BY d.ogrenciNo 
        HAVING COUNT(*) >= 5";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "" . $row["ogrenciNo"] . ", Numaralı öğrencinin stajı tamamlanmıştır, lütfen mezuniyetine onay veriniz!!!.<br>";

        // Onay butonu
        echo "<form action='stajOnayDegistir.php' method='POST'>";
        echo "<input type='hidden' name='ogrenciNo' value='" . $row['ogrenciNo'] . "'>";
        echo "<button type='submit' name='stajOnayla'>Stajı Onayla</button>";
        echo "</form><br>";
    }
} else {
    echo "Stajı tamamlanan öğrenci bulunamadı.";
}
?>


</body>
</html>
