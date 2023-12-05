<?php
include("baglanti.php"); // baglanti.php dosyasını dahil et

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['ogrenciKaydet'])) {

    $ogrenciID = $_POST['ogrenciID'];
    $ogrenciNo = $_POST['ogrenciNo'];
    $ogrenciAdi = $_POST['ogrenciAdi'];
    $ogrenciSifre = $_POST['ogrenciSifre'];
    $ogrenciTelefon = $_POST['ogrenciTelefon'];
    $ogrenciMail = $_POST['ogrenciMail'];

    $ogrenciID = mysqli_real_escape_string($conn, $ogrenciID);
    $ogrenciNo = mysqli_real_escape_string($conn, $ogrenciNo);
    $ogrenciAdi = mysqli_real_escape_string($conn, $ogrenciAdi);
    $ogrenciSifre = mysqli_real_escape_string($conn, $ogrenciSifre);
    $ogrenciTelefon = mysqli_real_escape_string($conn, $ogrenciTelefon);
    $ogrenciMail = mysqli_real_escape_string($conn, $ogrenciMail);

    $sql = "INSERT INTO ogrenciler (ogrenciId, ogrenciNo, ogrenciAdi, ogrenciSifre, ogrenciTelefon, ogrenciEmail, ogrenciAktif) VALUES ('', '$ogrenciNo', '$ogrenciAdi', '$ogrenciSifre', '$ogrenciTelefon', '$ogrenciMail', '')";

    if ($conn->query($sql) === TRUE) {
        echo '<script>alert("Yeni kayıt başarıyla oluşturuldu")
        window.location.href="ogrenciGiris.php";</script>';
    } else {
        echo "Hata: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Öğrenci Kayıt Formu</title>
</head>
<body>
    <h2>Öğrenci Kayıt Formu</h2>

    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
        Numara: <br>
        <input type="text" name="ogrenciNo"><br>
        İsim: <br>
        <input type="text" name="ogrenciAdi"><br>
        Şifre: <br>
        <input type="password" name="ogrenciSifre"><br>
        Telefon: <br>
        <input type="text" name="ogrenciTelefon"><br>
        Mail: <br>
        <input type="text" name="ogrenciMail"><br><br>
        <input type="submit" name="ogrenciKaydet" value="Kaydet">
        <p>Zaten bir üyeliğiniz <a href="ogrencigiris.php">Buradan</a> giriş yapabilirsiniz!</p>
    </form>
</body>
</html>
