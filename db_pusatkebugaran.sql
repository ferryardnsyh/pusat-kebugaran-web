-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 17 Jan 2025 pada 08.58
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_pusatkebugaran`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `anggota`
--

CREATE TABLE `anggota` (
  `id_anggota` int(11) NOT NULL,
  `nama_anggota` varchar(100) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `tanggal_lahir` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `anggota`
--

INSERT INTO `anggota` (`id_anggota`, `nama_anggota`, `alamat`, `tanggal_lahir`) VALUES
(1, 'Ferry Ardiansyah', 'Jl. Merdeka No. 10, Jakarta', '2005-03-26'),
(2, 'Siti Nurhaliza', 'Jl. Kenanga No. 5, Bandung', '2000-12-10'),
(3, 'Ahmad Fauzi', 'Jl. Mawar No. 3, Surabaya', '1998-07-20'),
(4, 'Lisa Marlina', 'Jl. Anggrek No. 9, Yogyakarta', '2003-09-05'),
(5, 'Rudi Santoso', 'Jl. Melati No. 15, Semarang', '1995-03-25'),
(6, 'Ilham Arifin', 'Jl. Cipageran', '2004-04-21');

-- --------------------------------------------------------

--
-- Struktur dari tabel `instruktur`
--

CREATE TABLE `instruktur` (
  `id_instruktur` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `spesialis` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `instruktur`
--

INSERT INTO `instruktur` (`id_instruktur`, `nama`, `spesialis`) VALUES
(1, 'Andi Wijaya', 'Yoga'),
(2, 'Mira Kusuma', 'Zumba'),
(3, 'Budi Santoso', 'Personal Trainer'),
(4, 'Rina Marlina', 'Pilates'),
(5, 'Ahmad Fauzan', 'Crossfit'),
(6, 'Ryan Januar', 'Yoga');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kelas`
--

CREATE TABLE `kelas` (
  `id_kelas` int(11) NOT NULL,
  `nama_kelas` varchar(100) NOT NULL,
  `jadwal` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `kelas`
--

INSERT INTO `kelas` (`id_kelas`, `nama_kelas`, `jadwal`) VALUES
(1, 'Yoga Beginner', '2025-01-20 08:00:00'),
(2, 'Zumba Dance', '2025-01-21 10:00:00'),
(3, 'Pilates Advanced', '2025-01-22 14:00:00'),
(4, 'Crossfit Training', '2025-01-23 16:00:00'),
(5, 'Personal Training', '2025-01-24 18:00:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kelas_latihan`
--

CREATE TABLE `kelas_latihan` (
  `id_latihan` int(11) NOT NULL,
  `id_anggota` int(11) NOT NULL,
  `id_instruktur` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `kelas_latihan`
--

INSERT INTO `kelas_latihan` (`id_latihan`, `id_anggota`, `id_instruktur`) VALUES
(5, 1, 1),
(6, 1, 2),
(4, 2, 2),
(3, 3, 3),
(2, 4, 4),
(1, 5, 5),
(7, 6, 6);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `anggota`
--
ALTER TABLE `anggota`
  ADD PRIMARY KEY (`id_anggota`);

--
-- Indeks untuk tabel `instruktur`
--
ALTER TABLE `instruktur`
  ADD PRIMARY KEY (`id_instruktur`);

--
-- Indeks untuk tabel `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`id_kelas`);

--
-- Indeks untuk tabel `kelas_latihan`
--
ALTER TABLE `kelas_latihan`
  ADD PRIMARY KEY (`id_latihan`),
  ADD UNIQUE KEY `id_anggota` (`id_anggota`,`id_instruktur`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `anggota`
--
ALTER TABLE `anggota`
  MODIFY `id_anggota` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT untuk tabel `instruktur`
--
ALTER TABLE `instruktur`
  MODIFY `id_instruktur` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `kelas`
--
ALTER TABLE `kelas`
  MODIFY `id_kelas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `kelas_latihan`
--
ALTER TABLE `kelas_latihan`
  MODIFY `id_latihan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
