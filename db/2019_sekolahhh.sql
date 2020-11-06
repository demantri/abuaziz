-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 28, 2020 at 12:24 PM
-- Server version: 10.1.35-MariaDB
-- PHP Version: 7.2.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `2019_sekolahhh`
--

-- --------------------------------------------------------

--
-- Table structure for table `akun`
--

CREATE TABLE `akun` (
  `no_akun` varchar(25) NOT NULL,
  `nama_akun` varchar(25) NOT NULL,
  `jenis_akun` varchar(25) NOT NULL,
  `delete` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `akun`
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
('425', 'Diskon Pendaftaran', 'pasiva', 0),
('426', 'Diskon Daftar Ulang', 'pasiva', 0),
('511', 'Beban Air', 'aktiva', 0),
('512', 'beban gaji', 'aktiva', 0),
('513', 'beban listrik', 'aktiva', 0),
('514', 'beban internet', 'aktiva', 0);

-- --------------------------------------------------------

--
-- Table structure for table `aset`
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
-- Dumping data for table `aset`
--

INSERT INTO `aset` (`no_aset`, `nama_aset`, `satuan_aset`, `jenis_aset`, `harga_aset`, `delete`) VALUES
('Ast_000001', 'fff', 'Buah', 'Perlengkapan', 444, 0),
('Ast_000002', 'ffftt', 'Lusin', 'Kendaraan', 444, 0),
('Ast_000003', 'bangku', 'Buah', 'Perlengkapan', 50000, 0);

-- --------------------------------------------------------

--
-- Table structure for table `beban_beban`
--

CREATE TABLE `beban_beban` (
  `no_beban` varchar(50) NOT NULL,
  `nama_beban` varchar(50) NOT NULL,
  `delete` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `beban_beban`
--

INSERT INTO `beban_beban` (`no_beban`, `nama_beban`, `delete`) VALUES
('Bbn_000001', 'Beban Air', 0),
('Bbn_000002', 'beban gaji', 0),
('Bbn_000003', 'beban listrik', 0),
('Bbn_000004', 'beban internet', 0);

-- --------------------------------------------------------

--
-- Table structure for table `daftar_ulang`
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
-- Dumping data for table `daftar_ulang`
--

INSERT INTO `daftar_ulang` (`no_transaksi`, `no_siswa`, `kelas`, `biaya_daftar_ulang`, `pembayaran`, `sisa_pembayaran`, `status_pembayaran`) VALUES
('Dfu_000001', 'Ssw_000002', 'kelas 3', 4300000, 100000, 700001, 'Belum Lunas'),
('Dfu_000002', 'Ssw_000013', 'kelas 2', 4300000, 4300000, 0, 'Lunas'),
('Dfu_000003', 'Ssw_000003', 'kelas 5', 4300000, 4300000, 0, 'Lunas'),
('Dfu_000004', 'Ssw_000010', 'kelas 6', 4300000, 2000000, 2300000, 'Belum Lunas'),
('Dfu_000005', 'Ssw_000003', 'kelas 6', 4300000, 4300000, 0, 'Lunas'),
('Dfu_000006', 'Ssw_000009', 'kelas 5', 4300000, 4300000, 0, 'Lunas'),
('Dfu_000007', 'Ssw_000011', 'kelas 4', 4300000, 600000, 3700000, 'Belum Lunas');

-- --------------------------------------------------------

--
-- Table structure for table `detail_pembayaran`
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
-- Dumping data for table `detail_pembayaran`
--

INSERT INTO `detail_pembayaran` (`no`, `no_transaksi`, `tanggal_transaksi`, `pembayaran`, `sisa_pembayaran`, `status_pembayaran`) VALUES
(1, 'Npd_000001', '2020-07-15', 8375000, 0, 'Lunas'),
(2, 'Dfu_000001', '2020-07-15', 2000000, 2300000, 'Belum Lunas'),
(3, 'Npd_000002', '2020-07-15', 7537500, 0, 'Lunas'),
(4, 'Npd_000003', '2020-07-15', 8375000, 0, 'Lunas'),
(5, 'Dfu_000002', '2020-07-15', 4300000, 0, 'Lunas'),
(6, 'Dfu_000001', '2020-07-15', 300000, 2300000, 'Belum Lunas'),
(7, 'Dfu_000001', '2020-07-15', 999999, 2000000, 'Belum Lunas'),
(8, 'Npd_000004', '2020-07-15', 8375000, 0, 'Lunas'),
(9, 'Dfu_000001', '2020-07-15', 100000, 1000001, 'Belum Lunas'),
(10, 'Npd_000005', '2020-07-28', 8375000, 0, 'Lunas'),
(11, 'Npd_000006', '2020-07-28', 2000000, 6375000, 'Belum Lunas'),
(12, 'Npd_000006', '2020-07-28', 1000000, 6375000, 'Belum Lunas'),
(13, 'Dfu_000001', '2020-07-28', 100000, 900001, 'Belum Lunas'),
(14, 'Dfu_000001', '2020-07-28', 100000, 900001, 'Belum Lunas'),
(15, 'Dfu_000001', '2020-07-28', 100000, 800001, 'Belum Lunas'),
(16, 'Dfu_000003', '2020-07-28', 4300000, 0, 'Lunas'),
(17, 'Dfu_000004', '1970-01-01', 2000000, 2300000, 'Belum Lunas'),
(18, 'Dfu_000005', '1970-01-01', 4300000, 0, 'Lunas'),
(19, 'Dfu_000006', '1970-01-01', 4300000, 0, 'Lunas'),
(20, 'Dfu_000007', '1970-01-01', 600000, 3700000, 'Belum Lunas');

-- --------------------------------------------------------

--
-- Table structure for table `jurnal`
--

CREATE TABLE `jurnal` (
  `no_jurnal` int(11) NOT NULL,
  `no_transaksi` varchar(25) NOT NULL,
  `no_akun` varchar(25) NOT NULL,
  `nominal` double NOT NULL,
  `posisi` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jurnal`
--

INSERT INTO `jurnal` (`no_jurnal`, `no_transaksi`, `no_akun`, `nominal`, `posisi`) VALUES
(1, 'Npd_000001', '111', 8375000, 'debit'),
(2, 'Npd_000001', '425', 0, 'debit'),
(3, 'Npd_000001', '421', 8375000, 'kredit'),
(4, 'Dfu_000001', '111', 2000000, 'debit'),
(5, 'Dfu_000001', '122', 2300000, 'debit'),
(6, 'Dfu_000001', '422', 4300000, 'kredit'),
(7, 'Npd_000002', '111', 7537500, 'debit'),
(8, 'Npd_000002', '425', 837500, 'debit'),
(9, 'Npd_000002', '421', 8375000, 'kredit'),
(10, 'Npd_000003', '111', 8375000, 'debit'),
(11, 'Npd_000003', '425', 0, 'debit'),
(12, 'Npd_000003', '421', 8375000, 'kredit'),
(13, 'Dfu_000002', '111', 4300000, 'debit'),
(14, 'Dfu_000002', '422', 4300000, 'kredit'),
(15, 'Pdll_000001', '111', 1000000, 'debit'),
(16, 'Pdll_000001', '423', 1000000, 'kredit'),
(17, 'Npd_000004', '111', 8375000, 'debit'),
(18, 'Npd_000004', '425', 0, 'debit'),
(19, 'Npd_000004', '421', 8375000, 'kredit'),
(20, 'Npd_000005', '111', 8375000, 'debit'),
(21, 'Npd_000005', '425', 0, 'debit'),
(22, 'Npd_000005', '421', 8375000, 'kredit'),
(23, 'Npd_000006', '111', 2000000, 'debit'),
(24, 'Npd_000006', '425', 0, 'debit'),
(25, 'Npd_000006', '121', 6375000, 'debit'),
(26, 'Npd_000006', '421', 8375000, 'kredit'),
(27, 'Npd_000006', '111', 1000000, 'debit'),
(28, 'Npd_000006', '121', 1000000, 'kredit'),
(29, 'Dfu_000001', '111', 100000, 'debit'),
(30, 'Dfu_000001', '122', 100000, 'kredit'),
(31, 'Dfu_000003', '111', 4300000, 'debit'),
(32, 'Dfu_000003', '422', 4300000, 'kredit'),
(33, 'Dfu_000004', '111', 2000000, 'debit'),
(34, 'Dfu_000004', '122', 2300000, 'debit'),
(35, 'Dfu_000004', '422', 4300000, 'kredit'),
(36, 'Dfu_000005', '111', 4300000, 'debit'),
(37, 'Dfu_000005', '422', 4300000, 'kredit'),
(38, 'Dfu_000006', '111', 4300000, 'debit'),
(39, 'Dfu_000006', '422', 4300000, 'kredit'),
(40, 'Dfu_000007', '111', 600000, 'debit'),
(41, 'Dfu_000007', '122', 3700000, 'debit'),
(42, 'Dfu_000007', '422', 4300000, 'kredit');

-- --------------------------------------------------------

--
-- Table structure for table `kelas`
--

CREATE TABLE `kelas` (
  `no_kelas` int(11) NOT NULL,
  `no_siswa` varchar(25) NOT NULL,
  `nama_kelas` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kelas`
--

INSERT INTO `kelas` (`no_kelas`, `no_siswa`, `nama_kelas`) VALUES
(1, 'Ssw_000010', 'kelas 1'),
(2, 'Ssw_000011', 'kelas 1'),
(3, 'Ssw_000012', ''),
(5, 'Ssw_000001', '1');

-- --------------------------------------------------------

--
-- Table structure for table `master_pendapatan`
--

CREATE TABLE `master_pendapatan` (
  `no_pendapatan` varchar(50) NOT NULL,
  `nama_pendapatan` varchar(50) NOT NULL,
  `delete` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `master_pendapatan`
--

INSERT INTO `master_pendapatan` (`no_pendapatan`, `nama_pendapatan`, `delete`) VALUES
('Pnd_000001', 'Penjualan Seragam', 0),
('Pnd_000002', 'Infaq', 0),
('Pnd_000003', 'Antar Jemput Sekolah', 0);

-- --------------------------------------------------------

--
-- Table structure for table `master_pengeluaran`
--

CREATE TABLE `master_pengeluaran` (
  `no_pengeluaran` varchar(50) NOT NULL,
  `nama_pengeluaran` varchar(50) NOT NULL,
  `delete` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `master_pengeluaran`
--

INSERT INTO `master_pengeluaran` (`no_pengeluaran`, `nama_pengeluaran`, `delete`) VALUES
('Png_000001', 'pengeluaran dapur', 0);

-- --------------------------------------------------------

--
-- Table structure for table `pegawai`
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
-- Table structure for table `pembayaran_beban`
--

CREATE TABLE `pembayaran_beban` (
  `no_transaksi` varchar(50) NOT NULL,
  `no_beban` varchar(50) NOT NULL,
  `total_pengeluaran` int(50) NOT NULL,
  `keterangan` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pendaftaran`
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
-- Dumping data for table `pendaftaran`
--

INSERT INTO `pendaftaran` (`no_transaksi`, `tanggal_transaksi`, `no_siswa`, `biaya_pendaftaran`, `pembayaran`, `sisa_pembayaran`, `keterangan`, `status_pembayaran`) VALUES
('Npd_000001', '2020-07-15', 'Ssw_000011', 8375000, 8375000, 0, '', 'Lunas'),
('Npd_000002', '2020-07-15', 'Ssw_000012', 7537500, 7537500, 0, '', 'Lunas'),
('Npd_000003', '2020-07-15', 'Ssw_000013', 8375000, 8375000, 0, '', 'Lunas'),
('Npd_000004', '2020-07-15', 'Ssw_000014', 8375000, 8375000, 0, '', 'Lunas'),
('Npd_000005', '2020-07-28', 'Ssw_000015', 8375000, 8375000, 0, '', 'Lunas'),
('Npd_000006', '2020-07-28', 'Ssw_000016', 2000000, 3000000, 5375000, '', 'Belum Lunas');

-- --------------------------------------------------------

--
-- Table structure for table `pendapatan`
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
-- Table structure for table `pendapatan_lain_lain`
--

CREATE TABLE `pendapatan_lain_lain` (
  `no_transaksi` varchar(25) NOT NULL,
  `no_pendapatan` varchar(25) NOT NULL,
  `jumlah_pendapatan` double NOT NULL,
  `keterangan` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pendapatan_lain_lain`
--

INSERT INTO `pendapatan_lain_lain` (`no_transaksi`, `no_pendapatan`, `jumlah_pendapatan`, `keterangan`) VALUES
('Pdll_000001', 'Pnd_000001', 1000000, 'Seragam Batik');

-- --------------------------------------------------------

--
-- Table structure for table `potongan_biaya`
--

CREATE TABLE `potongan_biaya` (
  `no_potongan` int(11) NOT NULL,
  `nama_potongan` varchar(100) NOT NULL,
  `potongan` int(11) NOT NULL,
  `no_rincian` varchar(20) NOT NULL,
  `delete` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `potongan_biaya`
--

INSERT INTO `potongan_biaya` (`no_potongan`, `nama_potongan`, `potongan`, `no_rincian`, `delete`) VALUES
(1, 'Tanpa potongan', 0, 'Rcb_000001', 0),
(2, 'Pemenang lomba', 10, 'Rcb_000006', 0),
(3, 'Anak Guru', 10, 'Rcb_000003', 0),
(4, 'Gelombang 1', 100, 'Rcb_000001', 0);

-- --------------------------------------------------------

--
-- Table structure for table `rincian_biaya`
--

CREATE TABLE `rincian_biaya` (
  `no_rincian` varchar(100) NOT NULL,
  `nama_rincian` varchar(100) NOT NULL,
  `transaksi_utama` varchar(100) NOT NULL,
  `harga_rincian` int(100) NOT NULL,
  `delete` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rincian_biaya`
--

INSERT INTO `rincian_biaya` (`no_rincian`, `nama_rincian`, `transaksi_utama`, `harga_rincian`, `delete`) VALUES
('Rcb_000001', 'Formulir Pendaftaran', 'pendaftaran', 200000, 0),
('Rcb_000002', 'Biaya Perlengkepan Pertahun', 'pendaftaran', 7000000, 1),
('Rcb_000003', 'Biaya perbulan pertama', 'pendaftaran', 800000, 0),
('Rcb_000004', 'Biaya Tambahan', 'pendaftaran', 375000, 0),
('Rcb_000005', 'Biaya Buku', 'daftar_ulang', 1800000, 0),
('Rcb_000006', 'KBM Lapangan', 'daftar_ulang', 2000000, 0),
('Rcb_000007', 'Biaya Kesehatan', 'daftar_ulang', 500000, 0);

-- --------------------------------------------------------

--
-- Table structure for table `siswa`
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
-- Dumping data for table `siswa`
--

INSERT INTO `siswa` (`no_siswa`, `tanggal_transaksi`, `nis`, `nama_siswa`, `alamat_siswa`, `no_telepon`, `jenis_kelamin`, `tanggal_lahir`, `tempat_lahir`, `nama_ayah`, `nama_ibu`, `no_telepon_ortu`, `delete`, `status_siswa`, `angkatan`) VALUES
('Ssw_000001', '2020-07-14', '700033890', 'Kamaliah Rahma Nureka', 'Jl. Jendral Sudirman, no 7. Batam', '', 'Perempuan', '2014-03-22', 'Batam', 'Hendarman Putra', 'Rania', '082127618976', 0, 'Siswa', 5),
('Ssw_000002', '2020-07-14', '670003782', 'Arriel Ahmadeuz Khrisna', 'Bandung Kidul, Rt.07/03, Bandung, Jawa Barat', '', 'Perempuan', '2014-07-22', 'Bali', 'Rido Herlambang', 'Diana Marishka', '085624316775', 0, 'Siswa', 5),
('Ssw_000003', '2020-07-14', '337330271', 'Yashinta Nurul Islamiyah', 'Buah Batu, komplek PBB 2 no C2, cikoneng, Jawa Bar', '', 'Perempuan', '2014-06-14', 'Bekasi', 'Dimas Antonio', 'Bima', '087654679980', 0, 'Siswa', 5),
('Ssw_000004', '2020-07-14', '568902121', 'Donadio ', 'Dayeuh Kolot, Bandung, Jawa Barat', '', 'Perempuan', '2014-08-13', 'Pontianak', 'Bayu Tirta Agni', 'Zevaana Ardhina', '085261789918', 0, 'Siswa', 5),
('Ssw_000009', '2020-07-15', '675855432', 'Amanda Widya', 'Batununggal Indah No. 4', '', 'Perempuan', '2014-11-05', 'Bogor', 'Budi', 'Cici', '084415789090', 0, 'Siswa', 5),
('Ssw_000010', '2020-07-15', '665754321', 'Cici ', 'Gorontalo', '', 'Perempuan', '2014-06-07', 'Cihampelas Indah', 'Sutono', 'Lili', '081891198291', 0, 'Siswa', 5),
('Ssw_000011', '2020-07-15', '123458997', 'Agni Bayu Tirta', 'Cianjur Kulon, no 70', '', 'Perempuan', '2014-10-16', 'Bandung', 'Kemal', 'Luna Lilly', '089667833541', 0, 'Siswa', 5),
('Ssw_000012', '2020-07-15', '726551419', 'Juniarta Saputra', 'Ciater', '', 'Perempuan', '2013-06-17', 'Pelaihari', 'Budiarto', 'Siani', '086745643112', 0, 'Siswa', 5),
('Ssw_000013', '2020-07-15', '769036771', 'Tamiya Gustriani P', 'Jl. Jambi No.70 blok A', '', 'Perempuan', '2014-07-09', 'Jambi', 'Handarto', 'Tiara', '082126286199', 0, 'Siswa', 5),
('Ssw_000014', '2020-07-15', '780987658', 'Izzura', 'Bandung', '', 'Perempuan', '2014-02-05', 'Pemalang', 'Budiarto', 'Rima', '082256789976', 0, 'Siswa', 5),
('Ssw_000015', '2020-07-28', '10000', 'Akuaja', 'banten', '', 'Perempuan', '2020-06-30', 'PLH', 'Ridho', 'Rania', '089899', 0, 'Siswa', 5),
('Ssw_000016', '2020-07-28', '1090', 'Loan', 'Bandung', '', 'Perempuan', '2020-06-02', 'Cihampelas Indah', 'Ridho', 'Rania', '090909', 0, 'Siswa', 5);

-- --------------------------------------------------------

--
-- Table structure for table `spp`
--

CREATE TABLE `spp` (
  `no_transaksi` varchar(25) NOT NULL,
  `no_siswa` varchar(25) NOT NULL,
  `biaya_spp` double NOT NULL,
  `keterangan` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `spp`
--

INSERT INTO `spp` (`no_transaksi`, `no_siswa`, `biaya_spp`, `keterangan`) VALUES
('SPP_000001', 'Ssw_000010', 800000, 'July');

-- --------------------------------------------------------

--
-- Table structure for table `tahun_ajaran`
--

CREATE TABLE `tahun_ajaran` (
  `no` int(11) NOT NULL,
  `nama_ajaran` varchar(100) NOT NULL,
  `harga_ajaran` varchar(100) NOT NULL,
  `delete` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tahun_ajaran`
--

INSERT INTO `tahun_ajaran` (`no`, `nama_ajaran`, `harga_ajaran`, `delete`) VALUES
(5, '2020', '800000', 0),
(7, '2021', '900000', 0);

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `no_transaksi` varchar(25) NOT NULL,
  `no_user` varchar(25) NOT NULL,
  `nama_transaksi` varchar(25) NOT NULL,
  `tanggal_transaksi` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`no_transaksi`, `no_user`, `nama_transaksi`, `tanggal_transaksi`) VALUES
('Dfu_000001', 'tata usaha', 'daftar ulang', '2020-07-15'),
('Dfu_000002', 'tata usaha', 'daftar ulang', '2020-07-15'),
('Dfu_000003', 'tata usaha', 'daftar ulang', '20-07-28 12:15:27'),
('Dfu_000004', 'tata usaha', 'daftar ulang', '20-07-28 - 12:17:28'),
('Dfu_000005', 'tata usaha', 'daftar ulang', '28 July 2020 - 12:18:58'),
('Dfu_000006', 'tata usaha', 'daftar ulang', '28 July 2020 - 12:19:52'),
('Dfu_000007', 'tata usaha', 'daftar ulang', '28 July 2020 - 12:21:13'),
('Npd_000001', 'tata usaha', 'pendaftaran', '2020-07-15'),
('Npd_000002', 'tata usaha', 'pendaftaran', '2020-07-15'),
('Npd_000003', 'bagian operasional', 'pendaftaran', '2020-07-15'),
('Npd_000004', 'bagian operasional', 'pendaftaran', '2020-07-15'),
('Npd_000005', 'bagian operasional', 'pendaftaran', '2020-07-28'),
('Npd_000006', 'bagian operasional', 'pendaftaran', '2020-07-28'),
('Pdll_000001', 'tata usaha', 'pendapatan lain-lain', '2020-07-15');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `no_user` varchar(25) NOT NULL,
  `username` varchar(25) NOT NULL,
  `jabatan` varchar(25) NOT NULL,
  `password` varchar(25) NOT NULL,
  `delete` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
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
-- Indexes for table `akun`
--
ALTER TABLE `akun`
  ADD PRIMARY KEY (`no_akun`);

--
-- Indexes for table `aset`
--
ALTER TABLE `aset`
  ADD PRIMARY KEY (`no_aset`);

--
-- Indexes for table `beban_beban`
--
ALTER TABLE `beban_beban`
  ADD PRIMARY KEY (`no_beban`);

--
-- Indexes for table `daftar_ulang`
--
ALTER TABLE `daftar_ulang`
  ADD KEY `no_transaksi` (`no_transaksi`,`no_siswa`),
  ADD KEY `no_siswa` (`no_siswa`);

--
-- Indexes for table `detail_pembayaran`
--
ALTER TABLE `detail_pembayaran`
  ADD PRIMARY KEY (`no`);

--
-- Indexes for table `jurnal`
--
ALTER TABLE `jurnal`
  ADD PRIMARY KEY (`no_jurnal`),
  ADD KEY `no_transaksi` (`no_transaksi`,`no_akun`),
  ADD KEY `no_akun` (`no_akun`),
  ADD KEY `no_transaksi_2` (`no_transaksi`),
  ADD KEY `no_akun_2` (`no_akun`);

--
-- Indexes for table `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`no_kelas`);

--
-- Indexes for table `master_pendapatan`
--
ALTER TABLE `master_pendapatan`
  ADD PRIMARY KEY (`no_pendapatan`);

--
-- Indexes for table `master_pengeluaran`
--
ALTER TABLE `master_pengeluaran`
  ADD PRIMARY KEY (`no_pengeluaran`);

--
-- Indexes for table `pegawai`
--
ALTER TABLE `pegawai`
  ADD PRIMARY KEY (`no_pegawai`);

--
-- Indexes for table `pembayaran_beban`
--
ALTER TABLE `pembayaran_beban`
  ADD KEY `no_transaksi` (`no_transaksi`,`no_beban`),
  ADD KEY `no_beban` (`no_beban`),
  ADD KEY `no_transaksi_2` (`no_transaksi`);

--
-- Indexes for table `pendaftaran`
--
ALTER TABLE `pendaftaran`
  ADD KEY `no_transaksi` (`no_transaksi`,`no_siswa`),
  ADD KEY `no_siswa` (`no_siswa`);

--
-- Indexes for table `pendapatan`
--
ALTER TABLE `pendapatan`
  ADD KEY `no_transaksi` (`no_transaksi`);

--
-- Indexes for table `pendapatan_lain_lain`
--
ALTER TABLE `pendapatan_lain_lain`
  ADD KEY `no_transaksi` (`no_transaksi`,`no_pendapatan`),
  ADD KEY `no_siswa` (`no_pendapatan`);

--
-- Indexes for table `potongan_biaya`
--
ALTER TABLE `potongan_biaya`
  ADD PRIMARY KEY (`no_potongan`);

--
-- Indexes for table `rincian_biaya`
--
ALTER TABLE `rincian_biaya`
  ADD PRIMARY KEY (`no_rincian`);

--
-- Indexes for table `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`no_siswa`);

--
-- Indexes for table `spp`
--
ALTER TABLE `spp`
  ADD PRIMARY KEY (`no_transaksi`);

--
-- Indexes for table `tahun_ajaran`
--
ALTER TABLE `tahun_ajaran`
  ADD PRIMARY KEY (`no`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`no_transaksi`),
  ADD KEY `no_user` (`no_user`),
  ADD KEY `no_user_2` (`no_user`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`no_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `detail_pembayaran`
--
ALTER TABLE `detail_pembayaran`
  MODIFY `no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `jurnal`
--
ALTER TABLE `jurnal`
  MODIFY `no_jurnal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `kelas`
--
ALTER TABLE `kelas`
  MODIFY `no_kelas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `potongan_biaya`
--
ALTER TABLE `potongan_biaya`
  MODIFY `no_potongan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tahun_ajaran`
--
ALTER TABLE `tahun_ajaran`
  MODIFY `no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `daftar_ulang`
--
ALTER TABLE `daftar_ulang`
  ADD CONSTRAINT `daftar_ulang_ibfk_1` FOREIGN KEY (`no_transaksi`) REFERENCES `transaksi` (`no_transaksi`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `daftar_ulang_ibfk_2` FOREIGN KEY (`no_siswa`) REFERENCES `siswa` (`no_siswa`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `jurnal`
--
ALTER TABLE `jurnal`
  ADD CONSTRAINT `jurnal_ibfk_1` FOREIGN KEY (`no_transaksi`) REFERENCES `transaksi` (`no_transaksi`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `jurnal_ibfk_2` FOREIGN KEY (`no_akun`) REFERENCES `akun` (`no_akun`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pendaftaran`
--
ALTER TABLE `pendaftaran`
  ADD CONSTRAINT `pendaftaran_ibfk_1` FOREIGN KEY (`no_transaksi`) REFERENCES `transaksi` (`no_transaksi`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pendaftaran_ibfk_2` FOREIGN KEY (`no_siswa`) REFERENCES `siswa` (`no_siswa`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
