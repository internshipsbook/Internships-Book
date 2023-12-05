<?php
include("baglanti.php"); // baglanti.php dosyasını dahil et

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['gorevliKaydet'])) {

    $gorevliTip = $_POST['gorevliTip'];
    $gorevliIsim = $_POST['gorevliIsim'];
    $gorevliNumara = $_POST['gorevliNumara'];
    $gorevliSifre = $_POST['gorevliSifre'];

    $gorevliIsim = mysqli_real_escape_string($conn, $gorevliIsim);
    $gorevliNumara = mysqli_real_escape_string($conn, $gorevliNumara);
    $gorevliSifre = mysqli_real_escape_string($conn, $gorevliSifre);

    switch ($gorevliTip) {
        case 'idare':
            $sql = "INSERT INTO idare (idareID, idareIsim, idareNumara, idareSifre) VALUES ('', '$gorevliIsim', '$gorevliNumara', '$gorevliSifre')";
            break;
        case 'danisman':
            $sql = "INSERT INTO danisman (danismanID, danismanIsim, danismanNumara, danismanSifre) VALUES ('', '$gorevliIsim', '$gorevliNumara', '$gorevliSifre')";
            break;
        case 'firma':
            $sql = "INSERT INTO firma (firmaID, firmaIsim, firmaNumara, firmaSifre) VALUES ('', '$gorevliIsim', '$gorevliNumara', '$gorevliSifre')";
            break;
        default:
            echo '<script>alert("Lütfen bir görev tipi seçiniz"); 
            window.location.href="gorevliKayit.php";</script>';
            // Hata durumunda yapılacak işlemler
            break;
    }

    if ($conn->query($sql) === TRUE) {
        echo '<script>alert("Yeni kayıt başarıyla oluşturuldu");</script>
        window.location.href="gorevliGiris.php";</script>';
    } else {
        echo "Hata: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Görevli Kayıt Formu</title>
</head>
<body>
    <h2>Görevli Kayıt Formu</h2>

    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
        Görevli Tipi: <br>
        <input type="radio" name="gorevliTip" value="idare"> İdare
        <input type="radio" name="gorevliTip" value="danisman"> Danışman
        <input type="radio" name="gorevliTip" value="firma"> Firma<br>
        İsim: <br>
        <input type="text" name="gorevliIsim"><br>
        Numara: <br>
        <input type="text" name="gorevliNumara"><br>
        Şifre: <br>
        <input type="password" name="gorevliSifre"><br><br>
        <input type="submit" name="gorevliKaydet" value="Kaydet">
        <p>Zaten bir üyeliğiniz <a href="gorevliGiris.php">Buradan</a> giriş yapabilirsiniz!</p>
    </form>
</body>
</html>
