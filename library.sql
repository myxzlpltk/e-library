-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 05 Jul 2018 pada 03.05
-- Versi server: 10.1.30-MariaDB
-- Versi PHP: 7.2.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `library`
--
CREATE DATABASE IF NOT EXISTS `library` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `library`;

-- --------------------------------------------------------

--
-- Struktur dari tabel `buku`
--

CREATE TABLE `buku` (
  `id_buku` int(25) NOT NULL,
  `nama_buku` varchar(255) NOT NULL,
  `file_buku` text NOT NULL,
  `file_pdf` text NOT NULL,
  `deskripsi_buku` text NOT NULL,
  `tanggal_unggah` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id_user` int(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `buku`
--

INSERT INTO `buku` (`id_buku`, `nama_buku`, `file_buku`, `file_pdf`, `deskripsi_buku`, `tanggal_unggah`, `id_user`) VALUES
(1, 'Kajian Rencana Pengembangan Obyek WIsata Pantai Nglarap Kabupaten Tulungagung', 'buku_1529972583.jpg', 'buku_kajian_rencana_pengembangan_obyek_wisata_pantai_nglarap_kabupaten_tulungagung.pdf', 'Berisi kajian terhadap rencana pengembangan obyek wisata pantai Nglarap di Kabupaten Tulungagung', '2018-06-26 00:40:56', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `cari`
--

CREATE TABLE `cari` (
  `id_cari` int(50) NOT NULL,
  `keyword` text NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `cari`
--

INSERT INTO `cari` (`id_cari`, `keyword`, `time`) VALUES
(1, 'aku', '2018-06-27 04:53:09'),
(2, 'aku', '2018-06-27 04:53:22'),
(3, 'aku', '2018-06-27 04:53:23'),
(4, 'aku', '2018-06-27 04:53:26'),
(5, 'aku', '2018-06-27 04:53:28'),
(6, 'aku', '2018-06-27 04:53:31');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` int(15) NOT NULL,
  `nama_kategori` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `nama_kategori`) VALUES
(1, 'Kelitbangan');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori_buku`
--

CREATE TABLE `kategori_buku` (
  `id_kategori_buku` int(25) NOT NULL,
  `id_kategori` int(15) NOT NULL,
  `id_buku` int(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `kategori_buku`
--

INSERT INTO `kategori_buku` (`id_kategori_buku`, `id_kategori`, `id_buku`) VALUES
(2, 1, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `lampiran`
--

CREATE TABLE `lampiran` (
  `id_lampiran` int(25) NOT NULL,
  `id_buku` int(25) NOT NULL,
  `file_lampiran` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `lampiran`
--

INSERT INTO `lampiran` (`id_lampiran`, `id_buku`, `file_lampiran`) VALUES
(1, 1, 'slider_1525056832.jpg'),
(2, 1, 'slider_1525056843.jpg'),
(3, 1, 'slider_1525056852.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `log`
--

CREATE TABLE `log` (
  `id_log` int(15) NOT NULL,
  `id_user` int(25) NOT NULL,
  `aksi` varchar(255) NOT NULL,
  `judul` text NOT NULL,
  `keterangan` text NOT NULL,
  `btn` varchar(255) NOT NULL,
  `waktu` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `log`
--

INSERT INTO `log` (`id_log`, `id_user`, `aksi`, `judul`, `keterangan`, `btn`, `waktu`) VALUES
(1, 1, 'login', 'memulai sesi', '', '', '2018-06-25 09:26:38'),
(2, 1, 'login', 'memulai sesi', '', '', '2018-06-25 13:54:37'),
(3, 1, 'login', 'memulai sesi', '', '', '2018-06-26 00:38:23'),
(4, 1, 'buku', 'menambah buku', 'Sebuah buku telah berhasil di tambahkan', '/buku/lihat/1', '2018-06-26 00:40:58'),
(5, 1, 'login', 'memulai sesi', '', '', '2018-06-26 08:05:56'),
(6, 1, 'login', 'memulai sesi', '', '', '2018-06-26 23:49:36'),
(7, 1, 'login', 'memulai sesi', '', '', '2018-06-27 03:34:43'),
(8, 1, 'baca', 'membaca buku', 'Sebuah buku telah berhasil di baca', '/buku/lihat/', '2018-06-27 03:43:56'),
(9, 1, 'baca', 'membaca buku', 'Sebuah buku telah berhasil di baca', '/buku/lihat/', '2018-06-27 03:44:41'),
(10, 1, 'login', 'memulai sesi', '', '', '2018-06-27 03:48:26'),
(11, 1, 'baca', 'membaca buku', 'Sebuah buku telah berhasil di baca', '/buku/lihat/', '2018-06-27 03:48:31'),
(12, 1, 'baca', 'membaca buku', 'Sebuah buku telah berhasil di baca', '/buku/lihat/', '2018-06-27 03:55:21'),
(13, 1, 'baca', 'membaca buku', 'Sebuah buku telah berhasil di baca', '/buku/lihat/', '2018-06-27 03:55:31'),
(14, 1, 'baca', 'membaca buku', 'Sebuah buku telah berhasil di baca', '/buku/lihat/', '2018-06-27 03:55:41'),
(15, 1, 'baca', 'membaca buku', 'Sebuah buku telah berhasil di baca', '/buku/lihat/', '2018-06-27 03:57:36'),
(16, 1, 'baca', 'membaca buku', 'Sebuah buku telah berhasil di baca', '/buku/lihat/', '2018-06-27 03:58:02'),
(17, 1, 'baca', 'membaca buku', 'Sebuah buku telah berhasil di baca', '/buku/lihat/', '2018-06-27 03:58:11'),
(18, 1, 'baca', 'membaca buku', 'Sebuah buku telah berhasil di baca', '/buku/lihat/', '2018-06-27 03:58:47'),
(19, 1, 'baca', 'membaca buku', 'Sebuah buku telah berhasil di baca', '/buku/lihat/', '2018-06-27 04:07:38'),
(20, 1, 'baca', 'membaca buku', 'Sebuah buku telah berhasil di baca', '/buku/lihat/', '2018-06-27 04:07:51'),
(21, 1, 'baca', 'membaca buku', 'Sebuah buku telah berhasil di baca', '/buku/lihat/1', '2018-06-27 04:08:10'),
(22, 1, 'baca', 'membaca buku', 'Sebuah buku telah berhasil di baca', '/buku/lihat/1', '2018-06-27 04:08:17'),
(23, 1, 'login', 'memulai sesi', '', '', '2018-06-27 08:32:12'),
(24, 1, 'login', 'memulai sesi', '', '', '2018-06-27 12:18:13'),
(25, 1, 'login', 'memulai sesi', '', '', '2018-06-27 18:12:02'),
(26, 1, 'kategori', 'menambah kategori', 'Kategori Majalah telah berhasil di tambahkan', '/kategori/lihat/1', '2018-06-27 18:16:47'),
(27, 1, 'buku', 'mengedit buku', 'Sebuah buku telah berhasil di diedit', '/buku/lihat/1', '2018-06-27 18:17:10');

-- --------------------------------------------------------

--
-- Struktur dari tabel `slider`
--

CREATE TABLE `slider` (
  `id_slider` int(10) NOT NULL,
  `file_slider` varchar(255) NOT NULL,
  `tipe_slider` varchar(25) NOT NULL,
  `urutan_slider` varchar(25) DEFAULT NULL,
  `tanggal_slider` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `slider`
--

INSERT INTO `slider` (`id_slider`, `file_slider`, `tipe_slider`, `urutan_slider`, `tanggal_slider`) VALUES
(5, 'slider_1529920804.jpg', 'image', '3', '2018-06-25 10:00:04'),
(8, 'slider_1529923499.jpg', 'image', '4', '2018-06-25 10:45:00'),
(9, 'slider_1529923518.jpg', 'image', '5', '2018-06-25 10:45:18'),
(12, 'https://www.youtube.com/watch?v=yNeI5NH-R7c&enablejsapi=1', 'video', '0', '2018-06-26 08:11:59');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id_user` int(25) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `rule` varchar(255) NOT NULL,
  `nama_user` text NOT NULL,
  `email` varchar(255) NOT NULL,
  `verifikasi_email` varchar(25) DEFAULT NULL,
  `tanggal_gabung` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id_user`, `username`, `password`, `rule`, `nama_user`, `email`, `verifikasi_email`, `tanggal_gabung`) VALUES
(1, 'admin', '$2y$10$oZbedULR4J3N.oN.EbEwwOGTYzix7xPMAUID6RiLbPVTSoFeVUkha', 'admin', 'Bappeda', 'noreplybappedatulungagung@gmail.com', '1', '2018-03-31 17:00:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `verifikasi`
--

CREATE TABLE `verifikasi` (
  `id_verifikasi` int(25) NOT NULL,
  `id_user` int(25) NOT NULL,
  `code` varchar(255) NOT NULL,
  `type` varchar(25) NOT NULL,
  `expired` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status_verif` varchar(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `buku`
--
ALTER TABLE `buku`
  ADD PRIMARY KEY (`id_buku`),
  ADD UNIQUE KEY `nama_buku` (`nama_buku`),
  ADD KEY `id_user` (`id_user`);

--
-- Indeks untuk tabel `cari`
--
ALTER TABLE `cari`
  ADD PRIMARY KEY (`id_cari`);

--
-- Indeks untuk tabel `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`),
  ADD UNIQUE KEY `nama_kategori` (`nama_kategori`);

--
-- Indeks untuk tabel `kategori_buku`
--
ALTER TABLE `kategori_buku`
  ADD PRIMARY KEY (`id_kategori_buku`),
  ADD KEY `id_buku` (`id_buku`),
  ADD KEY `id_kategori` (`id_kategori`);

--
-- Indeks untuk tabel `lampiran`
--
ALTER TABLE `lampiran`
  ADD PRIMARY KEY (`id_lampiran`);

--
-- Indeks untuk tabel `log`
--
ALTER TABLE `log`
  ADD PRIMARY KEY (`id_log`),
  ADD KEY `id_user` (`id_user`);

--
-- Indeks untuk tabel `slider`
--
ALTER TABLE `slider`
  ADD PRIMARY KEY (`id_slider`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `username` (`username`,`email`);

--
-- Indeks untuk tabel `verifikasi`
--
ALTER TABLE `verifikasi`
  ADD PRIMARY KEY (`id_verifikasi`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `buku`
--
ALTER TABLE `buku`
  MODIFY `id_buku` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `cari`
--
ALTER TABLE `cari`
  MODIFY `id_cari` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_kategori` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `kategori_buku`
--
ALTER TABLE `kategori_buku`
  MODIFY `id_kategori_buku` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `lampiran`
--
ALTER TABLE `lampiran`
  MODIFY `id_lampiran` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `log`
--
ALTER TABLE `log`
  MODIFY `id_log` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT untuk tabel `slider`
--
ALTER TABLE `slider`
  MODIFY `id_slider` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `verifikasi`
--
ALTER TABLE `verifikasi`
  MODIFY `id_verifikasi` int(25) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
