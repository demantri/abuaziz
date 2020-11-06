-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 04 Jul 2020 pada 17.53
-- Versi server: 10.1.34-MariaDB
-- Versi PHP: 7.2.8

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
('Dfu_000001', 'Ssw_000001', 'kelas 2', 5000000, 5000000, 0, 'Lunas'),
('Dfu_000002', 'Ssw_000002', 'kelas 2', 2000000, 1000000, 0, 'Lunas'),
('Dfu_000003', 'Ssw_000003', 'kelas 2', 2000000, 1000000, 1000000, 'Belum Lunas');

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
(1, 'Npd_000001', '111', 7991666, 'debit'),
(2, 'Npd_000001', '421', 7991666, 'kredit'),
(3, 'Dfu_000001', '111', 5000000, 'debit'),
(4, 'Dfu_000001', '422', 5000000, 'kredit'),
(7, 'Npd_000002', '111', 200000, 'debit'),
(8, 'Npd_000002', '121', 300000, 'debit'),
(9, 'Npd_000002', '421', 500000, 'kredit'),
(10, 'Dfu_000002', '111', 1000000, 'debit'),
(11, 'Dfu_000002', '122', 1000000, 'debit'),
(12, 'Dfu_000002', '422', 2000000, 'kredit'),
(13, 'SPP_000001', '111', 800000, 'debit'),
(14, 'SPP_000001', '411', 800000, 'kredit'),
(15, 'Npd_000003', '111', 500000, 'debit'),
(16, 'Npd_000003', '421', 500000, 'kredit'),
(17, 'Dfu_000003', '111', 1000000, 'debit'),
(18, 'Dfu_000003', '122', 1000000, 'debit'),
(19, 'Dfu_000003', '422', 2000000, 'kredit'),
(20, 'SPP_000007', '111', 800000, 'debit'),
(21, 'SPP_000007', '411', 800000, 'kredit'),
(22, 'Npd_000004', '111', 500000, 'debit'),
(23, 'Npd_000004', '421', 500000, 'kredit'),
(24, 'SPP_000007', '112', 800000, 'Debit'),
(25, 'SPP_000007', '411', 800000, 'Kredit'),
(26, 'SPP_000002', '111', 800000, 'debit'),
(27, 'SPP_000002', '411', 800000, 'kredit'),
(28, 'Npd_000005', '111', 500000, 'debit'),
(29, 'Npd_000005', '421', 500000, 'kredit'),
(30, 'SPP_000004', '111', 800000, 'debit'),
(31, 'SPP_000004', '411', 800000, 'kredit'),
(32, 'SPP_000010', '111', 800000, 'debit'),
(33, 'SPP_000010', '411', 800000, 'kredit'),
(36, 'Npd_000006', '111', 500000, 'debit'),
(37, 'Npd_000006', '421', 500000, 'kredit'),
(38, 'SPP_000011', '111', 800000, 'debit'),
(39, 'SPP_000011', '411', 800000, 'kredit'),
(58, 'Npd_000007', '111', 500000, 'debit'),
(59, 'Npd_000007', '421', 500000, 'kredit'),
(60, 'Npd_000008', '111', 500000, 'debit'),
(61, 'Npd_000008', '421', 500000, 'kredit'),
(62, 'SPP_000012', '111', 800000, 'debit'),
(63, 'SPP_000012', '411', 800000, 'kredit'),
(64, 'SPP_000013', '111', 800000, 'debit'),
(65, 'SPP_000013', '411', 800000, 'kredit'),
(66, 'SPP_000014', '111', 800000, 'debit'),
(67, 'SPP_000014', '411', 800000, 'kredit'),
(68, 'SPP_000015', '111', 800000, 'debit'),
(69, 'SPP_000015', '411', 800000, 'kredit'),
(70, 'SPP_000016', '111', 800000, 'debit'),
(71, 'SPP_000016', '411', 800000, 'kredit'),
(72, 'SPP_000017', '111', 800000, 'debit'),
(73, 'SPP_000017', '411', 800000, 'kredit'),
(74, 'SPP_000018', '111', 800000, 'debit'),
(75, 'SPP_000018', '411', 800000, 'kredit'),
(76, 'SPP_000019', '111', 800000, 'debit'),
(77, 'SPP_000019', '411', 800000, 'kredit'),
(78, 'SPP_000020', '111', 800000, 'debit'),
(79, 'SPP_000020', '411', 800000, 'kredit'),
(80, 'SPP_000021', '111', 800000, 'debit'),
(81, 'SPP_000021', '411', 800000, 'kredit');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kelas`
--

CREATE TABLE `kelas` (
  `no_kelas` varchar(25) NOT NULL,
  `nis` varchar(25) NOT NULL,
  `nama_siswa` varchar(25) NOT NULL,
  `nama_kelas` varchar(25) NOT NULL,
  `angkatan` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
('Pnd_000002', 'penjualan seragamn', 0),
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

--
-- Dumping data untuk tabel `pembayaran_beban`
--

INSERT INTO `pembayaran_beban` (`no_transaksi`, `no_beban`, `total_pengeluaran`, `keterangan`) VALUES
('BB_000001', 'Bbn_000001', 100000, '123'),
('BB_000002', 'Bbn_000003', 500000, 'Lunas'),
('BB_000003', 'Bbn_000004', 9999, 'Lunas');

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
('Npd_000001', '2020-06-24', 'Ssw_000001', 7991666, 7991666, 0, '', 'Lunas'),
('Npd_000002', '2020-06-24', 'Ssw_000002', 500000, 200000, 300000, '', 'Belum Lunas'),
('Npd_000003', '2020-06-25', 'Ssw_000003', 500000, 500000, 0, '', 'Lunas'),
('Npd_000004', '2020-06-29', 'Ssw_000004', 500000, 500000, 0, '', 'Lunas'),
('Npd_000005', '2020-06-29', 'Ssw_000005', 500000, 500000, 0, '', 'Lunas'),
('Npd_000006', '2020-06-30', 'Ssw_000006', 500000, 500000, 0, '', 'Lunas'),
('Npd_000008', '2020-07-02', 'Ssw_000009', 500000, 500000, 0, '', 'Lunas');

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

--
-- Dumping data untuk tabel `pendapatan`
--

INSERT INTO `pendapatan` (`no_transaksi`, `nama_pendapatan`, `sumber_pendapatan`, `jumlah_pendapatan`, `keterangan`) VALUES
('Pd_000001', 'DUPI', 'dana untuk pendidikan islam', 700000, 'lunas');

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
('Pdll_000001', 'Pnd_000003', 1000000, 'infaq harian senin'),
('Pdll_000002', 'Pnd_000002', 800000, '');

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
  `tgl` date NOT NULL,
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
  `status_siswa` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `siswa`
--

INSERT INTO `siswa` (`no_siswa`, `tgl`, `nis`, `nama_siswa`, `alamat_siswa`, `no_telepon`, `jenis_kelamin`, `tanggal_lahir`, `tempat_lahir`, `nama_ayah`, `nama_ibu`, `no_telepon_ortu`, `delete`, `status_siswa`) VALUES
('Ssw_000001', '2020-06-24', '12345', 'urel', 'kudaile', '', 'Perempuan', '2020-04-26', 'semarang', 'papapapa', 'mammama', '085678765657', 0, 'Siswa'),
('Ssw_000002', '2020-06-24', '12345', 'bimo', 'kudaile', '', 'Perempuan', '2020-04-26', 'semarang', 'pappa', 'mama', '08989898989', 0, 'Siswa'),
('Ssw_000003', '2020-06-25', '12345', 'zura', 'ghjhk', '', 'Perempuan', '2020-04-26', 'vhn', 'papa', 'mammama', '085678765657', 0, 'Siswa'),
('Ssw_000004', '2020-06-29', '12345', 'Paul', 'hjhjhj', '', 'Perempuan', '2020-03-30', 'Semarang', 'paapapap', 'ammmamam', '085869275276', 0, 'Siswa'),
('Ssw_000005', '2020-06-29', '1234', 'imel', 'bjbj', '', 'Perempuan', '2020-05-31', 'njjjhjfgfg', 'papapappa', 'hasjhsjhsj', '08989898989', 0, 'Siswa'),
('Ssw_000006', '2020-06-30', '123456', 'iska', 'vgjvj', '', 'Perempuan', '2020-04-26', 'vfhj', 'hgjk', 'ghgik', '085869275276', 0, 'Siswa'),
('Ssw_000007', '2020-07-02', '456777', 'diesta', 'banten', '', 'Perempuan', '2020-04-27', 'gujgu', 'bapa', 'ibu', '08989898989', 0, 'Siswa'),
('Ssw_000009', '2020-07-02', '1234455', 'kinkan', 'sukapura', '', 'Perempuan', '2020-02-24', 'vfghfhfgh', 'bapap', 'ibuhih', '085678765657', 0, 'Siswa');

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
('SPP_000001', 'Ssw_000002', 800000, 'June'),
('SPP_000002', 'Ssw_000001', 800000, 'June'),
('SPP_000004', 'Ssw_000004', 800000, 'June'),
('SPP_000007', 'Ssw_000003', 800000, 'June'),
('SPP_000010', 'Ssw_000005', 800000, 'June'),
('SPP_000011', 'Ssw_000006', 800000, 'June'),
('SPP_000012', 'Ssw_000009', 800000, 'July'),
('SPP_000013', 'Ssw_000001', 800000, 'July'),
('SPP_000014', 'Ssw_000007', 800000, 'July'),
('SPP_000015', 'Ssw_000001', 800000, 'July'),
('SPP_000016', 'Ssw_000001', 800000, 'July'),
('SPP_000017', 'Ssw_000002', 800000, 'July'),
('SPP_000018', 'Ssw_000004', 800000, 'July'),
('SPP_000019', 'Ssw_000003', 800000, 'July'),
('SPP_000020', 'Ssw_000005', 800000, 'July'),
('SPP_000021', 'Ssw_000006', 800000, 'July');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tahun_ajaran`
--

CREATE TABLE `tahun_ajaran` (
  `no_ajaran` varchar(100) NOT NULL,
  `nama_ajaran` varchar(100) NOT NULL,
  `harga_ajaran` varchar(100) NOT NULL,
  `delete` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tahun_ajaran`
--

INSERT INTO `tahun_ajaran` (`no_ajaran`, `nama_ajaran`, `harga_ajaran`, `delete`) VALUES
('Tha_000001', '2019/2020', '800000', 1),
('Tha_000001', '2019/2020', '800000', 1),
('Tha_000001', '2019/2020', '800000', 1),
('Tha_000002', '567hh', '200000', 1),
('Tha_000003', '2020', '800000', 0),
('Tha_000004', '2020/2021', '690000', 1);

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
('Dfu_000001', 'tata usaha', 'daftar ulang', '2020-06-24'),
('Dfu_000002', 'tata usaha', 'daftar ulang', '2020-06-24'),
('Dfu_000003', 'tata usaha', 'daftar ulang', '2020-06-25'),
('Npd_000001', 'tata usaha', 'pendaftaran', '0000-00-00'),
('Npd_000002', 'tata usaha', 'pendaftaran', '0000-00-00'),
('Npd_000003', 'tata usaha', 'pendaftaran', '0000-00-00'),
('Npd_000004', 'tata usaha', 'pendaftaran', '0000-00-00'),
('Npd_000005', 'tata usaha', 'pendaftaran', '0000-00-00'),
('Npd_000006', 'tata usaha', 'pendaftaran', '0000-00-00'),
('Npd_000007', 'tata usaha', 'pendaftaran', '0000-00-00'),
('Npd_000008', 'tata usaha', 'pendaftaran', '0000-00-00'),
('SPP_000001', 'tata usaha', 'spp', '2020-06-24'),
('SPP_000002', 'tata usaha', 'spp', '2020-06-29'),
('SPP_000004', 'tata usaha', 'spp', '2020-06-30'),
('SPP_000007', 'tata usaha', 'spp', '2020-06-28'),
('SPP_000010', 'tata usaha', 'spp', '2020-06-30'),
('SPP_000011', 'tata usaha', 'spp', '2020-06-30'),
('SPP_000012', 'tata usaha', 'spp', '2020-07-02'),
('SPP_000013', 'tata usaha', 'spp', '2020-07-02'),
('SPP_000014', 'tata usaha', 'spp', '2020-07-02'),
('SPP_000015', 'tata usaha', 'spp', '2020-07-02'),
('SPP_000016', 'tata usaha', 'spp', '2020-07-02'),
('SPP_000017', 'tata usaha', 'spp', '2020-07-04'),
('SPP_000018', 'tata usaha', 'spp', '2020-07-04'),
('SPP_000019', 'tata usaha', 'spp', '2020-07-04'),
('SPP_000020', 'tata usaha', 'spp', '2020-07-04'),
('SPP_000021', 'tata usaha', 'spp', '2020-07-04');

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
-- Indeks untuk tabel `jurnal`
--
ALTER TABLE `jurnal`
  ADD PRIMARY KEY (`no_jurnal`),
  ADD KEY `no_transaksi` (`no_transaksi`,`no_akun`),
  ADD KEY `no_akun` (`no_akun`),
  ADD KEY `no_transaksi_2` (`no_transaksi`),
  ADD KEY `no_akun_2` (`no_akun`);

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
-- AUTO_INCREMENT untuk tabel `jurnal`
--
ALTER TABLE `jurnal`
  MODIFY `no_jurnal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

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
