<?php
include("baglanti.php"); // baglanti.php dosyasını dahil et

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['gorevliGiris'])) {

    $gorevliNo = $_POST['gorevliNo'];
    $gorevliSifre = $_POST['gorevliSifre'];
    $gorevliTip = $_POST['gorevliTip'];

    $gorevliNo = mysqli_real_escape_string($conn, $gorevliNo);
    $gorevliSifre = mysqli_real_escape_string($conn, $gorevliSifre);

    $query = "";
  
    switch ($gorevliTip) {
        case 'idare':
            $query = "SELECT * FROM idare WHERE idareNumara = '$gorevliNo' AND idareSifre = '$gorevliSifre'";

            $result = $conn->query($query);
            if ($result->num_rows > 0) {
                // Giriş başarılı ise, yapılacak işlemler
                $_SESSION['gorevliNo'] = $gorevliNo;
                $_SESSION['gorevliTip'] = $gorevliTip;
        
                // Örnek bir yönlendirme
                header("Location: idarePanel.php");
                exit();
            } else {
                $hata = "Hatalı giriş bilgileri.";
            }

            break;

        case 'danisman':
            $query = "SELECT * FROM danisman WHERE danismanNumara = '$gorevliNo' AND danismanSifre = '$gorevliSifre'";

            $result = $conn->query($query);
            if ($result->num_rows > 0) {
                // Giriş başarılı ise, yapılacak işlemler
                $_SESSION['gorevliNo'] = $gorevliNo;
                $_SESSION['gorevliTip'] = $gorevliTip;
        
                // Örnek bir yönlendirme
                header("Location: danismanPanel.php");
                exit();
            } else {
                $hata = "Hatalı giriş bilgileri.";
            }

            break;

        case 'firma':
            $query = "SELECT * FROM firma WHERE firmaNumara = '$gorevliNo' AND firmaSifre = '$gorevliSifre'";

            $result = $conn->query($query);

            if ($result->num_rows > 0) {
                // Giriş başarılı ise, yapılacak işlemler
                $_SESSION['gorevliNo'] = $gorevliNo;
                $_SESSION['gorevliTip'] = $gorevliTip;

                // Örnek bir yönlendirme
                header("Location: firmaPanel.php");
                exit();
            } else {
                $hata = "Hatalı giriş bilgileri.";
            } 

            break;

        default:
            echo '<script>alert("Lütfen bir görev tipi seçiniz"); 
            window.location.href="gorevliKayit.php";</script>';
            // Hata durumunda yapılacak işlemler
            break;
    }
  
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Görevli Girişi</title>
</head>
<body>
    <h1>Görevli Girişi</h1>

    <?php if(isset($hata)) { ?>
        <div><?php echo $hata; ?></div>
    <?php } ?>

    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
        Görevli Tipi: <br>
        <input type="radio" name="gorevliTip" value="idare"> İdare
        <input type="radio" name="gorevliTip" value="danisman"> Danışman
        <input type="radio" name="gorevliTip" value="firma"> Firma<br>
        Görevli Numarası: <br>
        <input type="text" name="gorevliNo"><br>
        Şifre: <br>
        <input type="password" name="gorevliSifre"><br><br>
        <input type="submit" name="gorevliGiris" value="Giriş Yap">
        <p>Üyeliğiniz yok ise <a href="gorevliKayit.php">Buradan</a> üye olabilirsiniz!</p>
    </form>
</body>
</html>
