<?php
session_start();
include("baglanti.php"); // baglanti.php dosyasını dahil et

if (!isset($_SESSION['ogrenciNo'])) {
    header("Location: cikis.php");
    exit();
}

$ogrenciNo = $_SESSION['ogrenciNo'];

$sql = "SELECT ogrenciAdi FROM ogrenciler WHERE ogrenciNo = '$ogrenciNo' ";
$result = $conn->query($sql);

$sqlAktif = "SELECT ogrenciAktif FROM ogrenciler WHERE ogrenciNo = '$ogrenciNo' ";
$resultAktif = $conn->query($sqlAktif);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $ogrenciAdi = $row['ogrenciAdi'];
    
    if ($resultAktif->num_rows > 0) {
        $row = $resultAktif->fetch_assoc();
        if ($row['ogrenciAktif'] == true) {
            // Kullanıcı giriş yapabilir, işlemleri devam ettir
        } else {
            // Kullanıcı aktif değil, giriş yapamaz, uygun bir mesajla kullanıcıyı bilgilendir
            echo "<script>alert('Öğrenci aktif değil. Lütfen onaylanmayı bekleyiniz!'); window.location.href = 'cikis.php'</script>";
            exit();
        }
    } else {
        // Kullanıcı bulunamadı veya hatalı giriş yapıldı, uygun bir mesajla kullanıcıyı bilgilendir
    }
    
} else {
    header("Location: cikis.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Öğrenci Paneli</title>
</head>
<body>
    <h2>Hoşgeldiniz <?php echo $ogrenciAdi; ?>

    <?php
    $sql = "SELECT * FROM defterler WHERE ogrenciNo = '$ogrenciNo' AND stajOnay = 1";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Mezun olan öğrenci, tebrik mesajını yazdır
        echo "Tebrikler mezun oldunuz, çalışma hayatınızda başarılar dileriz!</h2>";
    } else {
        // Mezun olmayan öğrenci
        echo "</h2>";
    }
?><br>

    <a href="cikis.php">Çıkış Yap!</a>
    <!-- Diğer sayfa içeriği -->
    <h2>Staj Bilgileri</h2> <br>

<?php
    // Defter talebi kontrolü
    $defterSorgu = "SELECT * FROM defterler WHERE ogrenciNo = '$ogrenciNo'";
    $defterSonuc = $conn->query($defterSorgu);

    if ($defterSonuc->num_rows > 0) {
        $defterRow = $defterSonuc->fetch_assoc();
        $defterAktif = $defterRow['defterAktif'];
        $defterID = $defterRow['defterID'];

        if ($defterAktif) {
            // Dosya Yükleme Formu 
            echo " 
            <form action='dosyaYukle.php' method='POST' enctype='multipart/form-data'>
                <input type='file' name='dosya' /> <br> <br>

                <label for='firma'>Firma Numarası:</label>
                <select name='firmaNumara' id='firma'>
                    ";
                        // Firma numaralarını veritabanından çekme işlemi
                        $firmaSorgu = "SELECT firmaNumara, firmaIsim FROM firma";
                        $firmaSonuc = $conn->query($firmaSorgu);

                        if ($firmaSonuc->num_rows > 0) {
                            while ($firma = $firmaSonuc->fetch_assoc()) {
                                echo "<option value='" . $firma['firmaNumara'] . "'>" . $firma['firmaIsim'] . "</option>";
                            }
                        } 
                    echo "
                </select><br>
                
                <input type='hidden' name='defterID' value='$defterID'>
                <input type='submit' name='dosyaYukle' value='Dosya Yükle' /> 
            </form> <br>";

            // Öğrencinin yüklediği dosya sayısını al
            $dosyaSayisiSorgu = "SELECT COUNT(*) AS dosyaSayisi FROM dosyalar WHERE ogrenciNo = '$ogrenciNo'";
            $dosyaSayisiSonuc = $conn->query($dosyaSayisiSorgu);

            if ($dosyaSayisiSonuc->num_rows > 0) {
                $dosyaSatir = $dosyaSayisiSonuc->fetch_assoc();
                $dosyaSayisi = $dosyaSatir['dosyaSayisi'];

                echo "Toplam yüklenen dosya sayısı: $dosyaSayisi";
            }
        } 
        
        else {
            echo "<p>Staj defteri talep edildi, bekleyin.</p>";
        }
    } 
    
    else {
        // Staj defteri talep et butonu
        echo "<form action='ogrenciDefterTalep.php' method='POST'>";
        echo "<input type='submit' name='talepEt' value='Staj Defteri Talep Et'>";
        echo "</form>";
    }
?> <br>


</body>
</html>
