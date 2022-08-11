-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 19 Feb 2022 pada 06.18
-- Versi server: 10.4.17-MariaDB
-- Versi PHP: 7.4.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_sarana_mandiri`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_admin`
--

CREATE TABLE `t_admin` (
  `id_admin` int(20) NOT NULL,
  `nama_admin` int(255) NOT NULL,
  `no_telp` int(20) NOT NULL,
  `username` int(50) NOT NULL,
  `password` int(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_harga`
--

CREATE TABLE `t_harga` (
  `id_harga` int(20) NOT NULL,
  `paket` varchar(20) NOT NULL,
  `kota_asal` varchar(255) NOT NULL,
  `kota_tujuan` varchar(255) NOT NULL,
  `perkiraan_waktu` varchar(20) NOT NULL,
  `cara_kirim` varchar(255) NOT NULL,
  `harga` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `t_harga`
--

INSERT INTO `t_harga` (`id_harga`, `paket`, `kota_asal`, `kota_tujuan`, `perkiraan_waktu`, `cara_kirim`, `harga`) VALUES
(7, 'A', 'Bekasi', 'Jakarta', '1hari', 'Driving', 200000),
(8, 'B', 'Bekasi', 'Depok', '1hari', 'Driving', 300000),
(9, 'C', 'Bekasi', 'Bogor', '1hari', 'Driving', 400000),
(10, 'D', 'Bekasi', 'Tangerang', '1hari', 'Driving', 500000),
(11, 'E', 'Bekasi', 'Semarang', '1-2 hari', 'Driving', 1200000),
(12, 'F', 'Bekasi', 'Jakarta', '1hari', 'Towing', 400000),
(14, 'G', 'Jakarta', 'Tangerang', '1hari', 'Driving', 700000),
(15, 'H', 'Jakarta', 'Bandung', '1hari', 'Towing', 700000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_pembayaran`
--

CREATE TABLE `t_pembayaran` (
  `id_pembayaran` int(11) NOT NULL,
  `tgl_pembayaran` date NOT NULL DEFAULT current_timestamp(),
  `tgl_pengiriman` date NOT NULL,
  `bukti_pembayaran` varchar(255) NOT NULL,
  `status_pembayaran` varchar(50) NOT NULL,
  `id_pemesanan` int(20) NOT NULL,
  `id_user` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `t_pembayaran`
--

INSERT INTO `t_pembayaran` (`id_pembayaran`, `tgl_pembayaran`, `tgl_pengiriman`, `bukti_pembayaran`, `status_pembayaran`, `id_pemesanan`, `id_user`) VALUES
(82, '2022-02-15', '2022-01-01', '1502221644899963internet-clip-art-world-wide-web-2158f353649b348975c8e59d07507fe5.png', 'Belum terkonfirmasi', 67, 16),
(83, '2022-02-17', '2022-01-01', '170222164506827317-172470_user-clipart-of-computers-desktop-and-computer-latest-computer-clip-art.png', 'Belum terkonfirmasi', 66, 14);

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_pemesanan`
--

CREATE TABLE `t_pemesanan` (
  `id_pemesanan` int(50) NOT NULL,
  `no_pemesanan` varchar(50) NOT NULL,
  `nama_pengirim` varchar(255) NOT NULL,
  `nama_penerima` varchar(255) NOT NULL,
  `alamat_pengirim` varchar(255) NOT NULL,
  `alamat_penerima` varchar(255) NOT NULL,
  `telp_pengirim` varchar(20) NOT NULL,
  `telp_penerima` varchar(20) NOT NULL,
  `no_plat` varchar(20) NOT NULL,
  `jenis_mobil` varchar(50) NOT NULL,
  `nomor_mesin` varchar(50) NOT NULL,
  `tgl_pemesanan` date NOT NULL,
  `id_harga` int(20) NOT NULL,
  `id_user` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `t_pemesanan`
--

INSERT INTO `t_pemesanan` (`id_pemesanan`, `no_pemesanan`, `nama_pengirim`, `nama_penerima`, `alamat_pengirim`, `alamat_penerima`, `telp_pengirim`, `telp_penerima`, `no_plat`, `jenis_mobil`, `nomor_mesin`, `tgl_pemesanan`, `id_harga`, `id_user`) VALUES
(66, 'SHM-220214112215', 'Septian', 'Kamu', 'Jl. sisi kanan sebelah kiri no 10', 'Jl. sisi kanan sebelah kiri no 20', '0832323213', '0812121213', 'B 123 AB', 'Pajero', '432434', '2022-02-14', 9, 14),
(67, 'SHM-220215045449', 'Lala', 'Hadi', 'Jl. sisi kanan sebelah kiri no 15', 'Jl. jalan jalan no.2', '0821212121', '03213213213', 'B 123 AB', 'Pajero', '435423', '2022-02-15', 8, 16);

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_transaksi`
--

CREATE TABLE `t_transaksi` (
  `id_transaksi` int(11) NOT NULL,
  `bukti_invoice` varchar(255) NOT NULL,
  `bukti_kurir` varchar(255) NOT NULL,
  `surat_jalan` varchar(255) NOT NULL,
  `id_pembayaran` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `t_transaksi`
--

INSERT INTO `t_transaksi` (`id_transaksi`, `bukti_invoice`, `bukti_kurir`, `surat_jalan`, `id_pembayaran`) VALUES
(14, '170222164507314117-172470_user-clipart-of-computers-desktop-and-computer-latest-computer-clip-art.png', '1702221645073141488-4881151_marco-parental-control-router-icon-modem-clipart-black.png', '1702221645073141images.png', 83);

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_user`
--

CREATE TABLE `t_user` (
  `id_user` int(11) NOT NULL,
  `nama_user` varchar(255) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(60) NOT NULL,
  `no_telp` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `t_user`
--

INSERT INTO `t_user` (`id_user`, `nama_user`, `username`, `password`, `no_telp`) VALUES
(14, 'septian', 'user1', '$2y$10$98y9bOvWaXO4onc136/Lie10LcpBuA8bZVNDUtYrbnNvXKZ22ojbW', '021321321321'),
(16, 'user10', 'user10', '$2y$10$/YSuXzuGRVzE7.ReaP9IQOW.s75AJ2fHIOUyOZngDuO3a8YNgNco.', '0822222222'),
(17, 'user123', 'user123', '$2y$10$qj3KnnfMGA8EMzDyogGHyu5rm99syD0iPBH7GjEGMSEzRMwkcOeba', '083213213123'),
(19, 'septian', 'user100', '$2y$10$08kiHI7zpr37FmAUQKdv2.qiMcGiwevcdAdgKERzEkCJgVJJNc6nm', '082313213');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `t_admin`
--
ALTER TABLE `t_admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indeks untuk tabel `t_harga`
--
ALTER TABLE `t_harga`
  ADD PRIMARY KEY (`id_harga`);

--
-- Indeks untuk tabel `t_pembayaran`
--
ALTER TABLE `t_pembayaran`
  ADD PRIMARY KEY (`id_pembayaran`),
  ADD KEY `id_pemesanan` (`id_pemesanan`);

--
-- Indeks untuk tabel `t_pemesanan`
--
ALTER TABLE `t_pemesanan`
  ADD PRIMARY KEY (`id_pemesanan`),
  ADD KEY `id_harga` (`id_harga`);

--
-- Indeks untuk tabel `t_transaksi`
--
ALTER TABLE `t_transaksi`
  ADD PRIMARY KEY (`id_transaksi`),
  ADD KEY `id_pembayaran` (`id_pembayaran`);

--
-- Indeks untuk tabel `t_user`
--
ALTER TABLE `t_user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `t_admin`
--
ALTER TABLE `t_admin`
  MODIFY `id_admin` int(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `t_harga`
--
ALTER TABLE `t_harga`
  MODIFY `id_harga` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT untuk tabel `t_pembayaran`
--
ALTER TABLE `t_pembayaran`
  MODIFY `id_pembayaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;

--
-- AUTO_INCREMENT untuk tabel `t_pemesanan`
--
ALTER TABLE `t_pemesanan`
  MODIFY `id_pemesanan` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT untuk tabel `t_transaksi`
--
ALTER TABLE `t_transaksi`
  MODIFY `id_transaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT untuk tabel `t_user`
--
ALTER TABLE `t_user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `t_pembayaran`
--
ALTER TABLE `t_pembayaran`
  ADD CONSTRAINT `t_pembayaran_ibfk_2` FOREIGN KEY (`id_pemesanan`) REFERENCES `t_pemesanan` (`id_pemesanan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `t_pemesanan`
--
ALTER TABLE `t_pemesanan`
  ADD CONSTRAINT `t_pemesanan_ibfk_1` FOREIGN KEY (`id_harga`) REFERENCES `t_harga` (`id_harga`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `t_transaksi`
--
ALTER TABLE `t_transaksi`
  ADD CONSTRAINT `t_transaksi_ibfk_1` FOREIGN KEY (`id_pembayaran`) REFERENCES `t_pembayaran` (`id_pembayaran`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
