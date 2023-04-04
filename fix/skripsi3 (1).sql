-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 07, 2022 at 06:38 PM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `skripsi3`
--

-- --------------------------------------------------------

--
-- Table structure for table `dosen`
--

CREATE TABLE `dosen` (
  `id` int(11) NOT NULL,
  `nip` varchar(20) NOT NULL,
  `username` varchar(15) DEFAULT NULL,
  `nama` varchar(255) NOT NULL,
  `role` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dosen`
--

INSERT INTO `dosen` (`id`, `nip`, `username`, `nama`, `role`) VALUES
(1, '14001', 'hnpalit', 'HENRY NOVIANUS PALIT, S.Kom., M.Kom., Ph.D.', 3),
(2, '85009', 'djoni.hs', 'Ir. DJONI HARYADI SETIABUDI, M.Eng.', 3),
(3, '98031', 'justin', 'JUSTINUS ANDJARWIRAWAN, S.T.,M.Eng.', 2),
(4, '01036', 'agust', 'AGUSTINUS NOERTJAHYANA, S.Kom., M.MT.', 2),
(5, '03023', 'leow', 'LEO WILLYANTO SANTOSO, S.Kom., M.IT.', 2),
(6, '00016', 'handojo', 'ANDREAS HANDOJO, S.T., M.MT.', 2),
(7, '99015', 'rudya', 'RUDY ADIPRANATA, S.T, M.Eng.', 2),
(8, '88004', 'kgunadi', 'Ir. KARTIKA GUNADI, M.T.', 2),
(9, '04021', 'alexander', 'ALEXANDER SETIAWAN, S.Kom., M.T.', 2),
(10, '91024', NULL, 'Ir. RESMANA LIM, M.Eng.', 2),
(11, '01043', 'silvia', 'SILVIA ROSTIANINGSIH, S.Kom., M.MT.', 2),
(12, '03024', 'lilian', 'LILIANA, S.T., M.Eng., Ph.D.', 2),
(13, '02002', NULL, 'Dr.Ing. INDAR SUGIARTO, S.T., M.Sc.', 2),
(14, '21011', 'hans.juwiantho', 'HANS JUWIANTHO, S.Kom., M.Kom.', 2),
(15, '92008', 'rintan', 'Prof. Dr.(H.C.) Ir. ROLLY INTAN, M.A.Sc., Dr.Eng.', 2),
(16, '45297', 'andre.gunawan', 'ANDRE GUNAWAN, S.Kom.', 2),
(17, '99036', 'yulia', 'YULIA, S.T., M.Kom.', 2),
(18, '98057', NULL, 'TANTI OCTAVIA, S.T., M.Eng.', 2),
(19, '45201', 'alvin.nathaniel', 'ALVIN NATHANIEL TJONDROWIGUNO, S.Kom.', 2),
(20, '98011', 'lily', 'LILY PUSPA DEWI, S.T., M.Kom.', 2),
(21, '45145', 'anita.nathania', 'ANITA NATHANIA PURBOWO, S.KOM.,M.MT.', 2),
(22, '93026', 'ananda', 'STEPHANUS A. ANANDA, S.T., M.Sc. Ph.D.', 2),
(23, '02030', 'greg', 'Dr. GREGORIUS SATIA BUDHI, S.T., M.T.', 2),
(24, '20004', 'krisnaw', 'KRISNA WAHYUDI, S.Kom., M.T.', 2);

-- --------------------------------------------------------

--
-- Table structure for table `jabatan`
--

CREATE TABLE `jabatan` (
  `id` int(11) NOT NULL,
  `jabatan` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `jabatan`
--

INSERT INTO `jabatan` (`id`, `jabatan`) VALUES
(1, 'Ketua'),
(2, 'Anggota'),
(3, 'Pembimbing');

-- --------------------------------------------------------

--
-- Table structure for table `jurusan`
--

CREATE TABLE `jurusan` (
  `id` int(11) NOT NULL,
  `jurusan` varchar(75) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `jurusan`
--

INSERT INTO `jurusan` (`id`, `jurusan`) VALUES
(1, 'Informatika'),
(2, 'Sistem Informasi Bisnis'),
(3, 'Data Science and Analytics');

-- --------------------------------------------------------

--
-- Table structure for table `kehadiran`
--

CREATE TABLE `kehadiran` (
  `id` int(11) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kehadiran`
--

INSERT INTO `kehadiran` (`id`, `status`) VALUES
(1, 'Hadir'),
(2, 'Tidak Hadir'),
(3, 'Sakit'),
(4, 'Izin');

-- --------------------------------------------------------

--
-- Table structure for table `kriteria_penilaian`
--

CREATE TABLE `kriteria_penilaian` (
  `id` int(11) NOT NULL,
  `kategori` varchar(75) NOT NULL,
  `cpl` varchar(10) NOT NULL,
  `ik` varchar(10) NOT NULL,
  `deskripsi_ik` varchar(355) NOT NULL,
  `bab_penilaian` varchar(50) NOT NULL,
  `penilaian` varchar(600) NOT NULL,
  `bobot_penilaian` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kriteria_penilaian`
--

INSERT INTO `kriteria_penilaian` (`id`, `kategori`, `cpl`, `ik`, `deskripsi_ik`, `bab_penilaian`, `penilaian`, `bobot_penilaian`) VALUES
(1, 'Umum', 'CPL 9', '9', 'Menganalisis data secara logis, kritis, sistematis, dan inovatif', 'JUDUL dan ABSTRAK dan BAB 1-2', 'Memenuhi 3 kriteria metode, tujuan, obyek, dapat menyebutkan yang mana masing2. abstrak berisi  rangkuman problem, solusi dan kesimpulan', '0.05'),
(2, 'Umum', 'CPL 9', '9', 'Menganalisis data secara logis, kritis, sistematis, dan inovatif', 'BAB 1-2', 'Latar belakang berisi detail problem, review singkat solusi dari peneliti sebelumnya, apa yang dikerjakan di skripsi ini; perumusan masalah berisi hipotesis; ruang lingkup selain apa yang dikerjakan, rencana pengujian terkait perumusan masalah; tinjauan p', '0.01'),
(3, 'Informatika', 'CPL 4', '4', 'Mengkonstruksi algoritma dan/atau program yang efektif untuk menyelesaikan masalah', 'BAB 3 dan BAB 4', 'Infor : studi kelayakan, pengamatan awal, analisa masalah, kerangka pemikiran. penjabaran solusi yang diusulkan dan penjelasan mengapa solusi tersebut dianggap dapat menyelesaikan masalah. Bagaimana mengatur TIK pendukung sehingga mencapai tujuan skripsi', '0.25'),
(4, 'Sistem Informasi Bisnis', 'CPL 7', '7', 'Membangun sistem informasi atau aplikasi bisnis untuk mendukung tercapainya tujuan organisasi', 'BAB 3 dan BAB 4', 'SIB : studi kelayakan, pengamatan awal, analisa masalah, kerangka pemikiran. Rancangan solusi dalam bentuk desain. Kesesuaian desain dengan kebutuhan proses bisnis yang nyata.', '0.25'),
(5, 'Data Science and Analytics', 'CPL 8', '8', 'Memastikan penyimpanan, pengamanan, dan penemuan kembali data kajian saintifik, serta memanfaatkannya dalam laporan saintifik', 'BAB 3 dan BAB 4', 'DSA : studi kelayakan, pengamatan awal, analisa masalah, kerangka pemikiran. Bagaimana proses pengumpulan data, mengorganisasinya serta menganalisa sedemikian rupa sehingga menjadi informasi yang bermanfaat.', '0.25'),
(6, 'Umum', 'CPL 9', '9', 'Menganalisis data secara logis, kritis, sistematis, dan inovatif', 'BUKU', 'Penulisan buku laporan yang runut dan lengkap. Tata bahasa baku dengan gaya bahasa laporan ilmiah. Sejauh mana daftar pustaka sudah dicek bahwa semua item benar2 dikutip di bab2 sebelumnya, bukan sekedar cara penulisannya sudah benar', '0.10'),
(7, 'Umum', 'CPL 8', '8', 'Menganalisis data secara logis, kritis, sistematis, dan inovatif', 'BAB 5 dan KESIMPULAN', '- merancang pengujian (bab 5). apakah langkah-langkah pengujian sistem serta hasil pengujian telah dijabarkan secara jelas lengkap (bilamana perlu dilengkapi dengan grafik, tabel, pembuktian. apakah langkah-langkah implementasi sistem telah dijabarkan secara jelas lengkap (bilamana perlu dilengkapi dengan gambar). apakah ada discussion dari hasil pengujian, mengenai analisis ketercapaian perumusan masalah, kendala dsb\r\n- sejauh mana ada kesimpulan yang menjawab perumusan masalah, dan bukan sekedar menyimpulkan bahwa program yang dibuat sudah dapat berfungsi dan bukan menjelaskan desain', '0.25'),
(8, 'Umum', 'CPL 5', '5', 'Menentukan metodologi pengembangan perangkat lunak yang sesuai konteks keadaan dan kebutuhan', 'PROGRAM', 'efisiensi program, kesesuaian program dengan rumus/ protocol/ alur bisnis? Apakah rancangan program sudah sesuai teori? Flowchart jelas dan detil? Efisiensi desain DFD/ ERD/ UML', '0.25');

-- --------------------------------------------------------

--
-- Table structure for table `mahasiswa`
--

CREATE TABLE `mahasiswa` (
  `id` int(11) NOT NULL,
  `tahun_ajaran` varchar(50) NOT NULL,
  `semester` varchar(50) NOT NULL,
  `nrp` varchar(10) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `id_jurusan` int(2) DEFAULT NULL,
  `tanggal_skripsi` datetime NOT NULL,
  `judul_skripsi` varchar(255) NOT NULL,
  `ruangan_skripsi` varchar(75) NOT NULL,
  `status` int(11) DEFAULT NULL,
  `nilaiAkhir` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mahasiswa`
--

INSERT INTO `mahasiswa` (`id`, `tahun_ajaran`, `semester`, `nrp`, `nama`, `id_jurusan`, `tanggal_skripsi`, `judul_skripsi`, `ruangan_skripsi`, `status`, `nilaiAkhir`) VALUES
(1, '2022/2023', 'Semester Gasal ', '26414062', 'WILSON MARK', 1, '2022-06-28 10:00:00', 'Game RPG Berbasis Android untuk Mendorong Pengguna Berolahraga.', 'SI', 1, 87),
(2, '2022/2023', 'Semester Gasal ', '26416073', 'JASON ALDRIAN', 2, '2022-06-15 10:00:00', 'Sistem Pakar Diagnosa Kerusakan Pada Mobil Menggunakan Metode Forward Chaining dan Certainty Factor', 'JK', 1, 29),
(3, '2022/2023', 'Semester Gasal ', '26416077', 'R. AGASTYA ARDHITAPUTERA RAMADHAN', 3, '2022-06-30 10:00:00', 'Pengamatan IP Cycling Untuk Memastikan Keamanan VPN Diukur Menggunakan GRC Fingerprints Dan DNSLeakTest', 'SI', NULL, 0),
(4, '2022/2023', 'Semester Gasal ', '26416138', 'RESCKY MARTHEN MAILOA', 1, '2022-06-22 07:30:00', 'Deteksi Rompi dan Helm Keselamatan Menggunakan Metode YOLO dan CNN.', 'R1', 1, 0),
(5, '2022/2023', 'Semester Gasal ', 'C14170021', 'NOUCHKA INDRA DEWA', 1, '2022-06-20 10:00:00', 'Program penyimpanan password menggunakan metode honey encryption pada android', 'SI', 1, 0),
(6, '2022/2023', 'Semester Gasal ', 'C14170042', 'EVELYN', 1, '2022-06-15 07:30:00', 'Sistem Presensi Mahasiswa menggunakan Face-recognition dengan metode Facenet pada Android', 'SI', NULL, 0),
(7, '2022/2023', 'Semester Gasal ', 'C14170099', 'LIYYIN PUTRA ARIF WICAKSANA', 2, '2022-06-24 13:00:00', 'Aplikasi Monitoring Pada Tanaman Aglaonema menggunakan IOT', 'JK', NULL, 0),
(8, '2022/2023', 'Semester Gasal ', 'C14170110', 'KEVIN SHAQUILLE LIMANUEL', 2, '2022-06-21 13:00:00', 'Sistem Pakar Diagnosa Penyakit pada Anjing Menggunakan Metode Forward Chaining dan Certainty Factor', 'R2', NULL, 0),
(9, '2022/2023', 'Semester Gasal ', 'C14170115', 'STEPHEN CORNELIUS HERTANTO', 3, '2022-06-21 10:00:00', 'Form Evaluasi Online mata kuliah LEAP, Pra skripsi, dan Skripsi Berbasis Android', 'R2', NULL, 0),
(10, '2022/2023', 'Semester Gasal ', 'C14170140', 'WINSTON CHAMORA', 3, '2022-06-28 07:30:00', 'Menentukan Kondisi Kartu Koleksi Pokemon menggunakan Computer Vision', 'SI', NULL, 0),
(11, '2022/2023', 'Semester Gasal ', 'C14170150', 'KEVIN PRAMANA PONGMASAK', 2, '2022-06-20 07:30:00', 'Aplikasi Sistem Pengontrolan Turtle Tub Untuk Pemeliharaan Kura-Kura Red Belly Nelsoni Dengan Arduino', 'R1', NULL, 0),
(12, '2022/2023', 'Semester Gasal ', 'C14170153', 'LEONARDO YURION TUNGRIBALI', 2, '2022-06-20 07:30:00', 'Pengawasan Jalur Kapal dengan Automatic Identification System (AIS) Berbasis Android', 'SI', NULL, 0),
(13, '2022/2023', 'Semester Gasal ', 'C14180001', 'MISAEL RITHE SETIO', 1, '2022-06-21 10:00:00', 'Sistem Informasi dan Rekomendasi Kegiatan Kemahasiswaan Universitas menggunakan Content-Based Filtering pada Web App RE*ACH sebagai Pusat Informasi Kegiatan Kemahasiswaan Universitas untuk Mahasiswa', 'SI', NULL, 0),
(14, '2022/2023', 'Semester Gasal ', 'C14180003', 'AUGUST BERLIN TUNGKA', 1, '2022-06-28 07:30:00', 'Sistem Registrasi dan Identifikasi Wajah untuk Akses Fasilitas Universitas Kristen Petra dengan Kombinasi Facenet dan Hierarchical Navigable Small Worlds', 'JK', NULL, 0),
(15, '2022/2023', 'Semester Gasal ', 'C14180006', 'TOMY WIDJAJA', 1, '2022-06-14 13:00:00', 'Deteksi Plagiarisme pada Kode Bahasa Java menggunakan Gradient Boosted Decision Tree', 'STUDIO', NULL, 0),
(16, '2022/2023', 'Semester Gasal ', 'C14180007', 'MELISSA MARVELLA', 2, '2022-06-27 13:00:00', 'Sales Management Support and Analytics untuk Meningkatkan Koordinasi Pekerja dan Pelayanan Pembeli UD. XYZ', 'SI', NULL, 0),
(17, '2022/2023', 'Semester Gasal ', 'C14180008', 'LIENNY FERLINDA', 2, '2022-06-27 07:30:00', 'Algoritma Goal Programming untuk Driver Assignment pada Simulasi Taksi Online', 'JK', NULL, 85),
(18, '2022/2023', 'Semester Gasal ', 'C14180011', 'CRISTINE FERLLY WIYANTO', 3, '2022-06-15 13:00:00', 'Penerapan Linguistic Inquiry and Word Count dan Random Forest dalam Klasifikasi Personality Berdasarkan Data Posting Twitter sehingga Dapat Ditentukan Gaya Belajar yang Sesuai', 'JK', NULL, 45),
(19, '2022/2023', 'Semester Gasal ', 'C14180019', 'WIDYA ARDITANTI', 3, '2022-06-27 10:00:00', 'Penerapan Artificial Neural Network dan Rule Based Classifier untuk Mengklasifikasikan Pendonor Darah Potensial pada Sistem Broadcast Pendonor', 'SI', NULL, 0),
(20, '2022/2023', 'Semester Gasal ', 'C14180021', 'GAVRIEL EMMANUEL VICTORIOUS', 3, '2022-06-21 13:00:00', 'Prototype Website Monitoring Parameter Energi Listrik pada Gedung A, B, C, D amp I di UK Petra', 'SI', NULL, 0),
(21, '2022/2023', 'Semester Gasal ', 'C14180025', 'STIENLEY NAGATA CAHYADY', 3, '2022-06-24 07:30:00', 'Sistem Otomasi Rute Picking Order Pada Gudang dengan Metode Simulated Annealing.', 'SI', NULL, 0),
(22, '2022/2023', 'Semester Gasal ', 'C14180027', 'MELVIN SOEHARTO', 3, '2022-06-15 13:00:00', 'Implementasi Metode Multiplicative Decomposition untuk Prediksi Penjualan Produk Manufaktur dalam Meningkatkan Pertumbuhan Bisnis pada Perusahaan Air Mineral PT. XYZ', 'SI', NULL, 0),
(23, '2022/2023', 'Semester Gasal ', 'C14180029', 'ANDREW FIRMAN SAPUTRA', 2, '2022-06-16 13:00:00', 'Penerapan Deep Learning Model Adaptive Sparse Transformer untuk Meningkatkan ROUGE-1 score pada Text Summarization dari Bagian Introduction Jurnal Ilmiah Berbahasa Inggris.', 'SI', NULL, 0),
(24, '2022/2023', 'Semester Gasal ', 'C14180030', 'KENNY NUGRAHA', 2, '2022-06-16 07:30:00', 'Aplikasi Channel Management dan Point of Sales pada Perusahaan Retail PT. XYZ dengan menggunakan metode Cross-Channel dan Market Basket Analysis', 'STUDIO', NULL, 0),
(25, '2022/2023', 'Semester Gasal ', 'C14180031', 'WILLIAM SEAN WIYOGO', 2, '2022-06-15 13:00:00', 'Penerapan metode hand gesture recognition dalam melakukan kontrol terhadap aplikasi powerpoint dan media player untuk kebutuhan hybrid conference', 'STUDIO', NULL, 0),
(26, '2022/2023', 'Semester Gasal ', 'C14180032', 'KEVIN ANGKA WIJAYA', 1, '2022-06-29 10:00:00', 'Aplikasi Self Management untuk Mengatur Jadwal Kegiatan dengan Speech to Text menggunakan Google API Berbasis Android', 'SI', NULL, 0),
(27, '2022/2023', 'Semester Gasal ', 'C14180033', 'MARCEL SLAMET SUGIANTO', 2, '2022-06-22 07:30:00', 'Aplikasi Penerjemah Kegiatan Seminar Menjadi Video Bahasa Isyarat BISINDO Dengan Speech To Text', 'SI', NULL, 0),
(28, '2022/2023', 'Semester Gasal ', 'C14180034', 'DION ALEXANDER LOUIS', 1, '2022-06-15 10:00:00', 'Implementasi Text Summarization pada Review aplikasi Super di Google Play Store menggunakan metode Maximum Marginal Relevance', 'SI', 1, 0),
(29, '2022/2023', 'Semester Gasal ', 'C14180036', 'NADIA FELICIA WINANDA', 1, '2022-06-24 13:00:00', 'Rancang Bangun Aplikasi Panggil Tukang Berbasis Android di Kota Surabaya', 'SI', NULL, 0),
(30, '2022/2023', 'Semester Gasal ', 'C14180040', 'PHILIPS NOGO RAHARJO', 2, '2022-06-24 13:00:00', 'Sistem Rekomendasi Content Based Filtering Pekerjaan dan Tenaga Kerja Potensial menggunakan Cosine Similarity', 'STUDIO', NULL, 0),
(31, '2022/2023', 'Semester Gasal ', 'C14180044', 'GERRY STEVEN', 1, '2022-06-17 07:30:00', 'Penerapan 3D Human Pose Estimation Indoor Area untuk Motion Capture dengan Menggunakan YOLOv4-tiny, EfficientNet Simple Baseline, dan VideoPose3D.', 'jk', NULL, 0),
(32, '2022/2023', 'Semester Gasal ', 'C14180046', 'GREGORIUS NICHOLAS GOENAWAN', 2, '2022-06-20 13:00:00', 'Pengenalan Rambu Lalu Lintas di Indonesia Secara Real Time Menggunakan YOLOv4-tiny', 'JK', NULL, 0),
(33, '2022/2023', 'Semester Gasal ', 'C14180048', 'ERIC SAPUTRA LAYS', 2, '2022-06-24 07:30:00', 'Verikasi Wajah di Kartu Identitas menggunakan metode Feature Matching', 'JK', NULL, 0),
(34, '2022/2023', 'Semester Gasal ', 'C14180050', 'TANIA SUNYOTO', 3, '2022-06-22 13:00:00', 'Penerapan Ensemble Learning untuk Meningkatkan Akurasi Sentiment Analysis pada Review Aplikasi Google Play', 'R1', NULL, 0),
(35, '2022/2023', 'Semester Gasal ', 'C14180055', 'GABRIELA CONSUELO HERIYANTO', 2, '2022-06-23 10:00:00', 'Prediksi Kebutuhan Darah Menggunakan Metode ARIMA dengan Mempertimbangkan Faktor Deterioration Untuk Memberikan Rekomendasi Prioritas Jadwal Donor Darah', 'SI', NULL, 0),
(36, '2022/2023', 'Semester Gasal ', 'C14180057', 'GREGORIUS KEVIN KUMALA', 1, '2022-06-24 10:00:00', 'Penerapan Object Detection dengan Menggunakan YoloV4 untuk Mendeteksi Kendaraan di Jalan Raya', 'JK', NULL, 0),
(37, '2022/2023', 'Semester Gasal ', 'C14180059', 'DANIEL HARTONO', 1, '2022-06-14 13:00:00', 'Sistem Pendukung Keputusan Pemberian Kredit berdasarkan Klasifikasi Kelancaran Pembayaran Kredit Menggunakan Metode VIKOR pada Bank XYZnbsp', 'SI', NULL, 0),
(38, '2022/2023', 'Semester Gasal ', 'C14180063', 'REGAN REINALDO KALENDESANG', 1, '2022-06-28 13:00:00', 'Pewarnaan dan Shading Otomatis Sketsa Gambar Menggunakan Metode Conditional - GAN', 'SI', NULL, 0),
(39, '2022/2023', 'Semester Gasal ', 'C14180064', 'CHRISTOFFEL CLEON TANOYO', 1, '2022-06-15 10:00:00', 'Penerapan Metode Tensor Context Similarity Singular Value Decomposition untuk Permasalahan Cold Start dalam Sistem Rekomendasi Automatic Playlist Continuation', 'STUDIO', NULL, 0),
(40, '2022/2023', 'Semester Gasal ', 'C14180065', 'GABRIEL ADISURYA HARSONO', 1, '2022-06-22 13:00:00', 'Prediksi Harga Saham yang Bersifat Siklikal di Indonesia Menggunakan Metode LSTM', 'JK', NULL, 0),
(41, '2022/2023', 'Semester Gasal ', 'C14180066', 'ABRAHAM IMANUEL', 2, '2022-06-14 07:30:00', 'Penerapan Convolutional Neural Network dengan Pre-Trained Model Xception untuk Meningkatkan Akurasi dalam Mengidentifikasi Jenis Ras Kucing', 'SI', NULL, 29),
(42, '2022/2023', 'Semester Gasal ', 'C14180070', 'SHEEREN HENDRIK ANGGELA', 3, '2022-06-29 07:30:00', 'Sistem Rekomendasi Laptop dengan metode collaborative filtering', 'R1', NULL, 0),
(43, '2022/2023', 'Semester Gasal ', 'C14180071', 'JASON', 3, '2022-06-15 07:30:00', 'Sistem Optimalisasi Rute Model Capacitated Vehicle Routing Problem with Time Windows Menggunakan Algoritma Metaheuristic Particle Swarm Optimization pada Perusahaan Kantong Plastik HDPE PT XYZ', 'JK', NULL, 0),
(44, '2022/2023', 'Semester Gasal ', 'C14180078', 'KEVIN REYNALDI TANJUNG', 2, '2022-06-22 10:00:00', 'Classifikasi sampah organik dan anorganik dengan metode YoloV3 dan Resnet50', 'JK', NULL, 0),
(45, '2022/2023', 'Semester Gasal ', 'C14180081', 'ALDO KURNIA CHRISTIANTO', 2, '2022-06-23 13:00:00', 'Aplikasi Sistem Pendukung Keputusan Metode TOPSIS dan AHP-TOPSIS untuk Pemilihan Proyek pada Perusahaan Kontraktor CV.X', 'JK', NULL, 0),
(46, '2022/2023', 'Semester Gasal ', 'C14180086', 'KEVIN GIOVANNI', 2, '2022-06-30 07:30:00', 'Sistem Chatbot dengan Metode Naive Bayes untuk Mengotomatisasi Tanggapan Pesan Mahasiswa tentang Pra Skripsi', 'SI', NULL, 0),
(47, '2022/2023', 'Semester Gasal ', 'C14180090', 'JOSIA CHRISTIAN', 2, '2022-06-16 13:00:00', 'Aplikasi Sistem Pendukung Keputusan Perekrutan Karyawan berdasarkan Hasil Tes Rekrutmen dengan Metode Fuzzy AHP dan Profile Matching pada Konsultan Manajemen SDM CV X', 'STUDIO', NULL, 0),
(48, '2022/2023', 'Semester Gasal ', 'C14180091', 'DJUVAN PRANOTO', 1, '2022-06-14 13:00:00', 'Aplikasi War Game Pada Mobile Device Menggunakan Sensor Gyroscope dan Accelerometer', 'JK', NULL, 29),
(49, '2022/2023', 'Semester Gasal ', 'C14180093', 'KEVIN JONATHAN', 1, '2022-06-23 10:00:00', 'Sistem Tracking, Estimasi Perjalanan dan Analisis Kualitas Layanan Shuttle Bus UK Petra menggunakan Mobile Application', 'JK', NULL, 0),
(50, '2022/2023', 'Semester Gasal ', 'C14180099', 'FERONICA NATALIA RIVALDI', 1, '2022-06-21 07:30:00', 'Sales Management dan Pengukuran Key Performance Indicator dengan menggunakan metode C4.5 pada CV.X', 'R1', NULL, 0),
(51, '2022/2023', 'Semester Gasal ', 'C14180100', 'EDWARD MANHATTAN PRASETIO', NULL, '2022-06-21 07:30:00', 'Sistem Suggestion dengan Metode TOPSIS untuk Meningkatkan Keberhasilan Serious Game Greenlife Town', 'SI', NULL, 0),
(52, '2022/2023', 'Semester Gasal ', 'C14180101', 'CHRISTIANTO IMANUEL ARYANTO', NULL, '2022-06-16 13:00:00', 'Prediksi Peringkat Mingguan Lagu Pada Spotify Amerika Serikat Menggunakan Multiple Charts Dataset Dengan Berbagai Metode', 'JK', NULL, 0),
(53, '2022/2023', 'Semester Gasal ', 'C14180102', 'JORDAN NAGAKUSUMA', NULL, '2022-06-30 13:00:00', 'Prediksi Penjualan pada Data Penjualan Perusahaan X dengan Membandingkan Metode GRU, SVR dan SARIMAX', 'SI', NULL, 0),
(54, '2022/2023', 'Semester Gasal ', 'C14180104', 'ANDRIANTO SAPUTRA LINARDI LIE', NULL, '2022-06-24 07:30:00', 'Analisis sentimen dari keywords yang dimasukan pengguna di twitter Indonesia untuk penunjang pembelajaran strategi komunikasi di Program Studi ilmu komunikasi Universitas Kristen Petra dengan metode CNN-Bidirectional LSTM', 'STUDIO', NULL, 0),
(55, '2022/2023', 'Semester Gasal ', 'C14180106', 'JESSICA CLARENSIA SUKO', NULL, '2022-06-23 07:30:00', 'Pengurangan Sampah Makanan dalam Bisnis Kuliner Menggunakan Konsep E-Marketplace pada Aplikasi Mobile', 'SI', NULL, 0),
(56, '2022/2023', 'Semester Gasal ', 'C14180107', 'RICHARD ANDREW SANTOSO', NULL, '2022-06-17 07:30:00', 'Aplikasi Forecasting Pada Data Penjualan Perusahaan Minuman Siap Saji XYZ dengan Metode ARIMA', 'STUDIO', NULL, 0),
(57, '2022/2023', 'Semester Gasal ', 'C14180111', 'JEREMY JOEL MARLIM', NULL, '2022-06-28 10:00:00', 'Peningkatan Akurasi Context Aware - Collaborative Filtering Terhadap Sparse Data Dengan Menggunakan Implicit Data', 'JK', NULL, 0),
(58, '2022/2023', 'Semester Gasal ', 'C14180119', 'MARIA EVE ANGELINE', NULL, '2022-06-21 07:30:00', 'Sistem Pakar untuk Mendiagnosa Kerusakan pada Sepeda Motor Kawasaki KLX 150 Menggunakan Metode Forward Chaining dan Certainty Factor', 'R2', NULL, 0),
(59, '2022/2023', 'Semester Gasal ', 'C14180126', 'BRYAN STEVANUS HARTONO', NULL, '2022-06-14 10:00:00', 'Sistem Informasi Pembelian dan Penjualan dengan Laporan Laba Rugi dan HPP untuk Apotek X', 'SI', NULL, 0),
(60, '2022/2023', 'Semester Gasal ', 'C14180133', 'CALVIN CHRISTOPHER KURNIAWAN', NULL, '2022-06-16 07:30:00', 'Penerapan Metode KNN-Regresi dan Multiplicative Decomposition untuk Prediksi Data Penjualan pada Supermarket X', 'SI', NULL, 0),
(61, '2022/2023', 'Semester Gasal ', 'C14180135', 'CYNTHIA WIJAYA', NULL, '2022-06-29 13:00:00', 'Aplikasi Mobile Learning untuk Meningkatkan Interaksi Pembelajaran dalam Mendukung Penyerapan Materi Pembinaan UMKM oleh LPPM Universitas Kristen Petra dengan Menerapkan Model Learning Group', 'SI', NULL, 0),
(62, '2022/2023', 'Semester Gasal ', 'C14180138', 'MICHAEL YOHANES WICAKSONO', NULL, '2022-06-17 07:30:00', 'Sistem Tracking Pengiriman Barang Pada PT. Afro Angkasa Express Dengan Menggunakan Framework Laravel 8', 'SI', NULL, 0),
(63, '2022/2023', 'Semester Gasal ', 'C14180143', 'ALVIN PUTRA WONG', NULL, '2022-06-16 10:00:00', 'Pengembangan Sistem Human Resource Development Berbasis Web untuk PT. Deus Digital Transformasi Universal Dengan Metode Analytical Hierarchy Process', 'SI', NULL, 0),
(64, '2022/2023', 'Semester Gasal ', 'C14180144', 'MATIUS BRYANT', NULL, '2022-06-27 13:00:00', 'Monitoring Kadar Amonia dalam Akuarium Ikan menggunakan Metode Verifikasi Warna RGB dengan memanfaatkan ESP32-CAM', 'JK', NULL, 0),
(65, '2022/2023', 'Semester Gasal ', 'C14180152', 'YANSEN TRI UTOMO', NULL, '2022-06-23 07:30:00', 'Aplikasi Marketplace vendor Lamaran dan Pernikahan berbasis Android', 'R2', NULL, 0),
(66, '2022/2023', 'Semester Gasal ', 'C14180157', 'VIONA ANGELICA', NULL, '2022-06-23 07:30:00', 'Order Fulfillment pada Taksi Online dengan Mempertimbangkan Prioritas Menggunakan Metode RFM untuk Meningkatkan Pelayanan pada Pelanggan Setia', 'R1', NULL, 0),
(67, '2022/2023', 'Semester Gasal ', 'C14180169', 'RICHARD HANS KRISNAJANA', NULL, '2022-06-20 07:30:00', 'Pencarian Rute Terpendek dalam Lingkungan Universitas Kristen Petra Surabaya menggunakan Algoritma D* Lite', 'JK', NULL, 0),
(68, '2022/2023', 'Semester Gasal ', 'C14180171', 'RICKY CHANDRA', NULL, '2022-06-22 07:30:00', 'Aplikasi Sentiment Analysis Terhadap Trend Cryptocurrency pada Platform Twitter Menggunakan Library TextBlob Sebagai Alat Bantu Berinvestasi.', 'R2', NULL, 0),
(69, '2022/2023', 'Semester Gasal ', 'C14180175', 'MICHAEL ALEXANDER RUSTAN', NULL, '2022-06-22 13:00:00', 'Penyuaraan Pesan Teks Media Sosial pada Perangkat Mobile Menggunakan text To Speech', 'SI', NULL, 0),
(70, '2022/2023', 'Semester Gasal ', 'C14180195', 'HENDY GUNAWAN', NULL, '2022-06-21 10:00:00', 'Penerapan Machine Learning dalam mendeteksi Fake Account pada Instagram', 'R1', NULL, 0),
(71, '2022/2023', 'Semester Gasal ', 'C14180210', 'CYNTHIA BUDIONO', NULL, '2022-06-20 13:00:00', 'Aplikasi Sistem Informasi Praktikum pada Program Studi Informatika Universitas Kristen Petra Berbasis Website', 'R1', NULL, 0),
(72, '2022/2023', 'Semester Gasal ', 'C14180211', 'YOSHUA REFO', NULL, '2022-06-16 10:00:00', 'Penerapan SVM untuk Klasifikasi Sentimen Pada Review Comment Berbahasa Indonesia di Online Shop', 'STUDIO', NULL, 0),
(73, '2022/2023', 'Semester Gasal ', 'C14180217', 'LOIS FERNANDO AUDI', NULL, '2022-06-29 07:30:00', 'Pembuatan Aplikasi Lelang Berbasis Android', 'SI', NULL, 0),
(74, '2022/2023', 'Semester Gasal ', 'C14180221', 'KATHERINE PUTRI SUTJIADI', NULL, '2022-06-28 13:00:00', 'Aplikasi Omni-channel untuk Pengaturan Multi-channel Order Management di Toko Kyuuden', 'R1', NULL, 0),
(75, '2022/2023', 'Semester Gasal ', 'C14180222', 'WILLIAM EVAN BUDIAWAN', NULL, '2022-06-22 10:00:00', 'IMPLEMENTASI FRAMEWORK SCRUM PADA APLIKASI PROJECT MANAGEMENT PT. RUTAN BERBASIS MOBILE', 'SI', NULL, 0),
(76, '2022/2023', 'Semester Gasal ', 'C14180224', 'MICHAEL JONATHAN', NULL, '2022-06-14 07:30:00', 'Pengaruh Feature Selection terhadap Kinerja C5.0, XGBoost, dan Random Forest dalam Mengklasifikasikan Website Phishing', 'JK', NULL, 0),
(77, '2022/2023', 'Semester Gasal ', 'C14180226', 'HANSEN GUNAWAN SULISTIO', NULL, '2022-06-16 10:00:00', 'Aspect-based Sentiment Analysis pada ulasan E-commerce dengan metode Support Vector Machine untuk mendapatkan informasi sentimen dari beberapa aspek', 'JK', NULL, 0),
(78, '2022/2023', 'Semester Gasal ', 'C14180236', 'MICHELLE CHRISTIANA CHANDRA', NULL, '2022-06-23 13:00:00', 'Sistem Registrasi, Reservasi, dan Identifikasi Penumpang Shuttle Bus UK Petra menggunakan Mobile Application', 'SI', NULL, 0),
(79, '2022/2023', 'Semester Gasal ', 'C14180248', 'NALOM AHOLIAB SINAGA', NULL, '2022-06-21 13:00:00', 'Sistem Deteksi Reputasi Akun Seller pada Steam Community Menggunakan Metode Klasifikasi Support Vector Machine.', 'R1', NULL, 0),
(80, '2022/2023', 'Semester Gasal ', 'C14180254', 'JENNIFER SOERYAWINATA', NULL, '2022-06-29 10:00:00', 'Sales Forecasting pada Dealer Motor X dengan ARIMA, LSTM, Hybrid Model ARIMA-LSTM', 'R1', NULL, 0),
(81, '2022/2023', 'Semester Gasal ', 'C14180256', 'JESHEN OKTAVIAN NATHANEL', NULL, '2022-06-27 10:00:00', 'Klasifikasi Kisaran Harga Tarif Endorsement Influencer Instagram dengan Metode Decision Tree', 'R1', NULL, 0),
(82, '2022/2023', 'Semester Gasal ', 'C14180257', 'SATRIA ADI NUGRAHA', NULL, '2022-06-16 07:30:00', 'Aplikasi Analisa Sentimen Bilingual dan Emoji pada Komentar Media Sosial Instagram Menggunakan Metode Support Vector Machine', 'JK', NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `penguji`
--

CREATE TABLE `penguji` (
  `id` int(11) NOT NULL,
  `id_mahasiswa` int(3) NOT NULL,
  `id_dosen` int(11) NOT NULL,
  `id_jabatan` int(2) NOT NULL,
  `id_kehadiran` int(1) DEFAULT NULL,
  `tanggal_hadir` date DEFAULT NULL,
  `nilaiAkhir` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `penguji`
--

INSERT INTO `penguji` (`id`, `id_mahasiswa`, `id_dosen`, `id_jabatan`, `id_kehadiran`, `tanggal_hadir`, `nilaiAkhir`) VALUES
(1, 1, 9, 1, 1, NULL, 0),
(2, 1, 6, 2, 1, NULL, 0),
(3, 1, 1, 3, 1, NULL, 0),
(4, 1, 2, 3, 1, NULL, 0),
(5, 2, 22, 1, 1, NULL, 0),
(6, 2, 23, 2, 2, NULL, 0),
(7, 2, 2, 3, 4, NULL, 0),
(8, 3, 22, 1, NULL, NULL, 0),
(9, 3, 6, 2, NULL, NULL, 0),
(10, 3, 3, 3, NULL, NULL, 0),
(11, 3, 4, 3, NULL, NULL, 0),
(12, 4, 14, 1, 3, NULL, 0),
(13, 4, 1, 2, 1, NULL, 0),
(14, 4, 5, 3, 4, NULL, 0),
(15, 5, 5, 1, 1, NULL, 0),
(16, 5, 9, 2, 1, NULL, 0),
(17, 5, 4, 3, 1, NULL, 0),
(18, 5, 6, 3, 1, NULL, 0),
(19, 6, 3, 1, NULL, NULL, 0),
(20, 6, 5, 2, NULL, NULL, 0),
(21, 6, 7, 3, NULL, NULL, 0),
(22, 6, 8, 3, NULL, NULL, 0),
(23, 7, 5, 1, NULL, NULL, 0),
(24, 7, 13, 2, NULL, NULL, 0),
(25, 7, 9, 3, NULL, NULL, 0),
(26, 7, 10, 3, NULL, NULL, 0),
(27, 8, 8, 1, NULL, NULL, 0),
(28, 8, 16, 2, NULL, NULL, 0),
(29, 8, 5, 3, NULL, NULL, 0),
(30, 8, 11, 3, NULL, NULL, 0),
(31, 9, 9, 1, NULL, NULL, 0),
(32, 9, 22, 2, NULL, NULL, 0),
(33, 9, 11, 3, NULL, NULL, 0),
(34, 9, 12, 3, NULL, NULL, 0),
(35, 10, 6, 1, NULL, NULL, 0),
(36, 10, 8, 2, NULL, NULL, 0),
(37, 10, 5, 3, NULL, NULL, 0),
(38, 10, 2, 3, NULL, NULL, 0),
(39, 11, 22, 1, NULL, NULL, 0),
(40, 11, 1, 2, NULL, NULL, 0),
(41, 11, 11, 3, NULL, NULL, 0),
(42, 11, 13, 3, NULL, NULL, 0),
(43, 12, 12, 1, NULL, NULL, 0),
(44, 12, 14, 2, NULL, NULL, 0),
(45, 12, 3, 3, NULL, NULL, 0),
(46, 13, 5, 1, NULL, NULL, 0),
(47, 13, 15, 2, NULL, NULL, 0),
(48, 13, 1, 3, NULL, NULL, 0),
(49, 13, 14, 3, NULL, NULL, 0),
(50, 14, 23, 1, NULL, NULL, 0),
(51, 14, 22, 2, NULL, NULL, 0),
(52, 14, 12, 3, NULL, NULL, 0),
(53, 14, 15, 3, NULL, NULL, 0),
(54, 15, 8, 1, NULL, NULL, 0),
(55, 15, 19, 2, NULL, NULL, 0),
(56, 15, 12, 3, NULL, NULL, 0),
(57, 15, 16, 3, NULL, NULL, 0),
(58, 16, 20, 1, NULL, NULL, 0),
(59, 16, 6, 2, NULL, NULL, 0),
(60, 16, 5, 3, NULL, NULL, 0),
(61, 16, 17, 3, NULL, NULL, 0),
(62, 17, 1, 1, NULL, NULL, 0),
(63, 17, 6, 2, NULL, NULL, 0),
(64, 17, 18, 3, NULL, NULL, 0),
(65, 18, 2, 1, NULL, NULL, 0),
(66, 18, 16, 2, NULL, NULL, 0),
(67, 18, 1, 3, NULL, NULL, 0),
(68, 18, 19, 3, NULL, NULL, 0),
(69, 19, 1, 1, NULL, NULL, 0),
(70, 19, 6, 3, NULL, NULL, 0),
(71, 19, 18, 3, NULL, NULL, 0),
(72, 20, 22, 1, NULL, NULL, 0),
(73, 20, 3, 2, NULL, NULL, 0),
(74, 20, 20, 3, NULL, NULL, 0),
(75, 20, 10, 3, NULL, NULL, 0),
(76, 21, 5, 1, NULL, NULL, 0),
(77, 21, 6, 3, NULL, NULL, 0),
(78, 21, 18, 3, NULL, NULL, 0),
(79, 22, 20, 1, NULL, NULL, 0),
(80, 22, 23, 2, NULL, NULL, 0),
(81, 22, 11, 3, NULL, NULL, 0),
(82, 22, 5, 3, NULL, NULL, 0),
(83, 23, 14, 1, NULL, NULL, 0),
(84, 23, 8, 2, NULL, NULL, 0),
(85, 23, 12, 3, NULL, NULL, 0),
(86, 23, 2, 3, NULL, NULL, 0),
(87, 24, 23, 1, NULL, NULL, 0),
(88, 24, 16, 2, NULL, NULL, 0),
(89, 24, 6, 3, NULL, NULL, 0),
(90, 24, 9, 3, NULL, NULL, 0),
(91, 25, 3, 1, NULL, NULL, 0),
(92, 25, 22, 2, NULL, NULL, 0),
(93, 25, 12, 3, NULL, NULL, 0),
(94, 26, 4, 1, NULL, NULL, 0),
(95, 26, 16, 2, NULL, NULL, 0),
(96, 26, 3, 3, NULL, NULL, 0),
(97, 26, 20, 3, NULL, NULL, 0),
(98, 27, 8, 1, NULL, NULL, 0),
(99, 27, 15, 2, NULL, NULL, 0),
(100, 27, 12, 3, NULL, NULL, 0),
(101, 27, 21, 3, NULL, NULL, 0),
(102, 28, 20, 1, 1, NULL, 0),
(103, 28, 12, 2, 1, NULL, 0),
(104, 28, 11, 3, 1, NULL, 0),
(105, 28, 5, 3, 2, NULL, 0),
(106, 29, 8, 1, NULL, NULL, 0),
(107, 29, 16, 2, NULL, NULL, 0),
(108, 29, 4, 3, NULL, NULL, 0),
(109, 29, 20, 3, NULL, NULL, 0),
(110, 30, 12, 1, NULL, NULL, 0),
(111, 30, 19, 2, NULL, NULL, 0),
(112, 30, 6, 3, NULL, NULL, 0),
(113, 30, 14, 3, NULL, NULL, 0),
(114, 31, 3, 1, NULL, NULL, 0),
(115, 31, 19, 2, NULL, NULL, 0),
(116, 31, 12, 3, NULL, NULL, 0),
(117, 31, 21, 3, NULL, NULL, 0),
(118, 32, 8, 1, NULL, NULL, 0),
(119, 32, 23, 2, NULL, NULL, 0),
(120, 32, 12, 3, NULL, NULL, 0),
(121, 32, 19, 3, NULL, NULL, 0),
(122, 33, 12, 1, NULL, NULL, 0),
(123, 33, 15, 2, NULL, NULL, 0),
(124, 33, 7, 3, NULL, NULL, 0),
(125, 33, 8, 3, NULL, NULL, 0),
(126, 34, 1, 1, NULL, NULL, 0),
(127, 34, 23, 2, NULL, NULL, 0),
(128, 34, 2, 3, NULL, NULL, 0),
(129, 34, 19, 3, NULL, NULL, 0),
(130, 35, 23, 1, NULL, NULL, 0),
(131, 35, 16, 2, NULL, NULL, 0),
(132, 35, 6, 3, NULL, NULL, 0),
(133, 35, 18, 3, NULL, NULL, 0),
(134, 36, 4, 1, NULL, NULL, 0),
(135, 36, 12, 2, NULL, NULL, 0),
(136, 36, 2, 3, NULL, NULL, 0),
(137, 36, 13, 3, NULL, NULL, 0),
(138, 37, 9, 1, NULL, NULL, 0),
(139, 37, 22, 2, NULL, NULL, 0),
(140, 37, 5, 3, NULL, NULL, 0),
(141, 37, 11, 3, NULL, NULL, 0),
(142, 38, 8, 1, NULL, NULL, 0),
(143, 38, 15, 2, NULL, NULL, 0),
(144, 38, 12, 3, NULL, NULL, 0),
(145, 38, 2, 3, NULL, NULL, 0),
(146, 39, 6, 1, NULL, NULL, 0),
(147, 39, 19, 2, NULL, NULL, 0),
(148, 39, 1, 3, NULL, NULL, 0),
(149, 39, 16, 3, NULL, NULL, 0),
(150, 40, 17, 1, NULL, NULL, 0),
(151, 40, 8, 2, NULL, NULL, 0),
(152, 40, 9, 3, NULL, NULL, 0),
(153, 40, 14, 3, NULL, NULL, 0),
(154, 41, 8, 1, NULL, NULL, 0),
(155, 41, 19, 2, NULL, NULL, 0),
(156, 41, 2, 3, NULL, NULL, 0),
(157, 42, 20, 1, NULL, NULL, 0),
(158, 42, 15, 2, NULL, NULL, 0),
(159, 42, 5, 3, NULL, NULL, 0),
(160, 42, 3, 3, NULL, NULL, 0),
(161, 43, 22, 1, NULL, NULL, 0),
(162, 43, 23, 2, NULL, NULL, 0),
(163, 43, 11, 3, NULL, NULL, 0),
(164, 43, 6, 3, NULL, NULL, 0),
(165, 44, 23, 1, NULL, NULL, 0),
(166, 44, 22, 2, NULL, NULL, 0),
(167, 44, 12, 3, NULL, NULL, 0),
(168, 44, 14, 3, NULL, NULL, 0),
(169, 45, 23, 1, NULL, NULL, 0),
(170, 45, 19, 2, NULL, NULL, 0),
(171, 45, 9, 3, NULL, NULL, 0),
(172, 45, 6, 3, NULL, NULL, 0),
(173, 46, 12, 1, NULL, NULL, 0),
(174, 46, 2, 2, NULL, NULL, 0),
(175, 46, 1, 3, NULL, NULL, 0),
(176, 46, 22, 3, NULL, NULL, 0),
(177, 47, 6, 1, NULL, NULL, 0),
(178, 47, 9, 2, NULL, NULL, 0),
(179, 47, 11, 3, NULL, NULL, 0),
(180, 47, 17, 3, NULL, NULL, 0),
(181, 48, 14, 1, NULL, NULL, 0),
(182, 48, 2, 2, NULL, NULL, 0),
(183, 48, 6, 3, NULL, NULL, 0),
(184, 48, 23, 3, NULL, NULL, 0),
(185, 49, 4, 1, NULL, NULL, 0),
(186, 49, 1, 2, NULL, NULL, 0),
(187, 49, 15, 3, NULL, NULL, 0),
(188, 49, 12, 3, NULL, NULL, 0),
(189, 50, 20, 1, NULL, NULL, 0),
(190, 50, 9, 2, NULL, NULL, 0),
(191, 50, 11, 3, NULL, NULL, 0),
(192, 50, 17, 3, NULL, NULL, 0),
(193, 51, 12, 1, NULL, NULL, 0),
(194, 51, 19, 2, NULL, NULL, 0),
(195, 51, 23, 3, NULL, NULL, 0),
(196, 51, 14, 3, NULL, NULL, 0),
(197, 52, 5, 1, NULL, NULL, 0),
(198, 52, 20, 2, NULL, NULL, 0),
(199, 52, 1, 3, NULL, NULL, 0),
(200, 52, 16, 3, NULL, NULL, 0),
(201, 53, 9, 1, NULL, NULL, 0),
(202, 53, 18, 2, NULL, NULL, 0),
(203, 53, 1, 3, NULL, NULL, 0),
(204, 53, 14, 3, NULL, NULL, 0),
(205, 54, 9, 1, NULL, NULL, 0),
(206, 54, 19, 2, NULL, NULL, 0),
(207, 54, 2, 3, NULL, NULL, 0),
(208, 54, 13, 3, NULL, NULL, 0),
(209, 55, 4, 1, NULL, NULL, 0),
(210, 55, 8, 2, NULL, NULL, 0),
(211, 55, 2, 3, NULL, NULL, 0),
(212, 55, 3, 3, NULL, NULL, 0),
(213, 56, 2, 1, NULL, NULL, 0),
(214, 56, 23, 2, NULL, NULL, 0),
(215, 56, 11, 3, NULL, NULL, 0),
(216, 56, 5, 3, NULL, NULL, 0),
(217, 57, 12, 1, NULL, NULL, 0),
(218, 57, 22, 2, NULL, NULL, 0),
(219, 57, 15, 3, NULL, NULL, 0),
(220, 57, 16, 3, NULL, NULL, 0),
(221, 58, 5, 1, NULL, NULL, 0),
(222, 58, 15, 2, NULL, NULL, 0),
(223, 58, 2, 3, NULL, NULL, 0),
(224, 58, 8, 3, NULL, NULL, 0),
(225, 59, 9, 1, NULL, NULL, 0),
(226, 59, 19, 2, NULL, NULL, 0),
(227, 59, 11, 3, NULL, NULL, 0),
(228, 60, 8, 1, NULL, NULL, 0),
(229, 60, 19, 2, NULL, NULL, 0),
(230, 60, 11, 3, NULL, NULL, 0),
(231, 60, 5, 3, NULL, NULL, 0),
(232, 61, 1, 1, NULL, NULL, 0),
(233, 61, 20, 2, NULL, NULL, 0),
(234, 61, 2, 3, NULL, NULL, 0),
(235, 61, 3, 3, NULL, NULL, 0),
(236, 62, 22, 1, NULL, NULL, 0),
(237, 62, 16, 2, NULL, NULL, 0),
(238, 62, 9, 3, NULL, NULL, 0),
(239, 62, 8, 3, NULL, NULL, 0),
(240, 63, 17, 1, NULL, NULL, 0),
(241, 63, 5, 2, NULL, NULL, 0),
(242, 63, 9, 3, NULL, NULL, 0),
(243, 63, 20, 3, NULL, NULL, 0),
(244, 64, 2, 1, NULL, NULL, 0),
(245, 64, 13, 2, NULL, NULL, 0),
(246, 64, 22, 3, NULL, NULL, 0),
(247, 65, 20, 1, NULL, NULL, 0),
(248, 65, 9, 2, NULL, NULL, 0),
(249, 65, 11, 3, NULL, NULL, 0),
(250, 65, 5, 3, NULL, NULL, 0),
(251, 66, 1, 1, NULL, NULL, 0),
(252, 66, 6, 3, NULL, NULL, 0),
(253, 66, 18, 3, NULL, NULL, 0),
(254, 67, 8, 1, NULL, NULL, 0),
(255, 67, 15, 2, NULL, NULL, 0),
(256, 67, 4, 3, NULL, NULL, 0),
(257, 68, 3, 1, NULL, NULL, 0),
(258, 68, 19, 2, NULL, NULL, 0),
(259, 68, 8, 3, NULL, NULL, 0),
(260, 68, 22, 3, NULL, NULL, 0),
(261, 69, 5, 1, NULL, NULL, 0),
(262, 69, 16, 2, NULL, NULL, 0),
(263, 69, 12, 3, NULL, NULL, 0),
(264, 69, 21, 3, NULL, NULL, 0),
(265, 70, 4, 1, NULL, NULL, 0),
(266, 70, 16, 2, NULL, NULL, 0),
(267, 70, 17, 3, NULL, NULL, 0),
(268, 70, 23, 3, NULL, NULL, 0),
(269, 71, 17, 1, NULL, NULL, 0),
(270, 71, 16, 2, NULL, NULL, 0),
(271, 71, 20, 3, NULL, NULL, 0),
(272, 71, 9, 3, NULL, NULL, 0),
(273, 72, 1, 1, NULL, NULL, 0),
(274, 72, 16, 2, NULL, NULL, 0),
(275, 72, 11, 3, NULL, NULL, 0),
(276, 72, 12, 3, NULL, NULL, 0),
(277, 73, 22, 1, NULL, NULL, 0),
(278, 73, 9, 2, NULL, NULL, 0),
(279, 73, 12, 3, NULL, NULL, 0),
(280, 73, 4, 3, NULL, NULL, 0),
(281, 74, 20, 1, NULL, NULL, 0),
(282, 74, 9, 2, NULL, NULL, 0),
(283, 74, 17, 3, NULL, NULL, 0),
(284, 74, 24, 3, NULL, NULL, 0),
(285, 75, 20, 1, NULL, NULL, 0),
(286, 75, 16, 2, NULL, NULL, 0),
(287, 75, 17, 3, NULL, NULL, 0),
(288, 75, 21, 3, NULL, NULL, 0),
(289, 76, 23, 1, NULL, NULL, 0),
(290, 76, 14, 2, NULL, NULL, 0),
(291, 76, 11, 3, NULL, NULL, 0),
(292, 76, 1, 3, NULL, NULL, 0),
(293, 77, 23, 1, NULL, NULL, 0),
(294, 77, 19, 2, NULL, NULL, 0),
(295, 77, 6, 3, NULL, NULL, 0),
(296, 78, 1, 1, NULL, NULL, 0),
(297, 78, 4, 2, NULL, NULL, 0),
(298, 78, 15, 3, NULL, NULL, 0),
(299, 78, 12, 3, NULL, NULL, 0),
(300, 79, 14, 1, NULL, NULL, 0),
(301, 79, 1, 2, NULL, NULL, 0),
(302, 79, 9, 3, NULL, NULL, 0),
(303, 79, 4, 3, NULL, NULL, 0),
(304, 80, 9, 1, NULL, NULL, 0),
(305, 80, 6, 2, NULL, NULL, 0),
(306, 80, 1, 3, NULL, NULL, 0),
(307, 80, 5, 3, NULL, NULL, 0),
(308, 81, 23, 1, NULL, NULL, 0),
(309, 81, 4, 2, NULL, NULL, 0),
(310, 81, 9, 3, NULL, NULL, 0),
(311, 82, 12, 1, NULL, NULL, 0),
(312, 82, 3, 2, NULL, NULL, 0),
(313, 82, 1, 3, NULL, NULL, 0),
(314, 82, 14, 3, NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `penilaian`
--

CREATE TABLE `penilaian` (
  `id` int(11) NOT NULL,
  `id_mahasiswa` int(11) NOT NULL,
  `id_penguji` int(11) NOT NULL,
  `nilaiJudul` int(3) NOT NULL,
  `nilaiBab12` int(3) NOT NULL,
  `nilaiBuku` int(3) NOT NULL,
  `nilaiKonsentrasi` int(3) NOT NULL,
  `nilaiBab5` int(3) NOT NULL,
  `nilaiProgram` int(3) NOT NULL,
  `totalNilai` decimal(3,0) NOT NULL,
  `tanggal_acc` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `penilaian`
--

INSERT INTO `penilaian` (`id`, `id_mahasiswa`, `id_penguji`, `nilaiJudul`, `nilaiBab12`, `nilaiBuku`, `nilaiKonsentrasi`, `nilaiBab5`, `nilaiProgram`, `totalNilai`, `tanggal_acc`) VALUES
(1, 1, 9, 86, 87, 83, 84, 90, 90, '87', '2022-12-05 04:43:13'),
(2, 1, 6, 80, 82, 95, 87, 91, 80, '86', '2022-12-05 04:44:55'),
(3, 1, 1, 90, 90, 80, 85, 89, 92, '88', '2022-12-05 04:41:01'),
(4, 1, 2, 85, 83, 89, 98, 88, 89, '90', '2022-12-05 04:45:56'),
(5, 2, 22, 0, 0, 0, 0, 0, 0, '0', NULL),
(6, 2, 23, 0, 0, 0, 0, 0, 0, '0', NULL),
(7, 2, 2, 90, 89, 78, 90, 90, 82, '87', '2022-12-05 05:54:37'),
(8, 3, 22, 0, 0, 0, 0, 0, 0, '0', NULL),
(9, 3, 6, 0, 0, 0, 0, 0, 0, '0', NULL),
(10, 3, 3, 0, 0, 0, 0, 0, 0, '0', NULL),
(11, 3, 4, 0, 0, 0, 0, 0, 0, '0', NULL),
(12, 4, 14, 0, 0, 0, 0, 0, 0, '0', NULL),
(13, 4, 1, 98, 83, 45, 78, 79, 88, '79', '2022-12-01 15:23:28'),
(14, 4, 5, 0, 0, 0, 0, 0, 0, '0', NULL),
(15, 5, 5, 0, 0, 0, 0, 0, 0, '0', NULL),
(16, 5, 9, 0, 0, 0, 0, 0, 0, '0', NULL),
(17, 5, 4, 0, 0, 0, 0, 0, 0, '0', NULL),
(18, 5, 6, 0, 0, 0, 0, 0, 0, '0', NULL),
(19, 6, 3, 0, 0, 0, 0, 0, 0, '0', NULL),
(20, 6, 5, 0, 0, 0, 0, 0, 0, '0', NULL),
(21, 6, 7, 0, 0, 0, 0, 0, 0, '0', NULL),
(22, 6, 8, 0, 0, 0, 0, 0, 0, '0', NULL),
(23, 7, 5, 0, 0, 0, 0, 0, 0, '0', NULL),
(24, 7, 13, 0, 0, 0, 0, 0, 0, '0', NULL),
(25, 7, 9, 0, 0, 0, 0, 0, 0, '0', NULL),
(26, 7, 10, 0, 0, 0, 0, 0, 0, '0', NULL),
(27, 8, 8, 0, 0, 0, 0, 0, 0, '0', NULL),
(28, 8, 16, 0, 0, 0, 0, 0, 0, '0', NULL),
(29, 8, 5, 0, 0, 0, 0, 0, 0, '0', NULL),
(30, 8, 11, 0, 0, 0, 0, 0, 0, '0', NULL),
(31, 9, 9, 0, 0, 0, 0, 0, 0, '0', NULL),
(32, 9, 22, 0, 0, 0, 0, 0, 0, '0', NULL),
(33, 9, 11, 0, 0, 0, 0, 0, 0, '0', NULL),
(34, 9, 12, 0, 0, 0, 0, 0, 0, '0', NULL),
(35, 10, 6, 0, 0, 0, 0, 0, 0, '0', NULL),
(36, 10, 8, 0, 0, 0, 0, 0, 0, '0', NULL),
(37, 10, 5, 0, 0, 0, 0, 0, 0, '0', NULL),
(38, 10, 2, 0, 0, 0, 0, 0, 0, '0', NULL),
(39, 11, 22, 0, 0, 0, 0, 0, 0, '0', NULL),
(40, 11, 1, 88, 89, 93, 76, 78, 89, '83', '2022-12-01 15:18:44'),
(41, 11, 11, 0, 0, 0, 0, 0, 0, '0', NULL),
(42, 11, 13, 0, 0, 0, 0, 0, 0, '0', NULL),
(43, 12, 12, 0, 0, 0, 0, 0, 0, '0', NULL),
(44, 12, 14, 0, 0, 0, 0, 0, 0, '0', NULL),
(45, 12, 3, 0, 0, 0, 0, 0, 0, '0', NULL),
(46, 13, 5, 0, 0, 0, 0, 0, 0, '0', NULL),
(47, 13, 15, 0, 0, 0, 0, 0, 0, '0', NULL),
(48, 13, 1, 78, 77, 79, 90, 98, 83, '87', '2022-12-01 15:22:23'),
(49, 13, 14, 0, 0, 0, 0, 0, 0, '0', NULL),
(50, 14, 23, 0, 0, 0, 0, 0, 0, '0', NULL),
(51, 14, 22, 0, 0, 0, 0, 0, 0, '0', NULL),
(52, 14, 12, 0, 0, 0, 0, 0, 0, '0', NULL),
(53, 14, 15, 0, 0, 0, 0, 0, 0, '0', NULL),
(54, 15, 8, 0, 0, 0, 0, 0, 0, '0', NULL),
(55, 15, 19, 0, 0, 0, 0, 0, 0, '0', NULL),
(56, 15, 12, 0, 0, 0, 0, 0, 0, '0', NULL),
(57, 15, 16, 0, 0, 0, 0, 0, 0, '0', NULL),
(58, 16, 20, 0, 0, 0, 0, 0, 0, '0', NULL),
(59, 16, 6, 0, 0, 0, 0, 0, 0, '0', NULL),
(60, 16, 5, 0, 0, 0, 0, 0, 0, '0', NULL),
(61, 16, 17, 0, 0, 0, 0, 0, 0, '0', NULL),
(62, 17, 1, 0, 0, 0, 0, 0, 0, '80', '2022-11-17 00:16:00'),
(63, 17, 6, 0, 0, 0, 0, 0, 0, '90', NULL),
(64, 17, 18, 0, 0, 0, 0, 0, 0, '85', NULL),
(65, 18, 2, 78, 67, 89, 90, 92, 94, '89', '2022-12-05 05:57:20'),
(66, 18, 16, 0, 0, 0, 0, 0, 0, '0', NULL),
(67, 18, 1, 90, 98, 77, 89, 84, 97, '90', '2022-12-01 15:17:06'),
(68, 18, 19, 0, 0, 0, 0, 0, 0, '0', NULL),
(69, 19, 1, 0, 0, 0, 0, 0, 0, '0', NULL),
(70, 19, 6, 0, 0, 0, 0, 0, 0, '0', NULL),
(71, 19, 18, 0, 0, 0, 0, 0, 0, '0', NULL),
(72, 20, 22, 0, 0, 0, 0, 0, 0, '0', NULL),
(73, 20, 3, 0, 0, 0, 0, 0, 0, '0', NULL),
(74, 20, 20, 0, 0, 0, 0, 0, 0, '0', NULL),
(75, 20, 10, 0, 0, 0, 0, 0, 0, '0', NULL),
(76, 21, 5, 0, 0, 0, 0, 0, 0, '0', NULL),
(77, 21, 6, 0, 0, 0, 0, 0, 0, '0', NULL),
(78, 21, 18, 0, 0, 0, 0, 0, 0, '0', NULL),
(79, 22, 20, 0, 0, 0, 0, 0, 0, '0', NULL),
(80, 22, 23, 0, 0, 0, 0, 0, 0, '0', NULL),
(81, 22, 11, 0, 0, 0, 0, 0, 0, '0', NULL),
(82, 22, 5, 0, 0, 0, 0, 0, 0, '0', NULL),
(83, 23, 14, 0, 0, 0, 0, 0, 0, '0', NULL),
(84, 23, 8, 0, 0, 0, 0, 0, 0, '0', NULL),
(85, 23, 12, 0, 0, 0, 0, 0, 0, '0', NULL),
(86, 23, 2, 0, 0, 0, 0, 0, 0, '0', NULL),
(87, 24, 23, 0, 0, 0, 0, 0, 0, '0', NULL),
(88, 24, 16, 0, 0, 0, 0, 0, 0, '0', NULL),
(89, 24, 6, 0, 0, 0, 0, 0, 0, '0', NULL),
(90, 24, 9, 0, 0, 0, 0, 0, 0, '0', NULL),
(91, 25, 3, 0, 0, 0, 0, 0, 0, '0', NULL),
(92, 25, 22, 0, 0, 0, 0, 0, 0, '0', NULL),
(93, 25, 12, 0, 0, 0, 0, 0, 0, '0', NULL),
(94, 26, 4, 0, 0, 0, 0, 0, 0, '0', NULL),
(95, 26, 16, 0, 0, 0, 0, 0, 0, '0', NULL),
(96, 26, 3, 0, 0, 0, 0, 0, 0, '0', NULL),
(97, 26, 20, 0, 0, 0, 0, 0, 0, '0', NULL),
(98, 27, 8, 0, 0, 0, 0, 0, 0, '0', NULL),
(99, 27, 15, 0, 0, 0, 0, 0, 0, '0', NULL),
(100, 27, 12, 0, 0, 0, 0, 0, 0, '0', NULL),
(101, 27, 21, 0, 0, 0, 0, 0, 0, '0', NULL),
(102, 28, 20, 0, 0, 0, 0, 0, 0, '0', NULL),
(103, 28, 12, 0, 0, 0, 0, 0, 0, '0', NULL),
(104, 28, 11, 0, 0, 0, 0, 0, 0, '0', NULL),
(105, 28, 5, 0, 0, 0, 0, 0, 0, '0', NULL),
(106, 29, 8, 0, 0, 0, 0, 0, 0, '0', NULL),
(107, 29, 16, 0, 0, 0, 0, 0, 0, '0', NULL),
(108, 29, 4, 0, 0, 0, 0, 0, 0, '0', NULL),
(109, 29, 20, 0, 0, 0, 0, 0, 0, '0', NULL),
(110, 30, 12, 0, 0, 0, 0, 0, 0, '0', NULL),
(111, 30, 19, 0, 0, 0, 0, 0, 0, '0', NULL),
(112, 30, 6, 0, 0, 0, 0, 0, 0, '0', NULL),
(113, 30, 14, 0, 0, 0, 0, 0, 0, '0', NULL),
(114, 31, 3, 0, 0, 0, 0, 0, 0, '0', NULL),
(115, 31, 19, 0, 0, 0, 0, 0, 0, '0', NULL),
(116, 31, 12, 0, 0, 0, 0, 0, 0, '0', NULL),
(117, 31, 21, 0, 0, 0, 0, 0, 0, '0', NULL),
(118, 32, 8, 0, 0, 0, 0, 0, 0, '0', NULL),
(119, 32, 23, 0, 0, 0, 0, 0, 0, '0', NULL),
(120, 32, 12, 0, 0, 0, 0, 0, 0, '0', NULL),
(121, 32, 19, 0, 0, 0, 0, 0, 0, '0', NULL),
(122, 33, 12, 0, 0, 0, 0, 0, 0, '0', NULL),
(123, 33, 15, 0, 0, 0, 0, 0, 0, '0', NULL),
(124, 33, 7, 0, 0, 0, 0, 0, 0, '0', NULL),
(125, 33, 8, 0, 0, 0, 0, 0, 0, '0', NULL),
(126, 34, 1, 90, 98, 92, 94, 98, 92, '95', '2022-12-01 15:25:55'),
(127, 34, 23, 0, 0, 0, 0, 0, 0, '0', NULL),
(128, 34, 2, 0, 0, 0, 0, 0, 0, '0', NULL),
(129, 34, 19, 0, 0, 0, 0, 0, 0, '0', NULL),
(130, 35, 23, 0, 0, 0, 0, 0, 0, '0', NULL),
(131, 35, 16, 0, 0, 0, 0, 0, 0, '0', NULL),
(132, 35, 6, 0, 0, 0, 0, 0, 0, '0', NULL),
(133, 35, 18, 0, 0, 0, 0, 0, 0, '0', NULL),
(134, 36, 4, 0, 0, 0, 0, 0, 0, '0', NULL),
(135, 36, 12, 0, 0, 0, 0, 0, 0, '0', NULL),
(136, 36, 2, 0, 0, 0, 0, 0, 0, '0', NULL),
(137, 36, 13, 0, 0, 0, 0, 0, 0, '0', NULL),
(138, 37, 9, 0, 0, 0, 0, 0, 0, '0', NULL),
(139, 37, 22, 0, 0, 0, 0, 0, 0, '0', NULL),
(140, 37, 5, 0, 0, 0, 0, 0, 0, '0', NULL),
(141, 37, 11, 0, 0, 0, 0, 0, 0, '0', NULL),
(142, 38, 8, 0, 0, 0, 0, 0, 0, '0', NULL),
(143, 38, 15, 0, 0, 0, 0, 0, 0, '0', NULL),
(144, 38, 12, 0, 0, 0, 0, 0, 0, '0', NULL),
(145, 38, 2, 0, 0, 0, 0, 0, 0, '0', NULL),
(146, 39, 6, 0, 0, 0, 0, 0, 0, '0', NULL),
(147, 39, 19, 0, 0, 0, 0, 0, 0, '0', NULL),
(148, 39, 1, 90, 92, 97, 93, 98, 99, '96', '2022-12-01 15:14:09'),
(149, 39, 16, 0, 0, 0, 0, 0, 0, '0', NULL),
(150, 40, 17, 0, 0, 0, 0, 0, 0, '0', NULL),
(151, 40, 8, 0, 0, 0, 0, 0, 0, '0', NULL),
(152, 40, 9, 0, 0, 0, 0, 0, 0, '0', NULL),
(153, 40, 14, 0, 0, 0, 0, 0, 0, '0', NULL),
(154, 41, 8, 0, 0, 0, 0, 0, 0, '0', NULL),
(155, 41, 19, 0, 0, 0, 0, 0, 0, '0', NULL),
(156, 41, 2, 100, 99, 78, 89, 75, 90, '86', '2022-12-05 05:46:28'),
(157, 42, 20, 0, 0, 0, 0, 0, 0, '0', NULL),
(158, 42, 15, 0, 0, 0, 0, 0, 0, '0', NULL),
(159, 42, 5, 0, 0, 0, 0, 0, 0, '0', NULL),
(160, 42, 3, 0, 0, 0, 0, 0, 0, '0', NULL),
(161, 43, 22, 0, 0, 0, 0, 0, 0, '0', NULL),
(162, 43, 23, 0, 0, 0, 0, 0, 0, '0', NULL),
(163, 43, 11, 0, 0, 0, 0, 0, 0, '0', NULL),
(164, 43, 6, 0, 0, 0, 0, 0, 0, '0', NULL),
(165, 44, 23, 0, 0, 0, 0, 0, 0, '0', NULL),
(166, 44, 22, 0, 0, 0, 0, 0, 0, '0', NULL),
(167, 44, 12, 0, 0, 0, 0, 0, 0, '0', NULL),
(168, 44, 14, 0, 0, 0, 0, 0, 0, '0', NULL),
(169, 45, 23, 0, 0, 0, 0, 0, 0, '0', NULL),
(170, 45, 19, 0, 0, 0, 0, 0, 0, '0', NULL),
(171, 45, 9, 0, 0, 0, 0, 0, 0, '0', NULL),
(172, 45, 6, 0, 0, 0, 0, 0, 0, '0', NULL),
(173, 46, 12, 0, 0, 0, 0, 0, 0, '0', NULL),
(174, 46, 2, 0, 0, 0, 0, 0, 0, '0', NULL),
(175, 46, 1, 0, 0, 0, 0, 0, 0, '0', NULL),
(176, 46, 22, 0, 0, 0, 0, 0, 0, '0', NULL),
(177, 47, 6, 0, 0, 0, 0, 0, 0, '0', NULL),
(178, 47, 9, 0, 0, 0, 0, 0, 0, '0', NULL),
(179, 47, 11, 0, 0, 0, 0, 0, 0, '0', NULL),
(180, 47, 17, 0, 0, 0, 0, 0, 0, '0', NULL),
(181, 48, 14, 0, 0, 0, 0, 0, 0, '0', NULL),
(182, 48, 2, 94, 97, 98, 80, 81, 93, '88', '2022-12-05 05:49:58'),
(183, 48, 6, 0, 0, 0, 0, 0, 0, '0', NULL),
(184, 48, 23, 0, 0, 0, 0, 0, 0, '0', NULL),
(185, 49, 4, 0, 0, 0, 0, 0, 0, '0', NULL),
(186, 49, 1, 98, 92, 94, 97, 95, 92, '95', '2022-12-01 15:28:12'),
(187, 49, 15, 0, 0, 0, 0, 0, 0, '0', NULL),
(188, 49, 12, 0, 0, 0, 0, 0, 0, '0', NULL),
(189, 50, 20, 0, 0, 0, 0, 0, 0, '0', NULL),
(190, 50, 9, 0, 0, 0, 0, 0, 0, '0', NULL),
(191, 50, 11, 0, 0, 0, 0, 0, 0, '0', NULL),
(192, 50, 17, 0, 0, 0, 0, 0, 0, '0', NULL),
(193, 51, 12, 0, 0, 0, 0, 0, 0, '0', NULL),
(194, 51, 19, 0, 0, 0, 0, 0, 0, '0', NULL),
(195, 51, 23, 0, 0, 0, 0, 0, 0, '0', NULL),
(196, 51, 14, 0, 0, 0, 0, 0, 0, '0', NULL),
(197, 52, 5, 0, 0, 0, 0, 0, 0, '0', NULL),
(198, 52, 20, 0, 0, 0, 0, 0, 0, '0', NULL),
(199, 52, 1, 0, 0, 0, 0, 0, 0, '0', NULL),
(200, 52, 16, 0, 0, 0, 0, 0, 0, '0', NULL),
(201, 53, 9, 0, 0, 0, 0, 0, 0, '0', NULL),
(202, 53, 18, 0, 0, 0, 0, 0, 0, '0', NULL),
(203, 53, 1, 0, 0, 0, 0, 0, 0, '0', NULL),
(204, 53, 14, 0, 0, 0, 0, 0, 0, '0', NULL),
(205, 54, 9, 0, 0, 0, 0, 0, 0, '0', NULL),
(206, 54, 19, 0, 0, 0, 0, 0, 0, '0', NULL),
(207, 54, 2, 0, 0, 0, 0, 0, 0, '0', NULL),
(208, 54, 13, 0, 0, 0, 0, 0, 0, '0', NULL),
(209, 55, 4, 0, 0, 0, 0, 0, 0, '0', NULL),
(210, 55, 8, 0, 0, 0, 0, 0, 0, '0', NULL),
(211, 55, 2, 0, 0, 0, 0, 0, 0, '0', NULL),
(212, 55, 3, 0, 0, 0, 0, 0, 0, '0', NULL),
(213, 56, 2, 0, 0, 0, 0, 0, 0, '0', NULL),
(214, 56, 23, 0, 0, 0, 0, 0, 0, '0', NULL),
(215, 56, 11, 0, 0, 0, 0, 0, 0, '0', NULL),
(216, 56, 5, 0, 0, 0, 0, 0, 0, '0', NULL),
(217, 57, 12, 0, 0, 0, 0, 0, 0, '0', NULL),
(218, 57, 22, 0, 0, 0, 0, 0, 0, '0', NULL),
(219, 57, 15, 0, 0, 0, 0, 0, 0, '0', NULL),
(220, 57, 16, 0, 0, 0, 0, 0, 0, '0', NULL),
(221, 58, 5, 0, 0, 0, 0, 0, 0, '0', NULL),
(222, 58, 15, 0, 0, 0, 0, 0, 0, '0', NULL),
(223, 58, 2, 0, 0, 0, 0, 0, 0, '0', NULL),
(224, 58, 8, 0, 0, 0, 0, 0, 0, '0', NULL),
(225, 59, 9, 0, 0, 0, 0, 0, 0, '0', NULL),
(226, 59, 19, 0, 0, 0, 0, 0, 0, '0', NULL),
(227, 59, 11, 0, 0, 0, 0, 0, 0, '0', NULL),
(228, 60, 8, 0, 0, 0, 0, 0, 0, '0', NULL),
(229, 60, 19, 0, 0, 0, 0, 0, 0, '0', NULL),
(230, 60, 11, 0, 0, 0, 0, 0, 0, '0', NULL),
(231, 60, 5, 0, 0, 0, 0, 0, 0, '0', NULL),
(232, 61, 1, 0, 0, 0, 0, 0, 0, '0', NULL),
(233, 61, 20, 0, 0, 0, 0, 0, 0, '0', NULL),
(234, 61, 2, 0, 0, 0, 0, 0, 0, '0', NULL),
(235, 61, 3, 0, 0, 0, 0, 0, 0, '0', NULL),
(236, 62, 22, 0, 0, 0, 0, 0, 0, '0', NULL),
(237, 62, 16, 0, 0, 0, 0, 0, 0, '0', NULL),
(238, 62, 9, 0, 0, 0, 0, 0, 0, '0', NULL),
(239, 62, 8, 0, 0, 0, 0, 0, 0, '0', NULL),
(240, 63, 17, 0, 0, 0, 0, 0, 0, '0', NULL),
(241, 63, 5, 0, 0, 0, 0, 0, 0, '0', NULL),
(242, 63, 9, 0, 0, 0, 0, 0, 0, '0', NULL),
(243, 63, 20, 0, 0, 0, 0, 0, 0, '0', NULL),
(244, 64, 2, 0, 0, 0, 0, 0, 0, '0', NULL),
(245, 64, 13, 0, 0, 0, 0, 0, 0, '0', NULL),
(246, 64, 22, 0, 0, 0, 0, 0, 0, '0', NULL),
(247, 65, 20, 0, 0, 0, 0, 0, 0, '0', NULL),
(248, 65, 9, 0, 0, 0, 0, 0, 0, '0', NULL),
(249, 65, 11, 0, 0, 0, 0, 0, 0, '0', NULL),
(250, 65, 5, 0, 0, 0, 0, 0, 0, '0', NULL),
(251, 66, 1, 0, 0, 0, 0, 0, 0, '0', NULL),
(252, 66, 6, 0, 0, 0, 0, 0, 0, '0', NULL),
(253, 66, 18, 0, 0, 0, 0, 0, 0, '0', NULL),
(254, 67, 8, 0, 0, 0, 0, 0, 0, '0', NULL),
(255, 67, 15, 0, 0, 0, 0, 0, 0, '0', NULL),
(256, 67, 4, 0, 0, 0, 0, 0, 0, '0', NULL),
(257, 68, 3, 0, 0, 0, 0, 0, 0, '0', NULL),
(258, 68, 19, 0, 0, 0, 0, 0, 0, '0', NULL),
(259, 68, 8, 0, 0, 0, 0, 0, 0, '0', NULL),
(260, 68, 22, 0, 0, 0, 0, 0, 0, '0', NULL),
(261, 69, 5, 0, 0, 0, 0, 0, 0, '0', NULL),
(262, 69, 16, 0, 0, 0, 0, 0, 0, '0', NULL),
(263, 69, 12, 0, 0, 0, 0, 0, 0, '0', NULL),
(264, 69, 21, 0, 0, 0, 0, 0, 0, '0', NULL),
(265, 70, 4, 0, 0, 0, 0, 0, 0, '0', NULL),
(266, 70, 16, 0, 0, 0, 0, 0, 0, '0', NULL),
(267, 70, 17, 0, 0, 0, 0, 0, 0, '0', NULL),
(268, 70, 23, 0, 0, 0, 0, 0, 0, '0', NULL),
(269, 71, 17, 0, 0, 0, 0, 0, 0, '0', NULL),
(270, 71, 16, 0, 0, 0, 0, 0, 0, '0', NULL),
(271, 71, 20, 0, 0, 0, 0, 0, 0, '0', NULL),
(272, 71, 9, 0, 0, 0, 0, 0, 0, '0', NULL),
(273, 72, 1, 0, 0, 0, 0, 0, 0, '0', NULL),
(274, 72, 16, 0, 0, 0, 0, 0, 0, '0', NULL),
(275, 72, 11, 0, 0, 0, 0, 0, 0, '0', NULL),
(276, 72, 12, 0, 0, 0, 0, 0, 0, '0', NULL),
(277, 73, 22, 0, 0, 0, 0, 0, 0, '0', NULL),
(278, 73, 9, 0, 0, 0, 0, 0, 0, '0', NULL),
(279, 73, 12, 0, 0, 0, 0, 0, 0, '0', NULL),
(280, 73, 4, 0, 0, 0, 0, 0, 0, '0', NULL),
(281, 74, 20, 0, 0, 0, 0, 0, 0, '0', NULL),
(282, 74, 9, 0, 0, 0, 0, 0, 0, '0', NULL),
(283, 74, 17, 0, 0, 0, 0, 0, 0, '0', NULL),
(284, 74, 24, 0, 0, 0, 0, 0, 0, '0', NULL),
(285, 75, 20, 0, 0, 0, 0, 0, 0, '0', NULL),
(286, 75, 16, 0, 0, 0, 0, 0, 0, '0', NULL),
(287, 75, 17, 0, 0, 0, 0, 0, 0, '0', NULL),
(288, 75, 21, 0, 0, 0, 0, 0, 0, '0', NULL),
(289, 76, 23, 0, 0, 0, 0, 0, 0, '0', NULL),
(290, 76, 14, 0, 0, 0, 0, 0, 0, '0', NULL),
(291, 76, 11, 0, 0, 0, 0, 0, 0, '0', NULL),
(292, 76, 1, 100, 76, 80, 90, 0, 0, '0', NULL),
(293, 77, 23, 0, 0, 0, 0, 0, 0, '0', NULL),
(294, 77, 19, 0, 0, 0, 0, 0, 0, '0', NULL),
(295, 77, 6, 0, 0, 0, 0, 0, 0, '0', NULL),
(296, 78, 1, 0, 0, 0, 0, 0, 0, '0', NULL),
(297, 78, 4, 0, 0, 0, 0, 0, 0, '0', NULL),
(298, 78, 15, 0, 0, 0, 0, 0, 0, '0', NULL),
(299, 78, 12, 0, 0, 0, 0, 0, 0, '0', NULL),
(300, 79, 14, 0, 0, 0, 0, 0, 0, '0', NULL),
(301, 79, 1, 0, 0, 0, 0, 0, 0, '0', NULL),
(302, 79, 9, 0, 0, 0, 0, 0, 0, '0', NULL),
(303, 79, 4, 0, 0, 0, 0, 0, 0, '0', NULL),
(304, 80, 9, 0, 0, 0, 0, 0, 0, '0', NULL),
(305, 80, 6, 0, 0, 0, 0, 0, 0, '0', NULL),
(306, 80, 1, 0, 0, 0, 0, 0, 0, '0', NULL),
(307, 80, 5, 0, 0, 0, 0, 0, 0, '0', NULL),
(308, 81, 23, 0, 0, 0, 0, 0, 0, '0', NULL),
(309, 81, 4, 0, 0, 0, 0, 0, 0, '0', NULL),
(310, 81, 9, 0, 0, 0, 0, 0, 0, '0', NULL),
(311, 82, 12, 0, 0, 0, 0, 0, 0, '0', NULL),
(312, 82, 3, 0, 0, 0, 0, 0, 0, '0', NULL),
(313, 82, 1, 0, 0, 0, 0, 0, 0, '0', NULL),
(314, 82, 14, 0, 0, 0, 0, 0, 0, '0', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `rekapan`
--

CREATE TABLE `rekapan` (
  `id` int(11) NOT NULL,
  `id_mahasiswa` int(11) NOT NULL,
  `id_penguji` int(11) NOT NULL,
  `status_sidang` int(11) NOT NULL,
  `konsentrasi` varchar(255) NOT NULL,
  `nilai_akhir` varchar(3) NOT NULL,
  `catatan_sidang` varchar(1000) NOT NULL,
  `tugas_tambahan` varchar(50) NOT NULL,
  `tanggal_rekap` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `rekapan`
--

INSERT INTO `rekapan` (`id`, `id_mahasiswa`, `id_penguji`, `status_sidang`, `konsentrasi`, `nilai_akhir`, `catatan_sidang`, `tugas_tambahan`, `tanggal_rekap`) VALUES
(1, 1, 9, 1, 'hahah', '', 'halo', 'Video', '2022-11-29 13:47:38'),
(2, 5, 5, 1, 'gatau', '', 'hehhe', 'Poster,Laporan Penelitian', '2022-11-29 13:49:19'),
(3, 28, 20, 1, 'hehee', '', 'hee', 'Poster,Laporan Penelitian', '2022-11-29 13:53:20'),
(4, 4, 14, 1, 'heheee', '', 'gatau', 'Video,Laporan Penelitian', '2022-11-29 15:51:11'),
(6, 2, 22, 1, '', '29', 'ddd', 'Laporan Penelitian', '2022-12-07 17:05:15');

-- --------------------------------------------------------

--
-- Table structure for table `role_website`
--

CREATE TABLE `role_website` (
  `id` int(11) NOT NULL,
  `role_website` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `role_website`
--

INSERT INTO `role_website` (`id`, `role_website`) VALUES
(1, 'Admin'),
(2, 'Dosen'),
(3, 'Koordinator');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dosen`
--
ALTER TABLE `dosen`
  ADD PRIMARY KEY (`id`),
  ADD KEY `dosen_ibfk_1` (`role`);

--
-- Indexes for table `jabatan`
--
ALTER TABLE `jabatan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jurusan`
--
ALTER TABLE `jurusan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kehadiran`
--
ALTER TABLE `kehadiran`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kriteria_penilaian`
--
ALTER TABLE `kriteria_penilaian`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_id_jurusan` (`id_jurusan`);

--
-- Indexes for table `penguji`
--
ALTER TABLE `penguji`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_jabatan` (`id_jabatan`),
  ADD KEY `id_kehadiran` (`id_kehadiran`),
  ADD KEY `id_mahasiswa` (`id_mahasiswa`),
  ADD KEY `id_dosen` (`id_dosen`);

--
-- Indexes for table `penilaian`
--
ALTER TABLE `penilaian`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_id_mahasiswa_penilaian` (`id_mahasiswa`),
  ADD KEY `FK_id_penguji_penilaian` (`id_penguji`);

--
-- Indexes for table `rekapan`
--
ALTER TABLE `rekapan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_id_mahasiswa_rekapan` (`id_mahasiswa`),
  ADD KEY `FK_id_penguji_rekapan` (`id_penguji`);

--
-- Indexes for table `role_website`
--
ALTER TABLE `role_website`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `dosen`
--
ALTER TABLE `dosen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `jabatan`
--
ALTER TABLE `jabatan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `jurusan`
--
ALTER TABLE `jurusan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `kehadiran`
--
ALTER TABLE `kehadiran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `kriteria_penilaian`
--
ALTER TABLE `kriteria_penilaian`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;

--
-- AUTO_INCREMENT for table `penguji`
--
ALTER TABLE `penguji`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=315;

--
-- AUTO_INCREMENT for table `penilaian`
--
ALTER TABLE `penilaian`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=315;

--
-- AUTO_INCREMENT for table `rekapan`
--
ALTER TABLE `rekapan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `role_website`
--
ALTER TABLE `role_website`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `dosen`
--
ALTER TABLE `dosen`
  ADD CONSTRAINT `dosen_ibfk_1` FOREIGN KEY (`role`) REFERENCES `role_website` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD CONSTRAINT `fk_id_jurusan` FOREIGN KEY (`id_jurusan`) REFERENCES `jurusan` (`id`);

--
-- Constraints for table `penguji`
--
ALTER TABLE `penguji`
  ADD CONSTRAINT `penguji_ibfk_1` FOREIGN KEY (`id_jabatan`) REFERENCES `jabatan` (`id`),
  ADD CONSTRAINT `penguji_ibfk_2` FOREIGN KEY (`id_kehadiran`) REFERENCES `kehadiran` (`id`),
  ADD CONSTRAINT `penguji_ibfk_3` FOREIGN KEY (`id_mahasiswa`) REFERENCES `mahasiswa` (`id`),
  ADD CONSTRAINT `penguji_ibfk_4` FOREIGN KEY (`id_dosen`) REFERENCES `dosen` (`id`);

--
-- Constraints for table `penilaian`
--
ALTER TABLE `penilaian`
  ADD CONSTRAINT `FK_id_mahasiswa_penilaian` FOREIGN KEY (`id_mahasiswa`) REFERENCES `mahasiswa` (`id`),
  ADD CONSTRAINT `FK_id_penguji_penilaian` FOREIGN KEY (`id_penguji`) REFERENCES `penguji` (`id`);

--
-- Constraints for table `rekapan`
--
ALTER TABLE `rekapan`
  ADD CONSTRAINT `FK_id_mahasiswa_rekapan` FOREIGN KEY (`id_mahasiswa`) REFERENCES `mahasiswa` (`id`),
  ADD CONSTRAINT `FK_id_penguji_rekapan` FOREIGN KEY (`id_penguji`) REFERENCES `penguji` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
