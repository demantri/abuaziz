-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 09 Jul 2020 pada 00.49
-- Versi server: 10.4.11-MariaDB
-- Versi PHP: 7.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `2019_sekolah`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `akun`
--

CREATE TABLE `akun` (
  `no_akun` varchar(25) NOT NULL,
  `nama_akun` varchar(25) NOT NULL,
  `jenis_akun` varchar(25) NOT NULL,
  `delete` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `akun`
--

INSERT INTO `akun` (`no_akun`, `nama_akun`, `jenis_akun`, `delete`) VALUES
('111', 'Kas', 'aktiva', 0),
('112', 'Piutang SPP', 'aktiva', 0),
('113', 'Pembelian', 'aktiva', 0),
('121', 'Piutang Pendaftaran', 'aktiva', 0),
('122', 'Piutang Daftar Ulang', 'aktiva', 0),
('211', 'Utang', 'aktiva', 0),
('411', 'Pendapatan SPP', 'aktiva', 0),
('421', 'Pendapatan Pendaftaran', 'pasiva', 0),
('422', 'Pendapatan Daftar Ulang', 'pasiva', 0),
('423', 'Pendapatan Lain-lain', 'pasiva', 0),
('424', 'Pendapatan Dana Terikat', 'pasiva', 0),
('511', 'Beban Air', 'aktiva', 0),
('512', 'beban gaji', 'aktiva', 0),
('513', 'beban listrik', 'aktiva', 0),
('514', 'beban internet', 'aktiva', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `aset`
--

CREATE TABLE `aset` (
  `no_aset` varchar(25) NOT NULL,
  `nama_aset` varchar(25) NOT NULL,
  `satuan_aset` varchar(50) NOT NULL,
  `jenis_aset` varchar(25) NOT NULL,
  `harga_aset` double NOT NULL,
  `delete` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `aset`
--

INSERT INTO `aset` (`no_aset`, `nama_aset`, `satuan_aset`, `jenis_aset`, `harga_aset`, `delete`) VALUES
('Ast_000001', 'fff', 'Buah', 'Perlengkapan', 444, 0),
('Ast_000002', 'ffftt', 'Lusin', 'Kendaraan', 444, 0),
('Ast_000003', 'bangku', 'Buah', 'Perlengkapan', 50000, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `beban_beban`
--

CREATE TABLE `beban_beban` (
  `no_beban` varchar(50) NOT NULL,
  `nama_beban` varchar(50) NOT NULL,
  `delete` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `beban_beban`
--

INSERT INTO `beban_beban` (`no_beban`, `nama_beban`, `delete`) VALUES
('Bbn_000001', 'Beban Air', 0),
('Bbn_000002', 'beban gaji', 0),
('Bbn_000003', 'beban listrik', 0),
('Bbn_000004', 'beban internet', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `daftar_ulang`
--

CREATE TABLE `daftar_ulang` (
  `no_transaksi` varchar(25) NOT NULL,
  `no_siswa` varchar(25) NOT NULL,
  `kelas` varchar(25) NOT NULL,
  `biaya_daftar_ulang` double NOT NULL,
  `pembayaran` double NOT NULL,
  `sisa_pembayaran` double NOT NULL,
  `status_pembayaran` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `daftar_ulang`
--

INSERT INTO `daftar_ulang` (`no_transaksi`, `no_siswa`, `kelas`, `biaya_daftar_ulang`, `pembayaran`, `sisa_pembayaran`, `status_pembayaran`) VALUES
('Dfu_000001', 'Ssw_000010', 'kelas 1', 500000, 500000, 0, 'Lunas'),
('Dfu_000002', 'Ssw_000011', 'kelas 1', 500000, 500000, 0, 'Lunas'),
('Dfu_000003', 'Ssw_000012', '', 500000, 200000, 300000, 'Belum Lunas');

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_pembayaran`
--

CREATE TABLE `detail_pembayaran` (
  `no` int(11) NOT NULL,
  `no_transaksi` varchar(100) NOT NULL,
  `tanggal_transaksi` date NOT NULL,
  `pembayaran` int(11) NOT NULL,
  `sisa_pembayaran` int(11) NOT NULL,
  `status_pembayaran` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `detail_pembayaran`
--

INSERT INTO `detail_pembayaran` (`no`, `no_transaksi`, `tanggal_transaksi`, `pembayaran`, `sisa_pembayaran`, `status_pembayaran`) VALUES
(1, 'Npd_000004', '2020-07-08', 100000, 325000, 'Belum Lunas'),
(2, 'Npd_000004', '2020-07-08', 100000, 225000, 'Belum Lunas'),
(3, 'Dfu_000003', '2020-07-08', 100000, 400000, 'Belum Lunas');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jurnal`
--

CREATE TABLE `jurnal` (
  `no_jurnal` int(11) NOT NULL,
  `no_transaksi` varchar(25) NOT NULL,
  `no_akun` varchar(25) NOT NULL,
  `nominal` double NOT NULL,
  `posisi` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `jurnal`
--

INSERT INTO `jurnal` (`no_jurnal`, `no_transaksi`, `no_akun`, `nominal`, `posisi`) VALUES
(1, 'Npd_000001', '111', 500000, 'debit'),
(2, 'Npd_000001', '421', 500000, 'kredit'),
(3, 'Npd_000002', '111', 500000, 'debit'),
(4, 'Npd_000002', '421', 500000, 'kredit'),
(5, 'Dfu_000001', '111', 500000, 'debit'),
(6, 'Dfu_000001', '422', 500000, 'kredit'),
(7, 'SPP_000001', '111', 800000, 'debit'),
(8, 'SPP_000001', '411', 800000, 'kredit'),
(9, 'Npd_000003', '111', 425000, 'debit'),
(10, 'Npd_000003', '421', 500000, 'kredit'),
(11, 'Npd_000004', '111', 100000, 'debit'),
(12, 'Npd_000004', '121', 375000, 'debit'),
(13, 'Npd_000004', '421', 500000, 'kredit'),
(14, 'Dfu_000002', '111', 500000, 'debit'),
(15, 'Dfu_000002', '422', 500000, 'kredit'),
(16, 'Dfu_000003', '111', 100000, 'debit'),
(17, 'Dfu_000003', '122', 500000, 'debit'),
(18, 'Dfu_000003', '422', 500000, 'kredit'),
(19, 'Pdll_000001', '111', 1000000, 'debit'),
(20, 'Pdll_000001', '423', 1000000, 'kredit');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kelas`
--

CREATE TABLE `kelas` (
  `no_kelas` int(11) NOT NULL,
  `no_siswa` varchar(25) NOT NULL,
  `nama_kelas` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `kelas`
--

INSERT INTO `kelas` (`no_kelas`, `no_siswa`, `nama_kelas`) VALUES
(1, 'Ssw_000010', 'kelas 1'),
(2, 'Ssw_000011', 'kelas 1'),
(3, 'Ssw_000012', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `master_pendapatan`
--

CREATE TABLE `master_pendapatan` (
  `no_pendapatan` varchar(50) NOT NULL,
  `nama_pendapatan` varchar(50) NOT NULL,
  `delete` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `master_pendapatan`
--

INSERT INTO `master_pendapatan` (`no_pendapatan`, `nama_pendapatan`, `delete`) VALUES
('Pnd_000001', 'pendapatan ngaji', 1),
('Pnd_000002', 'penjualan seragam', 0),
('Pnd_000003', 'infaq', 0),
('Pnd_000004', 'antar jemput', 0),
('Pnd_000005', 'sukrela', 1),
('Pnd_000006', 'a', 1),
('Pnd_000007', 'l', 1),
('Pnd_000008', 'i', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `master_pengeluaran`
--

CREATE TABLE `master_pengeluaran` (
  `no_pengeluaran` varchar(50) NOT NULL,
  `nama_pengeluaran` varchar(50) NOT NULL,
  `delete` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `master_pengeluaran`
--

INSERT INTO `master_pengeluaran` (`no_pengeluaran`, `nama_pengeluaran`, `delete`) VALUES
('Png_000001', 'pengeluaran dapur', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pegawai`
--

CREATE TABLE `pegawai` (
  `no_pegawai` varchar(25) NOT NULL,
  `nip` varchar(25) NOT NULL,
  `nama_pegawai` varchar(25) NOT NULL,
  `alamat_pegawai` varchar(50) NOT NULL,
  `no_telepon` varchar(20) NOT NULL,
  `jenis_kelamin` varchar(25) NOT NULL,
  `delete` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pembayaran_beban`
--

CREATE TABLE `pembayaran_beban` (
  `no_transaksi` varchar(50) NOT NULL,
  `no_beban` varchar(50) NOT NULL,
  `total_pengeluaran` int(50) NOT NULL,
  `keterangan` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pendaftaran`
--

CREATE TABLE `pendaftaran` (
  `no_transaksi` varchar(25) NOT NULL,
  `tanggal_transaksi` date DEFAULT NULL,
  `no_siswa` varchar(25) NOT NULL,
  `biaya_pendaftaran` double NOT NULL,
  `pembayaran` double NOT NULL,
  `sisa_pembayaran` double NOT NULL,
  `keterangan` varchar(100) NOT NULL,
  `status_pembayaran` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pendaftaran`
--

INSERT INTO `pendaftaran` (`no_transaksi`, `tanggal_transaksi`, `no_siswa`, `biaya_pendaftaran`, `pembayaran`, `sisa_pembayaran`, `keterangan`, `status_pembayaran`) VALUES
('Npd_000001', '2020-07-06', 'Ssw_000010', 500000, 500000, 0, '', 'Lunas'),
('Npd_000002', '2020-07-06', 'Ssw_000011', 500000, 500000, 0, '', 'Lunas'),
('Npd_000003', '2020-07-08', 'Ssw_000012', 500000, 425000, 0, '', 'Lunas'),
('Npd_000004', '2020-07-08', 'Ssw_000013', 500000, 300000, 125000, '', 'Belum Lunas');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pendapatan`
--

CREATE TABLE `pendapatan` (
  `no_transaksi` varchar(25) NOT NULL,
  `nama_pendapatan` varchar(50) NOT NULL,
  `sumber_pendapatan` varchar(50) NOT NULL,
  `jumlah_pendapatan` double NOT NULL,
  `keterangan` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pendapatan_lain_lain`
--

CREATE TABLE `pendapatan_lain_lain` (
  `no_transaksi` varchar(25) NOT NULL,
  `no_pendapatan` varchar(25) NOT NULL,
  `jumlah_pendapatan` double NOT NULL,
  `keterangan` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pendapatan_lain_lain`
--

INSERT INTO `pendapatan_lain_lain` (`no_transaksi`, `no_pendapatan`, `jumlah_pendapatan`, `keterangan`) VALUES
('Pdll_000001', 'Pnd_000002', 1000000, 'tes');

-- --------------------------------------------------------

--
-- Struktur dari tabel `potongan_biaya`
--

CREATE TABLE `potongan_biaya` (
  `no_potongan` int(11) NOT NULL,
  `nama_potongan` varchar(100) NOT NULL,
  `potongan` int(11) NOT NULL,
  `no_rincian` varchar(20) NOT NULL,
  `delete` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `potongan_biaya`
--

INSERT INTO `potongan_biaya` (`no_potongan`, `nama_potongan`, `potongan`, `no_rincian`, `delete`) VALUES
(2, 'tes', 15, 'Rcb_000001', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `rincian_biaya`
--

CREATE TABLE `rincian_biaya` (
  `no_rincian` varchar(100) NOT NULL,
  `nama_rincian` varchar(100) NOT NULL,
  `transaksi_utama` varchar(100) NOT NULL,
  `harga_rincian` int(100) NOT NULL,
  `delete` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `rincian_biaya`
--

INSERT INTO `rincian_biaya` (`no_rincian`, `nama_rincian`, `transaksi_utama`, `harga_rincian`, `delete`) VALUES
('Rcb_000001', 'BIaya Pendaftaran', 'pendaftaran', 500000, 0),
('Rcb_000002', 'Biaya Perlengkapan', 'daftar_ulang', 2000000, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `siswa`
--

CREATE TABLE `siswa` (
  `no_siswa` varchar(25) NOT NULL,
  `tanggal_transaksi` date NOT NULL,
  `nis` varchar(25) NOT NULL,
  `nama_siswa` varchar(25) NOT NULL,
  `alamat_siswa` varchar(50) NOT NULL,
  `no_telepon` varchar(20) NOT NULL,
  `jenis_kelamin` varchar(25) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `tempat_lahir` varchar(50) NOT NULL,
  `nama_ayah` varchar(50) NOT NULL,
  `nama_ibu` varchar(50) NOT NULL,
  `no_telepon_ortu` varchar(25) NOT NULL,
  `delete` tinyint(1) NOT NULL,
  `status_siswa` varchar(100) NOT NULL,
  `angkatan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `siswa`
--

INSERT INTO `siswa` (`no_siswa`, `tanggal_transaksi`, `nis`, `nama_siswa`, `alamat_siswa`, `no_telepon`, `jenis_kelamin`, `tanggal_lahir`, `tempat_lahir`, `nama_ayah`, `nama_ibu`, `no_telepon_ortu`, `delete`, `status_siswa`, `angkatan`) VALUES
('Ssw_000010', '2020-07-06', '123456', 'tes data', 'bandung', '', 'Perempuan', '2020-07-06', 'bandung', 'tes ayah', 'tes ibu', '081212121212', 0, 'Siswa', 5),
('Ssw_000011', '2020-07-06', '12345678', 'tes data 1', 'bandung', '', 'Perempuan', '2020-07-06', 'bandung', 'tes ayah 1', 'te ibu 1', '0813131313131', 0, 'Siswa', 5),
('Ssw_000012', '2020-07-08', '123490', 'tes ajah nih', 'bandung', '', 'Perempuan', '2020-07-09', 'bandung', 'tes ayah 2', 'tes ibu 2', '6281310730236', 0, 'Siswa', 5),
('Ssw_000013', '2020-07-08', '10000000', 'muhamad', 'bandung', '', 'Perempuan', '2020-07-09', 'bandung', 'ayah', 'ibu', '6281310730236', 0, 'Siswa', 5);

-- --------------------------------------------------------

--
-- Struktur dari tabel `spp`
--

CREATE TABLE `spp` (
  `no_transaksi` varchar(25) NOT NULL,
  `no_siswa` varchar(25) NOT NULL,
  `biaya_spp` double NOT NULL,
  `keterangan` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `spp`
--

INSERT INTO `spp` (`no_transaksi`, `no_siswa`, `biaya_spp`, `keterangan`) VALUES
('SPP_000001', 'Ssw_000010', 800000, 'July');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tahun_ajaran`
--

CREATE TABLE `tahun_ajaran` (
  `no` int(11) NOT NULL,
  `nama_ajaran` varchar(100) NOT NULL,
  `harga_ajaran` varchar(100) NOT NULL,
  `delete` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tahun_ajaran`
--

INSERT INTO `tahun_ajaran` (`no`, `nama_ajaran`, `harga_ajaran`, `delete`) VALUES
(5, '2020', '800000', 0),
(7, '2021', '900000', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi`
--

CREATE TABLE `transaksi` (
  `no_transaksi` varchar(25) NOT NULL,
  `no_user` varchar(25) NOT NULL,
  `nama_transaksi` varchar(25) NOT NULL,
  `tanggal_transaksi` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `transaksi`
--

INSERT INTO `transaksi` (`no_transaksi`, `no_user`, `nama_transaksi`, `tanggal_transaksi`) VALUES
('Dfu_000001', 'tata usaha', 'daftar ulang', '2020-07-06'),
('Dfu_000002', 'tata usaha', 'daftar ulang', '2020-07-08'),
('Dfu_000003', 'tata usaha', 'daftar ulang', '2020-07-08'),
('Npd_000001', 'tata usaha', 'pendaftaran', '2020-07-06'),
('Npd_000002', 'tata usaha', 'pendaftaran', '2020-07-06'),
('Npd_000003', 'tata usaha', 'pendaftaran', '2020-07-08'),
('Npd_000004', 'tata usaha', 'pendaftaran', '2020-07-08'),
('Pdll_000001', 'tata usaha', 'pendapatan lain-lain', '2020-07-09'),
('SPP_000001', 'tata usaha', 'spp', '2020-07-06');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `no_user` varchar(25) NOT NULL,
  `username` varchar(25) NOT NULL,
  `jabatan` varchar(25) NOT NULL,
  `password` varchar(25) NOT NULL,
  `delete` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`no_user`, `username`, `jabatan`, `password`, `delete`) VALUES
('bagian operasional', 'bagian operasional', 'Bagian Operasional', 'operasional', 0),
('bendahara yayasan', 'bendahara yayasan', 'Bendahara Yayasan', '123123', 0),
('izzura', 'Izzura', 'admin', '123123', 0),
('ketua yayasan', 'ketua yayasan', 'Ketua Yayasan', '123123', 0),
('pegawai', 'pegawai', 'Pegawai', '123123', 0),
('rinda', 'Rinda', 'admin', '123123', 0),
('tamia', 'Tamia', 'admin', '123123', 0),
('tata usaha', 'tata usaha', 'Tata Usaha', 'tatausaha', 0);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `akun`
--
ALTER TABLE `akun`
  ADD PRIMARY KEY (`no_akun`);

--
-- Indeks untuk tabel `aset`
--
ALTER TABLE `aset`
  ADD PRIMARY KEY (`no_aset`);

--
-- Indeks untuk tabel `beban_beban`
--
ALTER TABLE `beban_beban`
  ADD PRIMARY KEY (`no_beban`);

--
-- Indeks untuk tabel `daftar_ulang`
--
ALTER TABLE `daftar_ulang`
  ADD KEY `no_transaksi` (`no_transaksi`,`no_siswa`),
  ADD KEY `no_siswa` (`no_siswa`);

--
-- Indeks untuk tabel `detail_pembayaran`
--
ALTER TABLE `detail_pembayaran`
  ADD PRIMARY KEY (`no`);

--
-- Indeks untuk tabel `jurnal`
--
ALTER TABLE `jurnal`
  ADD PRIMARY KEY (`no_jurnal`),
  ADD KEY `no_transaksi` (`no_transaksi`,`no_akun`),
  ADD KEY `no_akun` (`no_akun`),
  ADD KEY `no_transaksi_2` (`no_transaksi`),
  ADD KEY `no_akun_2` (`no_akun`);

--
-- Indeks untuk tabel `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`no_kelas`);

--
-- Indeks untuk tabel `master_pendapatan`
--
ALTER TABLE `master_pendapatan`
  ADD PRIMARY KEY (`no_pendapatan`);

--
-- Indeks untuk tabel `master_pengeluaran`
--
ALTER TABLE `master_pengeluaran`
  ADD PRIMARY KEY (`no_pengeluaran`);

--
-- Indeks untuk tabel `pegawai`
--
ALTER TABLE `pegawai`
  ADD PRIMARY KEY (`no_pegawai`);

--
-- Indeks untuk tabel `pembayaran_beban`
--
ALTER TABLE `pembayaran_beban`
  ADD KEY `no_transaksi` (`no_transaksi`,`no_beban`),
  ADD KEY `no_beban` (`no_beban`),
  ADD KEY `no_transaksi_2` (`no_transaksi`);

--
-- Indeks untuk tabel `pendaftaran`
--
ALTER TABLE `pendaftaran`
  ADD KEY `no_transaksi` (`no_transaksi`,`no_siswa`),
  ADD KEY `no_siswa` (`no_siswa`);

--
-- Indeks untuk tabel `pendapatan`
--
ALTER TABLE `pendapatan`
  ADD KEY `no_transaksi` (`no_transaksi`);

--
-- Indeks untuk tabel `pendapatan_lain_lain`
--
ALTER TABLE `pendapatan_lain_lain`
  ADD KEY `no_transaksi` (`no_transaksi`,`no_pendapatan`),
  ADD KEY `no_siswa` (`no_pendapatan`);

--
-- Indeks untuk tabel `potongan_biaya`
--
ALTER TABLE `potongan_biaya`
  ADD PRIMARY KEY (`no_potongan`);

--
-- Indeks untuk tabel `rincian_biaya`
--
ALTER TABLE `rincian_biaya`
  ADD PRIMARY KEY (`no_rincian`);

--
-- Indeks untuk tabel `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`no_siswa`);

--
-- Indeks untuk tabel `spp`
--
ALTER TABLE `spp`
  ADD PRIMARY KEY (`no_transaksi`);

--
-- Indeks untuk tabel `tahun_ajaran`
--
ALTER TABLE `tahun_ajaran`
  ADD PRIMARY KEY (`no`);

--
-- Indeks untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`no_transaksi`),
  ADD KEY `no_user` (`no_user`),
  ADD KEY `no_user_2` (`no_user`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`no_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `detail_pembayaran`
--
ALTER TABLE `detail_pembayaran`
  MODIFY `no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `jurnal`
--
ALTER TABLE `jurnal`
  MODIFY `no_jurnal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT untuk tabel `kelas`
--
ALTER TABLE `kelas`
  MODIFY `no_kelas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `potongan_biaya`
--
ALTER TABLE `potongan_biaya`
  MODIFY `no_potongan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `tahun_ajaran`
--
ALTER TABLE `tahun_ajaran`
  MODIFY `no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `daftar_ulang`
--
ALTER TABLE `daftar_ulang`
  ADD CONSTRAINT `daftar_ulang_ibfk_1` FOREIGN KEY (`no_transaksi`) REFERENCES `transaksi` (`no_transaksi`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `daftar_ulang_ibfk_2` FOREIGN KEY (`no_siswa`) REFERENCES `siswa` (`no_siswa`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `jurnal`
--
ALTER TABLE `jurnal`
  ADD CONSTRAINT `jurnal_ibfk_1` FOREIGN KEY (`no_transaksi`) REFERENCES `transaksi` (`no_transaksi`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `jurnal_ibfk_2` FOREIGN KEY (`no_akun`) REFERENCES `akun` (`no_akun`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `pendaftaran`
--
ALTER TABLE `pendaftaran`
  ADD CONSTRAINT `pendaftaran_ibfk_1` FOREIGN KEY (`no_transaksi`) REFERENCES `transaksi` (`no_transaksi`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pendaftaran_ibfk_2` FOREIGN KEY (`no_siswa`) REFERENCES `siswa` (`no_siswa`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
