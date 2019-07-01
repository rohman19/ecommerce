-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 04, 2019 at 08:00 PM
-- Server version: 10.1.36-MariaDB
-- PHP Version: 5.6.38

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `penjualan`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `username` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `password` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `nama_lengkap` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `email` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `no_telp` varchar(20) COLLATE latin1_general_ci NOT NULL,
  `level` varchar(20) COLLATE latin1_general_ci NOT NULL DEFAULT 'user',
  `blokir` enum('Y','N') COLLATE latin1_general_ci NOT NULL DEFAULT 'N',
  `foto` varchar(100) COLLATE latin1_general_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`username`, `password`, `nama_lengkap`, `email`, `no_telp`, `level`, `blokir`, `foto`) VALUES
('admin', '21232f297a57a5a743894a0e4a801fc3', 'Rohman', 'Rohman0105@bsi.ac.id', '089602484584', 'admin', 'N', '12.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `hubungi`
--

CREATE TABLE `hubungi` (
  `id_hubungi` int(5) NOT NULL,
  `id_kustomer` int(5) NOT NULL,
  `subjek` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `pesan` text COLLATE latin1_general_ci NOT NULL,
  `tanggal` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `hubungi`
--

INSERT INTO `hubungi` (`id_hubungi`, `id_kustomer`, `subjek`, `pesan`, `tanggal`) VALUES
(2, 9, '19', '<p>sesuai pesanan</p>', '2018-12-28'),
(3, 1, '1', '<p>bagus</p>', '2019-01-04');

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` int(5) NOT NULL,
  `nama_kategori` varchar(100) COLLATE latin1_general_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `nama_kategori`) VALUES
(1, 'Kursi'),
(2, 'Meja'),
(3, 'Lemari'),
(4, 'Tempat Tidur');

-- --------------------------------------------------------

--
-- Table structure for table `konfirmasi`
--

CREATE TABLE `konfirmasi` (
  `id_konfirmasi` int(11) NOT NULL,
  `id_kustomer` int(11) NOT NULL,
  `subjek` varchar(100) NOT NULL,
  `pesan` varchar(200) NOT NULL,
  `tanggal` date NOT NULL,
  `gambar` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `konfirmasi`
--

INSERT INTO `konfirmasi` (`id_konfirmasi`, `id_kustomer`, `subjek`, `pesan`, `tanggal`, `gambar`) VALUES
(0, 4, '3', '<p>aaaaaaaaa</p>', '2019-01-05', 'Untitled-1.jpg'),
(1, 4, '2', '<p>test</p>', '2019-01-05', 'Untitled-1.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `kota`
--

CREATE TABLE `kota` (
  `id_kota` int(3) NOT NULL,
  `nama_kota` varchar(100) NOT NULL,
  `ongkos_kirim` int(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kota`
--

INSERT INTO `kota` (`id_kota`, `nama_kota`, `ongkos_kirim`) VALUES
(1, 'Jakarta', 50000),
(2, 'Bogor', 50000),
(3, 'Tangerang', 50000),
(4, 'Tangerang Selatan', 50000),
(5, 'Depok', 50000);

-- --------------------------------------------------------

--
-- Table structure for table `kustomer`
--

CREATE TABLE `kustomer` (
  `id_kustomer` int(5) NOT NULL,
  `password` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `nama_lengkap` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `alamat` text COLLATE latin1_general_ci NOT NULL,
  `email` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `telpon` varchar(20) COLLATE latin1_general_ci NOT NULL,
  `id_kota` int(5) NOT NULL,
  `tanggal` date DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `kustomer`
--

INSERT INTO `kustomer` (`id_kustomer`, `password`, `nama_lengkap`, `alamat`, `email`, `telpon`, `id_kota`, `tanggal`) VALUES
(3, '827ccb0eea8a706c4c34a16891f84e7b', 'Jhony', 'BSD sektor 1.3', 'email@gmail.com', '123456', 4, '2018-12-28'),
(4, 'e10adc3949ba59abbe56e057f20f883e', 'Rojak', 'Rawa Buaya', 'rojak@gmail.com', '121323123', 1, '2018-12-30');

-- --------------------------------------------------------

--
-- Table structure for table `modul`
--

CREATE TABLE `modul` (
  `id_modul` int(5) NOT NULL,
  `static_content` text COLLATE latin1_general_ci NOT NULL,
  `gambar` varchar(100) COLLATE latin1_general_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `modul`
--

INSERT INTO `modul` (`id_modul`, `static_content`, `gambar`) VALUES
(1, '<h3><strong>Tentang Kami</strong></h3>\r\n<div class=\"WordSection1\">\r\n<p class=\"MsoListParagraph\" style=\"margin-left: 0cm; mso-add-space: auto; text-align: justify; text-indent: 36.0pt; line-height: 200%;\"><span lang=\"EN-ID\" style=\"font-size: 12.0pt; mso-bidi-font-size: 11.0pt; line-height: 200%; font-family: \'Times New Roman\',\'serif\'; mso-ansi-language: EN-ID;\">CV. Gemilang Lestari Jaya didirikan pada 05 Agustus 2005 berdasarkan akta pendirian notaris Mohamad Hasan Sulsi, SH. No.-3 berkedudukan di Villa Dago Tol Blok D2/46, Jl. Raya Ciater, Tangerang Selatan, Banten. Bergerak dalam bidang Contraktor-General Trading-Supplier dan dikelola oleh professional muda yang mempunyai komitmen dan kompetensi yang handal. Dalam perjalanannya, CV. Gemilang Lestari Jaya, selalu dan terus menerus berupaya melakukan improvisasi&nbsp;</span><span style=\"font-family: \'Times New Roman\', serif; font-size: 12pt;\">dan berbenah diri dengan semangat yang tinggi untuk mengambil peran yang lebih besar dalam menjawab tantangan jaman dan komitmen sebagai kelompok professional muda yang bertanggung jawab. Dengan professionalisme dan manajemen yang efektif diharapkan dapat memberikan pelayanan secara optima kepada mitra kerja.</span></p>\r\n</div>', 'cv gemilang.png'),
(2, '<p class=\"MsoListParagraphCxSpFirst\" style=\"margin-left: 0cm; mso-add-space: auto; text-align: justify; line-height: 200%;\"><strong style=\"mso-bidi-font-weight: normal;\"><span lang=\"EN-ID\" style=\"font-size: 12.0pt; mso-bidi-font-size: 11.0pt; line-height: 200%; font-family: \'Times New Roman\',\'serif\'; mso-ansi-language: EN-ID;\">VISI dan MISI.</span></strong></p>\r\n<p class=\"MsoListParagraphCxSpMiddle\" style=\"margin-left: 120.5pt; mso-add-space: auto; text-align: justify; text-indent: -120.5pt; line-height: 200%;\"><span lang=\"EN-ID\" style=\"font-size: 12.0pt; mso-bidi-font-size: 11.0pt; line-height: 200%; font-family: \'Times New Roman\',\'serif\'; mso-ansi-language: EN-ID;\">Visi Perusahaan<span style=\"mso-tab-count: 1;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span>: &rdquo;Melalui kemitraan dengan didasari professionalisme menciptakan sinergy bagi setiap karya-karya yang akan dihasilkan&rdquo;.</span></p>\r\n<p class=\"MsoListParagraphCxSpMiddle\" style=\"margin-left: 120.5pt; mso-add-space: auto; text-align: justify; text-indent: -120.5pt; line-height: 200%;\"><span lang=\"EN-ID\" style=\"font-size: 12.0pt; mso-bidi-font-size: 11.0pt; line-height: 200%; font-family: \'Times New Roman\',\'serif\'; mso-ansi-language: EN-ID;\">Misi Perushaaan<span style=\"mso-tab-count: 1;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span>: &ldquo;Memberikan pelayanan yang optimal dalam penyedian barang/jasa dengan mengutamakan kepuasan dan kualitas, dengan harapan optimalisasi produktivitas dan minimalisasi cost produksi bagi mitra kerja&rdquo;.</span></p>\r\n<p class=\"MsoListParagraphCxSpLast\" style=\"margin-left: 0cm; mso-add-space: auto; text-align: justify; line-height: 200%;\"><span lang=\"EN-ID\" style=\"font-size: 12.0pt; mso-bidi-font-size: 11.0pt; line-height: 200%; font-family: \'Times New Roman\',\'serif\'; mso-ansi-language: EN-ID;\">Didasari kemajuan ahli teknologi, sarana &amp; prasarana serta manajemen yang ada, diharapkan hasilnya akan memenuhi standar kualitas yang memuaskan. Pada akhirnya, CV. Gemilang Lestari Jaya sekali lagi ingin menegaskan komitmen luhurnya untuk ikut berperan dalam pengembangunan indonesia yang berbasis pada budaya dan kearifan masyarakat, sehingga kamipun bangga menjadi salah satu perusahaan yang mengedapankan idealisme keselarasan kerjasama serta menghasilkan kinerja yang berkualitas.</span></p>', 'cv gemilang.png'),
(3, '<p><strong>Hubungi Kami</strong></p>\r\n<p class=\"MsoNormal\">Hubungi Kami pada jam kerja. Hari Kerja Buka 08.00 - 16.00 (Senin-Jum\'at).</p>', 'cv gemilang.png'),
(4, '<h3 style=\"margin: 15.0pt 0cm 7.5pt 0cm;\"><strong><span style=\"font-size: 18pt; font-family: Arial, sans-serif; color: #333333;\">Cara Melakukan Pembelian</span></strong></h3>\r\n<ol style=\"box-sizing: border-box; font-variant-ligatures: normal; font-variant-caps: normal; orphans: 2; text-align: start; widows: 2; -webkit-text-stroke-width: 0px; text-decoration-style: initial; text-decoration-color: initial; word-spacing: 0px;\" start=\"1\" type=\"1\">\r\n<li class=\"MsoNormal\" style=\"color: #333333; mso-margin-top-alt: auto; mso-margin-bottom-alt: auto; mso-list: l0 level1 lfo1; tab-stops: list 36.0pt; box-sizing: border-box;\"><strong><span style=\"font-family: \'Arial\',\'sans-serif\';\">Tentukan produk yang anda beli.</span></strong></li>\r\n<li class=\"MsoNormal\" style=\"color: #333333; mso-margin-top-alt: auto; mso-margin-bottom-alt: auto; mso-list: l0 level1 lfo1; tab-stops: list 36.0pt; box-sizing: border-box;\"><strong><span style=\"font-family: \'Arial\',\'sans-serif\';\">Pilih produk dan tentukan qty yang ingin anda beli.</span></strong></li>\r\n<li class=\"MsoNormal\" style=\"color: #333333; mso-margin-top-alt: auto; mso-margin-bottom-alt: auto; mso-list: l0 level1 lfo1; tab-stops: list 36.0pt; box-sizing: border-box;\"><strong><span style=\"font-family: \'Arial\',\'sans-serif\';\">Login atau Buat Akun baru untuk melanjutkan pembelian.</span></strong></li>\r\n<li class=\"MsoNormal\" style=\"color: #333333; mso-margin-top-alt: auto; mso-margin-bottom-alt: auto; mso-list: l0 level1 lfo1; tab-stops: list 36.0pt; box-sizing: border-box;\"><strong><span style=\"font-family: \'Arial\',\'sans-serif\';\">Kemudian pastikan informasi data alamat anda sudah benar.</span></strong></li>\r\n<li class=\"MsoNormal\" style=\"color: #333333; mso-margin-top-alt: auto; mso-margin-bottom-alt: auto; mso-list: l0 level1 lfo1; tab-stops: list 36.0pt; box-sizing: border-box;\"><strong><span style=\"font-family: \'Arial\',\'sans-serif\';\">Lakukan Transaksi pembelian.</span></strong></li>\r\n<li class=\"MsoNormal\" style=\"color: #333333; mso-margin-top-alt: auto; mso-margin-bottom-alt: auto; mso-list: l0 level1 lfo1; tab-stops: list 36.0pt; box-sizing: border-box;\"><strong><span style=\"font-family: \'Arial\',\'sans-serif\';\">Setelah itu anda dapat melakukan pembayaran berdasarkan total nominal transaksi.</span></strong></li>\r\n<li class=\"MsoNormal\" style=\"color: #333333; mso-margin-top-alt: auto; mso-margin-bottom-alt: auto; mso-list: l0 level1 lfo1; tab-stops: list 36.0pt; box-sizing: border-box;\"><strong><span style=\"font-family: \'Arial\',\'sans-serif\';\">Konfirmasi pembayaran anda (lihat dibagian bawah).</span></strong></li>\r\n<li class=\"MsoNormal\" style=\"color: #333333; mso-margin-top-alt: auto; mso-margin-bottom-alt: auto; mso-list: l0 level1 lfo1; tab-stops: list 36.0pt; box-sizing: border-box;\"><strong><span style=\"font-family: \'Arial\',\'sans-serif\';\">Kami akan memproses pesanan anda jika dana telah kami terima.</span></strong></li>\r\n<li class=\"MsoNormal\" style=\"color: #333333; mso-margin-top-alt: auto; mso-margin-bottom-alt: auto; mso-list: l0 level1 lfo1; tab-stops: list 36.0pt; box-sizing: border-box;\"><strong><span style=\"font-family: \'Arial\',\'sans-serif\';\">Pengiriman sesuai alamat anda.</span></strong></li>\r\n<li class=\"MsoNormal\" style=\"color: #333333; mso-margin-top-alt: auto; mso-margin-bottom-alt: auto; mso-list: l0 level1 lfo1; tab-stops: list 36.0pt; box-sizing: border-box;\"><strong><span style=\"font-family: \'Arial\',\'sans-serif\';\">Pengiriman untuk wilayah Jabodetabek.</span></strong></li>\r\n</ol>\r\n<h3 style=\"box-sizing: border-box; font-variant-ligatures: normal; font-variant-caps: normal; orphans: 2; text-align: start; widows: 2; -webkit-text-stroke-width: 0px; text-decoration-style: initial; text-decoration-color: initial; word-spacing: 0px; margin: 15.0pt 0cm 7.5pt 0cm;\"><strong><span style=\"font-size: 18pt; font-family: Arial, sans-serif; color: #333333;\">Cara Melakukan Pembayaran :</span></strong></h3>\r\n<ol style=\"box-sizing: border-box; font-variant-ligatures: normal; font-variant-caps: normal; orphans: 2; text-align: start; widows: 2; -webkit-text-stroke-width: 0px; text-decoration-style: initial; text-decoration-color: initial; word-spacing: 0px;\" start=\"1\" type=\"1\">\r\n<li class=\"MsoNormal\" style=\"color: #333333; mso-margin-top-alt: auto; mso-margin-bottom-alt: auto; mso-list: l1 level1 lfo2; tab-stops: list 36.0pt; box-sizing: border-box;\"><strong><span style=\"box-sizing: border-box;\"><span style=\"box-sizing: border-box;\"><span style=\"font-family: \'Arial\',\'sans-serif\';\">Pembayaran dapat dilakukan dengan transfer ke No. rekening berikut :</span><br style=\"box-sizing: border-box;\" /> </span><span style=\"font-family: Arial, sans-serif;\">BRI&nbsp; :&nbsp;</span><span style=\"font-family: \'Arial\',\'sans-serif\';\"><span style=\"box-sizing: border-box;\"><span style=\"box-sizing: border-box;\">503.0292.22</span></span></span><span style=\"font-family: Arial, sans-serif;\">&nbsp;(Rohman)</span><br style=\"box-sizing: border-box;\" /> <span style=\"font-family: Arial, sans-serif;\">MANDIRI&nbsp;:&nbsp;</span><span style=\"font-family: \'Arial\',\'sans-serif\'; mso-bidi-font-weight: normal;\">155000-002-9394-06</span><span style=\"font-family: Arial, sans-serif;\"> (Rohmad Safi\'i)</span><span style=\"box-sizing: border-box;\"><span style=\"box-sizing: border-box;\">&nbsp;</span></span></span></strong></li>\r\n<li class=\"MsoNormal\" style=\"color: #333333; mso-margin-top-alt: auto; mso-margin-bottom-alt: auto; mso-list: l1 level1 lfo2; tab-stops: list 36.0pt; box-sizing: border-box;\"><strong><span style=\"font-family: \'Arial\',\'sans-serif\';\">Besaran nominal sesuai total transaksi yang tertera pada email transaksi.</span></strong></li>\r\n<li class=\"MsoNormal\" style=\"color: #333333; mso-margin-top-alt: auto; mso-margin-bottom-alt: auto; mso-list: l1 level1 lfo2; tab-stops: list 36.0pt; box-sizing: border-box;\"><strong><span style=\"font-family: \'Arial\',\'sans-serif\';\">Usahakan anda memberikan remark/berita mencantumkan ID transaksi pada saat anda melakukan transfer.</span></strong></li>\r\n</ol>\r\n<h3 style=\"box-sizing: border-box; font-variant-ligatures: normal; font-variant-caps: normal; orphans: 2; text-align: start; widows: 2; -webkit-text-stroke-width: 0px; text-decoration-style: initial; text-decoration-color: initial; word-spacing: 0px; margin: 15.0pt 0cm 7.5pt 0cm;\"><strong><span style=\"font-size: 18pt; font-family: Arial, sans-serif; color: #333333;\">Cara Melakukan Konfirmasi Pembayaran</span></strong></h3>\r\n<p style=\"box-sizing: border-box; font-variant-ligatures: normal; font-variant-caps: normal; orphans: 2; text-align: start; widows: 2; -webkit-text-stroke-width: 0px; text-decoration-style: initial; text-decoration-color: initial; word-spacing: 0px; margin: 0cm 0cm 7.5pt 0cm;\"><strong><span lang=\"IN\" style=\"font-size: 10.0pt; font-family: \'Arial\',\'sans-serif\'; color: #333333;\">Anda dapat melakukan konfirmasi pembayaran kepada kami, dalam 3 cara berikut ini :</span></strong></p>\r\n<ol style=\"box-sizing: border-box; font-variant-ligatures: normal; font-variant-caps: normal; orphans: 2; text-align: start; widows: 2; -webkit-text-stroke-width: 0px; text-decoration-style: initial; text-decoration-color: initial; word-spacing: 0px;\" start=\"1\" type=\"1\">\r\n<li class=\"MsoNormal\" style=\"color: #333333; mso-margin-top-alt: auto; mso-margin-bottom-alt: auto; mso-list: l2 level1 lfo3; tab-stops: list 36.0pt; box-sizing: border-box;\"><strong><span style=\"font-family: \'Arial\',\'sans-serif\';\">Konfirmasi melalui Customer Service Kami</span></strong></li>\r\n<li class=\"MsoNormal\" style=\"color: #333333; mso-margin-top-alt: auto; mso-margin-bottom-alt: auto; mso-list: l2 level1 lfo3; tab-stops: list 36.0pt; box-sizing: border-box;\"><strong><span style=\"font-family: \'Arial\',\'sans-serif\';\">Konfirmasi melalui WA/SMS/Telpon ke 089602484584</span></strong></li>\r\n</ol>\r\n<p class=\"MsoNormal\">&nbsp;</p>', 'cv gemilang.png');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id_orders` int(5) NOT NULL,
  `status_order` varchar(50) COLLATE latin1_general_ci NOT NULL DEFAULT 'Baru',
  `tgl_order` date NOT NULL,
  `jam_order` time NOT NULL,
  `id_kustomer` int(5) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id_orders`, `status_order`, `tgl_order`, `jam_order`, `id_kustomer`) VALUES
(1, 'Lunas', '2018-12-28', '19:56:41', 1),
(2, 'Belum Lunas', '2018-12-30', '22:49:11', 4),
(3, 'Belum Lunas', '2019-01-03', '19:33:14', 4),
(4, 'Baru', '2019-01-04', '09:34:16', 2);

-- --------------------------------------------------------

--
-- Table structure for table `orders_detail`
--

CREATE TABLE `orders_detail` (
  `id_orders` int(5) NOT NULL,
  `id_produk` int(5) NOT NULL,
  `jumlah` int(5) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `orders_detail`
--

INSERT INTO `orders_detail` (`id_orders`, `id_produk`, `jumlah`) VALUES
(1, 9, 1),
(2, 2, 1),
(3, 2, 1),
(4, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `orders_temp`
--

CREATE TABLE `orders_temp` (
  `id_orders_temp` int(5) NOT NULL,
  `id_produk` int(5) NOT NULL,
  `id_session` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `jumlah` int(5) NOT NULL,
  `tgl_order_temp` date NOT NULL,
  `jam_order_temp` time NOT NULL,
  `stok_temp` int(5) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `produk_id` int(5) NOT NULL,
  `id_kategori` int(5) NOT NULL,
  `nama_produk` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `deskripsi` text COLLATE latin1_general_ci NOT NULL,
  `harga` int(20) NOT NULL,
  `stok` int(5) NOT NULL,
  `berat` decimal(5,2) UNSIGNED NOT NULL DEFAULT '0.00',
  `tgl_masuk` date NOT NULL,
  `gambar` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `dibeli` int(5) NOT NULL DEFAULT '1',
  `diskon` int(5) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`produk_id`, `id_kategori`, `nama_produk`, `deskripsi`, `harga`, `stok`, `berat`, `tgl_masuk`, `gambar`, `dibeli`, `diskon`) VALUES
(1, 1, 'Kursi Kantor', '', 250000, 14, '1.00', '2018-11-21', 'download.jpg', 20, 0),
(2, 1, 'Kursi Kantor Elegan', '', 1200000, 8, '10.00', '2018-11-21', 'kursi kantor elegan.jpg', 10, 10),
(3, 1, 'Kursi Kantor Direktur ', 'Merk Fantoni Hitam', 2500000, 2, '10.00', '2018-11-21', 'kursi direktur fantoni hitam.jpg', 2, 5),
(4, 1, 'Kursi Kantor', '<p>Warna Biru</p>', 175000, 20, '1.00', '2018-11-21', 'kursi kantor.jpeg', 20, 0),
(5, 1, 'Kursi Makan', '<p>Merk Bugsy</p>', 200000, 10, '1.00', '2018-11-21', 'kursi makan bugsy.jpg', 10, 0),
(6, 1, 'Kursi Makan', '<p style=\"text-align: justify;\">Bahan Rotan</p>', 150000, 15, '1.00', '2018-11-21', 'kursi makan rotan.jpg', 15, 0),
(7, 2, 'Meja Kantor', '<p>Merk Lunar</p>', 500000, 4, '2.00', '2018-11-21', 'meja kantor lunar 1.jpg', 5, 0),
(8, 2, 'Meja Belajar Anak', '<p>Gambar Mickey Mouse</p>', 1200000, 2, '5.00', '2018-11-21', 'meja belajar anak mickey.jpg', 2, 0),
(9, 2, 'Lemari Pakaian 3 pintu', '<p>Bahan Kayu Jati</p>', 1500000, 2, '15.00', '2018-11-21', 'lemari pakaian jati 3 pintu ukir.jpg', 2, 0),
(10, 3, 'Lemari Pakaian Fax Corner', '<p>Modern</p>', 2500000, 2, '10.00', '2018-11-21', 'pax corner.jpg', 2, 0);

-- --------------------------------------------------------

--
-- Table structure for table `slider`
--

CREATE TABLE `slider` (
  `slider_id` int(11) NOT NULL,
  `slider_link_image` text,
  `slider_caption` text,
  `slider_desc` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `slider`
--

INSERT INTO `slider` (`slider_id`, `slider_link_image`, `slider_caption`, `slider_desc`) VALUES
(1, 'http://localhost/2017/jepara/login/gambar/slider1.jpg', 'Slider 1', 'image - 1'),
(2, 'http://localhost/2017/jepara/login/gambar/slider1.jpg', 'Slider 2', 'image - 2');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `hubungi`
--
ALTER TABLE `hubungi`
  ADD PRIMARY KEY (`id_hubungi`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `konfirmasi`
--
ALTER TABLE `konfirmasi`
  ADD PRIMARY KEY (`id_konfirmasi`);

--
-- Indexes for table `kota`
--
ALTER TABLE `kota`
  ADD PRIMARY KEY (`id_kota`);

--
-- Indexes for table `kustomer`
--
ALTER TABLE `kustomer`
  ADD PRIMARY KEY (`id_kustomer`);

--
-- Indexes for table `modul`
--
ALTER TABLE `modul`
  ADD PRIMARY KEY (`id_modul`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id_orders`);

--
-- Indexes for table `orders_temp`
--
ALTER TABLE `orders_temp`
  ADD PRIMARY KEY (`id_orders_temp`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`produk_id`);

--
-- Indexes for table `slider`
--
ALTER TABLE `slider`
  ADD PRIMARY KEY (`slider_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `hubungi`
--
ALTER TABLE `hubungi`
  MODIFY `id_hubungi` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_kategori` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `kota`
--
ALTER TABLE `kota`
  MODIFY `id_kota` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `kustomer`
--
ALTER TABLE `kustomer`
  MODIFY `id_kustomer` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `modul`
--
ALTER TABLE `modul`
  MODIFY `id_modul` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id_orders` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `orders_temp`
--
ALTER TABLE `orders_temp`
  MODIFY `id_orders_temp` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `produk_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `slider`
--
ALTER TABLE `slider`
  MODIFY `slider_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
