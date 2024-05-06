-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 30 Nov 2023 pada 13.40
-- Versi server: 10.4.24-MariaDB
-- Versi PHP: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `perpustakaan`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `buku`
--

CREATE TABLE `buku` (
  `id_buku` int(11) NOT NULL,
  `judul` varchar(100) NOT NULL,
  `pengarang` varchar(50) NOT NULL,
  `penerbit` varchar(50) NOT NULL,
  `tahun` int(11) NOT NULL,
  `kategori` varchar(20) NOT NULL,
  `stok` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `buku`
--

INSERT INTO `buku` (`id_buku`, `judul`, `pengarang`, `penerbit`, `tahun`, `kategori`, `stok`) VALUES
(1, 'Belajar SQL dengan Mudah', 'Andi Rahmat', 'Gramedia', 2021, 'Komputer', 9),
(2, 'Pemrograman Python untuk Pemula', 'Budi Santoso', 'Erlangga', 2020, 'Komputer', 16),
(3, 'Struktur Data dan Algoritma', 'Cindy Lestari', 'Andi', 2019, 'Komputer', 12),
(4, 'Filsafat Ilmu', 'Dedi Kurniawan', 'Rajawali', 2018, 'Filsafat', 9),
(5, 'Psikologi Sosial', 'Eka Fitriani', 'Salemba', 2017, 'Psikologi', 8);

-- --------------------------------------------------------

--
-- Struktur dari tabel `kehadiran`
--

CREATE TABLE `kehadiran` (
  `no` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `jabatan` varchar(50) NOT NULL,
  `shift` varchar(10) NOT NULL,
  `hadir` tinyint(1) NOT NULL,
  `tanggal` date NOT NULL,
  `id_petugas` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `kehadiran`
--

INSERT INTO `kehadiran` (`no`, `nama`, `jabatan`, `shift`, `hadir`, `tanggal`, `id_petugas`) VALUES
(61, 'Kiki Ramadhan', 'Kepala Perpustakaan', 'Pagi', 1, '2023-11-28', 1),
(62, 'Lia Wulandari', 'Staf Peminjaman', 'Pagi', 0, '2023-11-28', 2),
(63, 'Mira Kusuma', 'Staf Pengembalian', 'Pagi', 0, '2023-11-28', 3),
(64, 'Nana Suryana', 'Staf Peminjaman', 'Siang', 0, '2023-11-28', 4),
(65, 'Oki Prasetyo', 'Staf Pengembalian', 'Siang', 0, '2023-11-28', 5);

-- --------------------------------------------------------

--
-- Struktur dari tabel `peminjam_buku`
--

CREATE TABLE `peminjam_buku` (
  `id_peminjam` int(11) NOT NULL,
  `judul` varchar(100) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `nim` varchar(10) NOT NULL,
  `jurusan` varchar(50) NOT NULL,
  `tanggal_pinjam` date NOT NULL,
  `tanggal_kembali` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengembalian_buku`
--

CREATE TABLE `pengembalian_buku` (
  `id_peminjam` int(11) NOT NULL,
  `judul` varchar(100) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `nim` varchar(10) NOT NULL,
  `jurusan` varchar(50) NOT NULL,
  `tanggal_pinjam` date NOT NULL,
  `tanggal_kembali` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pengembalian_buku`
--

INSERT INTO `pengembalian_buku` (`id_peminjam`, `judul`, `nama`, `nim`, `jurusan`, `tanggal_pinjam`, `tanggal_kembali`) VALUES
(1, 'Belajar SQL dengan Mudah', 'Akbar', '2210501006', 'D3 Sistem Infomasi', '2023-11-28', '2023-12-05'),
(2, 'Belajar SQL dengan Mudah', 'Akbar', '2210501006', 'D3 Sistem Infomasi', '2023-11-28', '2023-12-05');

-- --------------------------------------------------------

--
-- Struktur dari tabel `petugas`
--

CREATE TABLE `petugas` (
  `id_petugas` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `jabatan` varchar(20) NOT NULL,
  `shift` varchar(10) NOT NULL,
  `email` varchar(50) NOT NULL,
  `no_hp` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `petugas`
--

INSERT INTO `petugas` (`id_petugas`, `nama`, `jabatan`, `shift`, `email`, `no_hp`) VALUES
(1, 'Kiki Ramadhan', 'Kepala Perpustakaan', 'Pagi', 'kiki@gmail.com', '086789012345'),
(2, 'Lia Wulandari', 'Staf Peminjaman', 'Pagi', 'lia@yahoo.com', '087890123456'),
(3, 'Mira Kusuma', 'Staf Pengembalian', 'Pagi', 'mira@hotmail.com', '088901234567'),
(4, 'Nana Suryana', 'Staf Peminjaman', 'Siang', 'nana@outlook.com', '089012345678'),
(5, 'Oki Prasetyo', 'Staf Pengembalian', 'Siang', 'oki@gmail.com', '090123456789');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `buku`
--
ALTER TABLE `buku`
  ADD PRIMARY KEY (`id_buku`);

--
-- Indeks untuk tabel `kehadiran`
--
ALTER TABLE `kehadiran`
  ADD PRIMARY KEY (`no`),
  ADD KEY `id_petugas` (`id_petugas`);

--
-- Indeks untuk tabel `peminjam_buku`
--
ALTER TABLE `peminjam_buku`
  ADD PRIMARY KEY (`id_peminjam`);

--
-- Indeks untuk tabel `pengembalian_buku`
--
ALTER TABLE `pengembalian_buku`
  ADD PRIMARY KEY (`id_peminjam`);

--
-- Indeks untuk tabel `petugas`
--
ALTER TABLE `petugas`
  ADD PRIMARY KEY (`id_petugas`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `kehadiran`
--
ALTER TABLE `kehadiran`
  MODIFY `no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT untuk tabel `peminjam_buku`
--
ALTER TABLE `peminjam_buku`
  MODIFY `id_peminjam` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `pengembalian_buku`
--
ALTER TABLE `pengembalian_buku`
  MODIFY `id_peminjam` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `kehadiran`
--
ALTER TABLE `kehadiran`
  ADD CONSTRAINT `kehadiran_ibfk_1` FOREIGN KEY (`id_petugas`) REFERENCES `petugas` (`id_petugas`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
