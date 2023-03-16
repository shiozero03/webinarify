-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 16, 2023 at 05:09 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `webinarify`
--

-- --------------------------------------------------------

--
-- Table structure for table `daftar_webinar`
--

CREATE TABLE `daftar_webinar` (
  `id_pendaftaran` int(11) NOT NULL,
  `id_peserta` int(11) NOT NULL,
  `id_event` int(11) NOT NULL,
  `nama` varchar(250) NOT NULL,
  `email` varchar(250) NOT NULL,
  `telepon` varchar(250) NOT NULL,
  `whatsapp` varchar(250) NOT NULL,
  `pendidikan` varchar(250) NOT NULL,
  `harga` varchar(250) NOT NULL,
  `status` varchar(100) NOT NULL,
  `bukti` varchar(250) DEFAULT NULL,
  `tanggal` datetime NOT NULL DEFAULT current_timestamp(),
  `sertifikat` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `daftar_webinar`
--

INSERT INTO `daftar_webinar` (`id_pendaftaran`, `id_peserta`, `id_event`, `nama`, `email`, `telepon`, `whatsapp`, `pendidikan`, `harga`, `status`, `bukti`, `tanggal`, `sertifikat`) VALUES
(2, 1, 3, 'Muhammad Rafli', 'mhdrafli.mr@gmail.com', '082275713049', '082275713049', 'Kuliah', '30000', 'Diproses', 'WhatsApp Image 2023-03-06 at 13.59.33.jpeg', '2022-05-22 00:00:00', ''),
(10, 2, 3, 'zero', 'zero@gmail.com', '0', '0', 'Kuliah', '30000', 'Success', 'WhatsApp Image 2023-03-06 at 13.59.33.jpeg', '2023-03-14 18:45:11', NULL),
(11, 0, 0, '', '', '', '', '', '', 'Belum Bayar', NULL, '2023-03-15 13:06:13', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `event_webinar`
--

CREATE TABLE `event_webinar` (
  `id_event` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `penyelenggara` varchar(255) NOT NULL,
  `judul_event` varchar(250) NOT NULL,
  `tanggal_event` date NOT NULL,
  `id_kategoriwebinar` int(11) NOT NULL,
  `gambar_event` varchar(250) NOT NULL,
  `deskripsi` varchar(1000) NOT NULL,
  `manfaat` varchar(1000) NOT NULL,
  `prasyarat` varchar(250) NOT NULL,
  `waktu` time NOT NULL,
  `akhir_pendaftaran` date NOT NULL,
  `pelaksanaan` varchar(250) NOT NULL,
  `harga` varchar(100) NOT NULL,
  `email` varchar(250) NOT NULL,
  `instagram` varchar(250) NOT NULL,
  `whatsapp` varchar(100) NOT NULL,
  `trending` int(11) NOT NULL DEFAULT 0,
  `publish` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `event_webinar`
--

INSERT INTO `event_webinar` (`id_event`, `id_user`, `penyelenggara`, `judul_event`, `tanggal_event`, `id_kategoriwebinar`, `gambar_event`, `deskripsi`, `manfaat`, `prasyarat`, `waktu`, `akhir_pendaftaran`, `pelaksanaan`, `harga`, `email`, `instagram`, `whatsapp`, `trending`, `publish`) VALUES
(1, 1, '', 'How to Attrack HR With Social Media Platform', '2022-04-17', 1, 'How to Attrack HR With Social Media Platform.png', '', '', '', '00:00:00', '0000-00-00', '', '', '', '', '', 1, 0),
(2, 1, '', 'Seminar Nasional <br>\"Wakaf Goes to Campus (WGTC)\" Implementasi Wakaf Pasca Pandemi', '2023-05-17', 4, 'wgtc.png', '', '', '', '00:00:00', '2023-03-30', '', '40000', '', '', '', 0, 0),
(3, 1, 'Visit', 'Strategi Jitu Pilih Jurusan \"IMPIANMU\"', '2023-04-10', 4, 'strategijitu.svg', '&quot;Duh jurusan yang sesuai denganku apa ya???&quot; ðŸ˜”&nbsp;</p><p>Pernahkah kamu merasa bingung dengan pilihan jurusan yang selalu menggangu pikiranmu?</p><p>ðŸ“¢ Panggilan resmi buat seluruh anak muda yang sering mengalami KEBINGUNGAN TERHADAP IMPIAN!!&nbsp;</p><p>Webinarify bersama dengan Kak Yustia, Psikolog Temanbaikk, akan ngebantu kamu untuk kupas tuntas cara jitu memilih jurusan &ldquo;IMPIANMU&rdquo; ðŸ—¨&nbsp;<br />Daftar sekarang juga!<br />DON&#39;T MISS IT!</p>', '<ul><li>Sertifikat gratis untuk peserta</li><li>Networking</li><li>Modul presentasi</li></ul>', 'Terbuka untuk umum', '07:00:00', '2023-03-30', 'Online', '30000', 'himapsikologi@upi.edu', '@inpianmu', '082275739468', 0, 0),
(4, 1, '', 'Trend of Technology and Engineering for Millenials', '2022-04-10', 1, 'Trend.png', '<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>', '<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>', 'Terbuka untuk umum', '16:17:00', '2022-03-20', 'Online', '30000', 'noname@gmail.com', '@noname', '0822573484618', 0, 0),
(5, 1, '', 'Optimalisasi Google dalam Pembelajaran dan Penelusuran Informasi', '2022-04-10', 1, 'Google.png', '<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>', '<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>', 'Terbuka untuk umum', '07:20:00', '2022-03-20', 'Online', '30000', 'noname@gmail.com', '@noname', '0696494424634', 0, 0),
(6, 1, '', 'Data Science for Humans Life', '2022-04-12', 1, 'Data science.png', '<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>', '<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>', 'Terbuka untuk umum', '07:21:00', '2022-03-25', 'Online', '30000', 'noname@gmail.com', '@noname', '05645484654845', 1, 0),
(7, 1, '', 'Smart Accounting Solutions', '2022-04-20', 1, 'Smart.png', '<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>', '<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>', 'Terbuka untuk umum', '07:23:00', '2022-03-28', 'Online', '30000', 'noname@gmail.com', '@noname', '86424804634848', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `kategori_webinar`
--

CREATE TABLE `kategori_webinar` (
  `id_kategoriwebinar` int(11) NOT NULL,
  `nama_kategoriwebinar` varchar(100) NOT NULL,
  `icon_kategoriwebinar` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `kategori_webinar`
--

INSERT INTO `kategori_webinar` (`id_kategoriwebinar`, `nama_kategoriwebinar`, `icon_kategoriwebinar`) VALUES
(1, 'Teknologi', 'teknologi.png'),
(2, 'Kesehatan', 'kesehatan.png'),
(3, 'Bisnis Digital', 'bisnisdigital.png'),
(4, 'Pendidikan ', 'pendidikan.png');

-- --------------------------------------------------------

--
-- Table structure for table `metode_pembayaran`
--

CREATE TABLE `metode_pembayaran` (
  `id_pembayaran` int(11) NOT NULL,
  `icon` varchar(255) NOT NULL,
  `jenis_pembayaran` varchar(255) NOT NULL,
  `nomor_pembayaran` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `metode_pembayaran`
--

INSERT INTO `metode_pembayaran` (`id_pembayaran`, `icon`, `jenis_pembayaran`, `nomor_pembayaran`) VALUES
(1, 'bni.png', 'BNI', 12345678),
(2, 'bca.png', 'BCA', 12345678),
(3, 'gopay.png', 'Gopay', 12345678),
(4, 'dana.png', 'Dana', 12345678),
(5, 'shopepay.png', 'Shopepay', 12345678);

-- --------------------------------------------------------

--
-- Table structure for table `testimoni_event`
--

CREATE TABLE `testimoni_event` (
  `id_testimoni` int(11) NOT NULL,
  `nama_pentestimoni` varchar(100) NOT NULL,
  `isi_testimoni` varchar(1000) NOT NULL,
  `bintang` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `testimoni_event`
--

INSERT INTO `testimoni_event` (`id_testimoni`, `nama_pentestimoni`, `isi_testimoni`, `bintang`) VALUES
(1, 'Retno Ariyanti N', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.', 4),
(3, 'Muhammad Azra', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.', 5),
(4, 'Rizky Merdika', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.', 4);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `foto_profil` varchar(255) DEFAULT NULL,
  `username` varchar(250) NOT NULL,
  `nama_user` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL,
  `telepon` varchar(250) NOT NULL,
  `level` varchar(10) NOT NULL,
  `email_user` varchar(250) NOT NULL,
  `pekerjaan_user` varchar(250) DEFAULT NULL,
  `jeniskelamin_user` varchar(250) DEFAULT NULL,
  `status_account` varchar(255) DEFAULT NULL,
  `whatsapp_admin` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `foto_profil`, `username`, `nama_user`, `password`, `telepon`, `level`, `email_user`, `pekerjaan_user`, `jeniskelamin_user`, `status_account`, `whatsapp_admin`) VALUES
(1, NULL, 'Admin', 'Muhammad Rafli', '$2y$10$QFVUmFYY8ev5UNNvLXXtq.eLzyUPbvsDpMTFmjuXuLtTKczHYfoqG', '082275713049', 'admin', 'admin@gmail.com', 'Mahasiswa', 'Laki - Laki', NULL, '6282275713049'),
(2, '20230316044157WhatsApp Image 2023-03-06 at 13.59.33.jpeg', 'shiozero', 'Zero', '$2y$10$QFVUmFYY8ev5UNNvLXXtq.eLzyUPbvsDpMTFmjuXuLtTKczHYfoqG', '082275713049', 'user', 'shiozero03@gmail.com', 'yesy', 'Laki - Laki', NULL, NULL),
(3, NULL, 'Shiota03', 'Muhammad Rafli', 'e821a8bfc2c786f275e5d5ea94d519a7', '082275713049', 'user', 'mhdrafli.mr@gmail.com', 'Mahasiswa', 'Laki - Laki', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `daftar_webinar`
--
ALTER TABLE `daftar_webinar`
  ADD PRIMARY KEY (`id_pendaftaran`);

--
-- Indexes for table `event_webinar`
--
ALTER TABLE `event_webinar`
  ADD PRIMARY KEY (`id_event`);

--
-- Indexes for table `kategori_webinar`
--
ALTER TABLE `kategori_webinar`
  ADD PRIMARY KEY (`id_kategoriwebinar`);

--
-- Indexes for table `metode_pembayaran`
--
ALTER TABLE `metode_pembayaran`
  ADD PRIMARY KEY (`id_pembayaran`);

--
-- Indexes for table `testimoni_event`
--
ALTER TABLE `testimoni_event`
  ADD PRIMARY KEY (`id_testimoni`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email_user` (`email_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `daftar_webinar`
--
ALTER TABLE `daftar_webinar`
  MODIFY `id_pendaftaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `event_webinar`
--
ALTER TABLE `event_webinar`
  MODIFY `id_event` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `kategori_webinar`
--
ALTER TABLE `kategori_webinar`
  MODIFY `id_kategoriwebinar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `metode_pembayaran`
--
ALTER TABLE `metode_pembayaran`
  MODIFY `id_pembayaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `testimoni_event`
--
ALTER TABLE `testimoni_event`
  MODIFY `id_testimoni` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
