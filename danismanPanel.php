<?php
session_start();
include("baglanti.php"); // baglanti.php dosyasını dahil et

if (!isset($_SESSION['gorevliNo'])) {
    header("Location: cikis.php");
    exit();
}

$gorevliNo = $_SESSION['gorevliNo'];

$sql = "SELECT danismanIsim FROM danisman WHERE danismanNumara = '$gorevliNo'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $danismanIsim = $row['danismanIsim'];
} else {
    header("Location: cikis.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Danışman Paneli</title>
</head>
<body>
    <h2>Hoşgeldiniz <?php echo $danismanIsim; ?></h2>
    <!-- Diğer sayfa içeriği -->
    <a href="cikis.php">Çıkış Yap!</a>
    <br>
    <h2>Öğrenci verileri:</h2> <br>

<?php
    // Defterler tablosundan sadece defterAktif değeri false olan verileri çek
    $sql = "SELECT ogrenciNo, ogrenciAdi, defterAktif FROM defterler WHERE defterAktif = 'false'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "Öğrenci Numarası: " . $row["ogrenciNo"]. " - Öğrenci Adı: " . $row["ogrenciAdi"]. "<br>";
            echo '<form method="POST" action="defterAktiflestir.php">';
            echo '<input type="hidden" name="ogrenciNo" value="' . $row["ogrenciNo"] . '">';
            echo '<input type="submit" name="submit" value="Aktifleştir">';
            echo '</form>';
        }
    } else {
        echo "Pasif defter bulunamadı.";
    }
?>

<h2>Yüklenen Dosyalar:</h2> <br>

<form method="GET">
    <input type="text" name="search" placeholder="Öğrenci Numarası Ara...">
    <input type="submit" value="Ara">
</form> <br>
<?php
if (isset($_GET['search']) && !empty($_GET['search'])) {
    // Arama kutusundan gelen değeri alın
    $search = $_GET['search'];

    // Eğer arama yapıldıysa ve boş değilse
    if (!empty($search)) {
        $dosyaSorgu = "SELECT dosyalar.*, firma.firmaIsim FROM dosyalar INNER JOIN firma ON dosyalar.firmaNumara = firma.firmaNumara WHERE dosyaOnay = true AND ogrenciNo = '$search' ORDER BY dosyalar.ogrenciNo, dosyalar.dosyaID";
    } else {
        // Arama yapılmadıysa, tüm dosyaları göster
        $dosyaSorgu = "SELECT dosyalar.*, firma.firmaIsim FROM dosyalar INNER JOIN firma ON dosyalar.firmaNumara = firma.firmaNumara WHERE dosyalar.dosyaOnay = true AND ogrenciNo = '$search' ORDER BY dosyalar.ogrenciNo, dosyalar.dosyaID";
    }

    // Sorguyu çalıştır
    $dosyaSonuc = $conn->query($dosyaSorgu);

    // Sorgudan dönen sonuçları kullanarak dosyaları göster
    if ($dosyaSonuc->num_rows > 0) {
        while ($dosya = $dosyaSonuc->fetch_assoc()) {
            // Dosya bilgilerini burada göster (örneğin: echo $dosya['dosyaAdi'])
            //echo "<p>Dosya Adı: " . $dosya['dosya'] . "</p>";
            echo "<form action='dosyaOnay.php' method='POST'>";
            echo "<p>Öğrenci Numarası: " . $dosya['ogrenciNo'] . " - Firma Ismi: " . $dosya['firmaIsim'] . " - Dosya Numarası: " . $dosya['dosyaID'] . " - Dosya Adı: (" . $dosya['dosya'] . ") ";
            echo "<button type='submit' name='dosyaIndir' value='" . $dosya['dosya'] . "'>İndir</button></p> <br> ";
            echo "</form>";
        }
    } else {
        echo "Henüz kayıt bulunamamaktadır.";
    }
}

else
{
    $dosyaSorgu = "SELECT dosyalar.*, firma.firmaIsim FROM dosyalar INNER JOIN firma ON dosyalar.firmaNumara = firma.firmaNumara WHERE dosyalar.dosyaOnay = true ORDER BY dosyalar.ogrenciNo, dosyalar.dosyaID";
    $dosyaSonuc = $conn->query($dosyaSorgu);

    if ($dosyaSonuc->num_rows > 0) {
        while ($dosya = $dosyaSonuc->fetch_assoc()) {

            echo "<form action='dosyaOnay.php' method='POST'>";
            echo "<p>Öğrenci Numarası: " . $dosya['ogrenciNo'] . " - Firma Ismi: " . $dosya['firmaIsim'] . " - Dosya Numarası: " . $dosya['dosyaID'] . " - Dosya Adı: (" . $dosya['dosya'] . ") ";
            echo "<button type='submit' name='dosyaIndir' value='" . $dosya['dosya'] . "'>İndir</button></p> <br> ";
            echo "</form>";
        }
    } else {
        echo "Henüz kayıt bulunamamaktadır.";
    }
}
?>


</body>
</html>
