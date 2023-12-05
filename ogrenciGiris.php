<?php
include("baglanti.php"); // baglanti.php dosyasını dahil et

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $ogrenciNo = $_POST['ogrenciNo'];
        $sifre = $_POST['sifre'];

        $ogrenciNo = mysqli_real_escape_string($conn, $ogrenciNo);
        $sifre = mysqli_real_escape_string($conn, $sifre);

        $sql = "SELECT * FROM ogrenciler WHERE ogrenciNo = '$ogrenciNo' AND ogrenciSifre = '$sifre'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $_SESSION['ogrenciNo'] = $ogrenciNo;
            header("Location: ogrenciPanel.php");
            exit();
        } else {
            $hata = "Hatalı öğrenci numarası veya şifre.";
        }
       
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Öğrenci Girişi</title>
</head>
<body>
    <h2>Öğrenci Girişi</h2>

    <?php if(isset($hata)) { ?>
        <div><?php echo $hata; ?></div>
    <?php } ?>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
        <label for="ogrenciNo">Öğrenci Numarası:</label><br>
        <input type="text" id="ogrenciNo" name="ogrenciNo"><br>
        <label for="sifre">Şifre:</label><br>
        <input type="password" id="sifre" name="sifre"><br><br>
        <input type="submit" value="Giriş Yap">
        <p>Üyeliğiniz yok ise <a href="ogrenciKayit.php">Buradan</a> üye olabilirsiniz!</p>
    </form> <br>

    
</body>
</html>
