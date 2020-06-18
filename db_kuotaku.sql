-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: 16 Jun 2020 pada 00.30
-- Versi Server: 5.7.30-0ubuntu0.18.04.1
-- PHP Version: 7.4.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_kuotaku`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_catatan`
--

CREATE TABLE `data_catatan` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `size` varchar(255) NOT NULL,
  `harga` varchar(255) NOT NULL,
  `tanggal` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `data_catatan`
--

INSERT INTO `data_catatan` (`id`, `nama`, `size`, `harga`, `tanggal`) VALUES
(1, 'Zuma', '3', '15000', '2020-06-13'),
(7, 'Zuma', '3', '20000', '2020-06-14'),
(8, 'Zuma', '3', '25000', '2020-06-14'),
(9, 'Zuma', '3', '20000', '2020-06-14'),
(10, 'Zuma', '3', '20000', '2020-06-14'),
(11, 'Zuma', '3', '20000', '2020-06-15');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pesan`
--

CREATE TABLE `pesan` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `dari` varchar(255) NOT NULL,
  `chat` varchar(255) NOT NULL,
  `dattim` varchar(255) NOT NULL,
  `baca` enum('1','0') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pesan`
--

INSERT INTO `pesan` (`id`, `nama`, `dari`, `chat`, `dattim`, `baca`) VALUES
(1, 'All', 'Admin', 'Jangan Lupa Catat Apabila Beli Kuota', '', '0');

-- --------------------------------------------------------

--
-- Struktur dari tabel `search_enggine`
--

CREATE TABLE `search_enggine` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `keyword` varchar(255) NOT NULL,
  `kategori` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `search_enggine`
--

INSERT INTO `search_enggine` (`id`, `nama`, `keyword`, `kategori`) VALUES
(11, 'Zuma', '', 'histori');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `nomorhp` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `pengeluaran` varchar(225) NOT NULL,
  `totCat` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `nama`, `nomorhp`, `email`, `password`, `pengeluaran`, `totCat`) VALUES
(1, 'Zuma', '081225389903', 'rahmatwahyumaakbar@gmail.com', '21232f297a57a5a743894a0e4a801fc3', '120000', '6'),
(2, 'admin', '081234567890', 'zumamankzofficial@gmail.com', '21232f297a57a5a743894a0e4a801fc3', '0', '0');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `data_catatan`
--
ALTER TABLE `data_catatan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pesan`
--
ALTER TABLE `pesan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `search_enggine`
--
ALTER TABLE `search_enggine`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `data_catatan`
--
ALTER TABLE `data_catatan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `pesan`
--
ALTER TABLE `pesan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `search_enggine`
--
ALTER TABLE `search_enggine`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
