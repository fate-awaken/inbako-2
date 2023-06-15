-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 25 Mar 2023 pada 18.52
-- Versi server: 10.4.27-MariaDB
-- Versi PHP: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `inbako`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin`
--

CREATE TABLE `admin` (
  `id` int(100) NOT NULL,
  `username` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `password` varchar(100) NOT NULL,
  `role_id` int(2) NOT NULL,
  `date_created` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `admin`
--

INSERT INTO `admin` (`id`, `username`, `email`, `password`, `role_id`, `date_created`) VALUES
(5, 'admin', 'admin@gmail.com', '$2y$10$J2xbBrrb93ZNGG2UtrCcRefBxivia71.12CNkgwTPojOAra3g27Ja', 1, 1679751969),
(6, 'radit', 'radit@gmail.com', '$2y$10$zkG6VIo2I4fUDS9lm7zIr.nrVlxcdSyUQZCbQtVxaFIrTtYKaEb1.', 1, 1679752046),
(7, 'sancho', 'sancho@gmail.com', '$2y$10$FgT2vyPdDp.tDVsbqJT0Y.RYWs5/Wj3jP2qmsYd7YcwP8KrTLclm6', 1, 1679752088),
(8, 'asd', 'asd@gmail.com', '$2y$10$aL3FgLH8moW/j.mvpwyR3exC5wY1Qnm9u2qrHE1Zyo/Rqy3OCupJC', 1, 1679754726),
(9, 'asddsa', 'dsa@gmail.com', '$2y$10$K01AwFLjQulFDqcHX5HDnOHXiYyMlNtUkfhh42gFs45v5PZ18Xzu2', 1, 1679756717),
(10, 'admina', 'alejandro@gmail.com', '$2y$10$0CUvHFmnwULveUgk8kM8p.NQaortluXk5UMEvAH.GWtinNkRahWKG', 1, 1679760674);

-- --------------------------------------------------------

--
-- Struktur dari tabel `warga`
--

CREATE TABLE `warga` (
  `nik` int(20) NOT NULL,
  `nama` varchar(128) NOT NULL,
  `kota` int(128) NOT NULL,
  `kecamatan` varchar(50) NOT NULL,
  `kelurahan` varchar(50) NOT NULL,
  `rt` int(2) NOT NULL,
  `rw` int(2) NOT NULL,
  `ttl` varchar(129) NOT NULL,
  `no_telpon` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `warga`
--
ALTER TABLE `warga`
  ADD PRIMARY KEY (`nik`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
