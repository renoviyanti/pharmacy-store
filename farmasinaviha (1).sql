-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 17, 2019 at 06:45 PM
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
-- Database: `farmasinaviha`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id_admin`, `username`, `password`, `nama_lengkap`) VALUES
(1, 'viya', 'viya', 'rejeki'),
(2, 'hani', 'hani', 'haniifah'),
(3, 'nada', 'nada', 'qathrunnada');

-- --------------------------------------------------------

--
-- Table structure for table `obat`
--

CREATE TABLE `obat` (
  `id_obat` int(11) NOT NULL,
  `nama_obat` varchar(100) NOT NULL,
  `harga_obat` int(11) NOT NULL,
  `deskripsi_obat` varchar(100) NOT NULL,
  `jenis_obat` varchar(100) NOT NULL,
  `foto_obat` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `obat`
--

INSERT INTO `obat` (`id_obat`, `nama_obat`, `harga_obat`, `deskripsi_obat`, `jenis_obat`, `foto_obat`) VALUES
(1, 'paracetamol', 10000, 'untuk panas', 'generik', 'paracetamol.jpg'),
(2, 'panadol', 6000, 'untuk pusing', 'generik', 'panadol.jpg'),
(3, 'amoxilin', 5000, 'pereda sakit', 'generik', 'amoxilin.jpg'),
(4, 'antangin', 3000, 'untuk masuk angin', 'gatau', 'antangin.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `ongkir`
--

CREATE TABLE `ongkir` (
  `id_ongkir` int(11) NOT NULL,
  `nama_kota` varchar(100) NOT NULL,
  `tarif` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ongkir`
--

INSERT INTO `ongkir` (`id_ongkir`, `nama_kota`, `tarif`) VALUES
(1, 'Surabaya', 7000),
(2, 'Sidoarjo', 7000);

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id_plg` int(100) NOT NULL,
  `email_plg` varchar(100) NOT NULL,
  `password_plg` varchar(100) NOT NULL,
  `nama_plg` varchar(100) NOT NULL,
  `alamat_plg` varchar(100) NOT NULL,
  `kota_plg` varchar(15) NOT NULL,
  `provinsi_plg` varchar(15) NOT NULL,
  `kodepos_plg` varchar(10) NOT NULL,
  `telp_plg` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pelanggan`
--

INSERT INTO `pelanggan` (`id_plg`, `email_plg`, `password_plg`, `nama_plg`, `alamat_plg`, `kota_plg`, `provinsi_plg`, `kodepos_plg`, `telp_plg`) VALUES
(1, 'rejeki@gmail.com', 'rejeki', 'rejeki', 'barata', 'surabaya', 'jawa timur', '60284', '083831492259'),
(2, 'hani@gmail.com', 'hani', 'haniifah', 'kemiri', 'sidoarjo', 'jawa timur', '60278', '086543722289');

-- --------------------------------------------------------

--
-- Table structure for table `pembelian`
--

CREATE TABLE `pembelian` (
  `id_pembelian` int(11) NOT NULL,
  `id_plg` int(11) NOT NULL,
  `id_ongkir` int(11) NOT NULL,
  `tanggal_pembelian` date NOT NULL,
  `total_pembelian` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pembelian`
--

INSERT INTO `pembelian` (`id_pembelian`, `id_plg`, `id_ongkir`, `tanggal_pembelian`, `total_pembelian`) VALUES
(1, 1, 1, '2019-05-17', 17000),
(2, 1, 1, '2019-05-17', 17000),
(3, 1, 1, '2019-05-17', 17000),
(4, 1, 0, '2019-05-17', 6000),
(5, 1, 1, '2019-05-17', 27000),
(6, 1, 1, '2019-05-17', 18000),
(7, 1, 1, '2019-05-17', 17000),
(8, 1, 1, '2019-05-17', 17000),
(9, 1, 1, '2019-05-17', 20000),
(10, 1, 2, '2019-05-17', 17000);

-- --------------------------------------------------------

--
-- Table structure for table `pembelian_obat`
--

CREATE TABLE `pembelian_obat` (
  `id_pembelian_obat` int(11) NOT NULL,
  `id_pembelian` int(11) NOT NULL,
  `id_obat` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `harga` int(100) NOT NULL,
  `subharga` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pembelian_obat`
--

INSERT INTO `pembelian_obat` (`id_pembelian_obat`, `id_pembelian`, `id_obat`, `jumlah`, `nama`, `harga`, `subharga`) VALUES
(1, 1, 1, 1, '', 0, 0),
(2, 2, 1, 1, '', 0, 0),
(3, 3, 1, 1, '', 0, 0),
(4, 4, 2, 1, '', 0, 0),
(5, 0, 1, 2, '', 0, 0),
(6, 6, 3, 1, '', 0, 0),
(7, 6, 2, 1, '', 0, 0),
(8, 7, 1, 1, '', 0, 0),
(9, 8, 1, 1, '', 0, 0),
(10, 9, 1, 1, '', 0, 0),
(11, 9, 4, 1, '', 0, 0),
(12, 10, 1, 1, '', 0, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `obat`
--
ALTER TABLE `obat`
  ADD PRIMARY KEY (`id_obat`);

--
-- Indexes for table `ongkir`
--
ALTER TABLE `ongkir`
  ADD PRIMARY KEY (`id_ongkir`);

--
-- Indexes for table `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`id_plg`);

--
-- Indexes for table `pembelian`
--
ALTER TABLE `pembelian`
  ADD PRIMARY KEY (`id_pembelian`);

--
-- Indexes for table `pembelian_obat`
--
ALTER TABLE `pembelian_obat`
  ADD PRIMARY KEY (`id_pembelian_obat`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `obat`
--
ALTER TABLE `obat`
  MODIFY `id_obat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `ongkir`
--
ALTER TABLE `ongkir`
  MODIFY `id_ongkir` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `id_plg` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `pembelian`
--
ALTER TABLE `pembelian`
  MODIFY `id_pembelian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `pembelian_obat`
--
ALTER TABLE `pembelian_obat`
  MODIFY `id_pembelian_obat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
