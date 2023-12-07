-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 05 Ara 2023, 17:24:01
-- Sunucu sürümü: 10.4.28-MariaDB
-- PHP Sürümü: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `staj`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `danisman`
--

CREATE TABLE `danisman` (
  `danismanID` int(11) NOT NULL,
  `danismanIsim` varchar(255) NOT NULL,
  `danismanNumara` varchar(255) NOT NULL,
  `danismanSifre` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Tablo döküm verisi `danisman`
--

INSERT INTO `danisman` (`danismanID`, `danismanIsim`, `danismanNumara`, `danismanSifre`) VALUES
(1, 'hasan', '2113007044', '12345');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `defterler`
--

CREATE TABLE `defterler` (
  `defterID` int(11) NOT NULL,
  `ogrenciAdi` varchar(255) DEFAULT NULL,
  `ogrenciNo` int(11) DEFAULT NULL,
  `defterAktif` tinyint(1) DEFAULT NULL,
  `stajOnay` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Tablo döküm verisi `defterler`
--

INSERT INTO `defterler` (`defterID`, `ogrenciAdi`, `ogrenciNo`, `defterAktif`, `stajOnay`) VALUES
(1, 'Hasan TAŞ', 2113007044, 1, 0),
(2, 'asli', 2113007011, 1, 0),
(5, 'sude', 2113007001, 1, 0),
(6, 'zz', 112233, 1, 0),
(7, 'Irem', 12345, 1, 0);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `dosyalar`
--

CREATE TABLE `dosyalar` (
  `dosyaID` int(11) NOT NULL,
  `ogrenciNo` int(11) DEFAULT NULL,
  `defterID` int(11) DEFAULT NULL,
  `dosya` longblob DEFAULT NULL,
  `dosyaOnay` tinyint(1) DEFAULT 0,
  `firmaNumara` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Tablo döküm verisi `dosyalar`
--

INSERT INTO `dosyalar` (`dosyaID`, `ogrenciNo`, `defterID`, `dosya`, `dosyaOnay`, `firmaNumara`) VALUES
(10, 2113007011, 2, 0x75706c6f6164732f342e73746c, 0, '2113007044'),
(11, 2113007011, 2, 0x75706c6f6164732f372e73746c, 0, '2113007044'),
(12, 112233, 6, 0x75706c6f6164732f472d636f64652d746f2d77726974652d612d73706972616c2e6e6763, 0, '2113007044'),
(13, 112233, 6, 0x75706c6f6164732f392e73746c, 0, '2113007044'),
(14, 2113007044, 1, 0x75706c6f6164732f362e73746c, 1, '2113007044'),
(15, 2113007044, 1, 0x75706c6f6164732f472d636f64652d746f2d77726974652d612d73706972616c2e6e6763, 1, '2113007044'),
(16, 2113007044, 1, 0x75706c6f6164732f352e73746c, 1, '2113007044'),
(17, 2113007044, 1, 0x75706c6f6164732f372e73746c, 1, '2113007044'),
(18, 2113007044, 1, 0x75706c6f6164732f382e73746c, 1, '2113007044');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `firma`
--

CREATE TABLE `firma` (
  `firmaID` int(11) NOT NULL,
  `firmaIsim` varchar(255) NOT NULL,
  `firmaNumara` varchar(255) NOT NULL,
  `firmaSifre` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Tablo döküm verisi `firma`
--

INSERT INTO `firma` (`firmaID`, `firmaIsim`, `firmaNumara`, `firmaSifre`) VALUES
(1, 'hasan', '2113007044', '12345');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `idare`
--

CREATE TABLE `idare` (
  `idareID` int(11) NOT NULL,
  `idareIsim` varchar(255) NOT NULL,
  `idareNumara` varchar(255) NOT NULL,
  `idareSifre` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Tablo döküm verisi `idare`
--

INSERT INTO `idare` (`idareID`, `idareIsim`, `idareNumara`, `idareSifre`) VALUES
(1, 'hasan', '2113007044', '12345');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `ogrenciler`
--

CREATE TABLE `ogrenciler` (
  `ogrenciID` int(11) NOT NULL,
  `ogrenciNo` int(11) DEFAULT NULL,
  `ogrenciAdi` varchar(255) DEFAULT NULL,
  `ogrenciSifre` varchar(255) DEFAULT NULL,
  `ogrenciTelefon` varchar(15) DEFAULT NULL,
  `ogrenciEmail` varchar(255) DEFAULT NULL,
  `ogrenciAktif` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Tablo döküm verisi `ogrenciler`
--

INSERT INTO `ogrenciler` (`ogrenciID`, `ogrenciNo`, `ogrenciAdi`, `ogrenciSifre`, `ogrenciTelefon`, `ogrenciEmail`, `ogrenciAktif`) VALUES
(1, 2113007044, 'Hasan TAŞ', '12345', '5070778038', 'hasantas@ogr.bandirma.edu.tr', 1),
(2, 2113007011, 'asli', '12345', '5050856162', 'aslinurgercel@ogr.bandirma.edu.tr', 1),
(4, 2113007001, 'sude', '12345', '5415821102', 'sude@ogr.bandirma.edu.tr', 0),
(5, 112233, 'zz', '12345', '5050856162', '2113007044', 1),
(6, 12345, 'Irem', '12345', '5050846162', 'iremnurgercel@ogr.bandirma.edu.tr', 1);

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `danisman`
--
ALTER TABLE `danisman`
  ADD PRIMARY KEY (`danismanID`);

--
-- Tablo için indeksler `defterler`
--
ALTER TABLE `defterler`
  ADD PRIMARY KEY (`defterID`);

--
-- Tablo için indeksler `dosyalar`
--
ALTER TABLE `dosyalar`
  ADD PRIMARY KEY (`dosyaID`),
  ADD KEY `defterID` (`defterID`);

--
-- Tablo için indeksler `firma`
--
ALTER TABLE `firma`
  ADD PRIMARY KEY (`firmaID`);

--
-- Tablo için indeksler `idare`
--
ALTER TABLE `idare`
  ADD PRIMARY KEY (`idareID`);

--
-- Tablo için indeksler `ogrenciler`
--
ALTER TABLE `ogrenciler`
  ADD PRIMARY KEY (`ogrenciID`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `danisman`
--
ALTER TABLE `danisman`
  MODIFY `danismanID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Tablo için AUTO_INCREMENT değeri `defterler`
--
ALTER TABLE `defterler`
  MODIFY `defterID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Tablo için AUTO_INCREMENT değeri `dosyalar`
--
ALTER TABLE `dosyalar`
  MODIFY `dosyaID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- Tablo için AUTO_INCREMENT değeri `firma`
--
ALTER TABLE `firma`
  MODIFY `firmaID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Tablo için AUTO_INCREMENT değeri `idare`
--
ALTER TABLE `idare`
  MODIFY `idareID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Tablo için AUTO_INCREMENT değeri `ogrenciler`
--
ALTER TABLE `ogrenciler`
  MODIFY `ogrenciID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Dökümü yapılmış tablolar için kısıtlamalar
--

--
-- Tablo kısıtlamaları `dosyalar`
--
ALTER TABLE `dosyalar`
  ADD CONSTRAINT `dosyalar_ibfk_1` FOREIGN KEY (`defterID`) REFERENCES `defterler` (`defterID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
