-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 30, 2025 at 04:39 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `copa_america`
--

-- --------------------------------------------------------

--
-- Table structure for table `posiciones`
--

CREATE TABLE `posiciones` (
  `id` int(11) NOT NULL,
  `seleccion_id` int(11) DEFAULT NULL,
  `puntos` int(11) DEFAULT NULL,
  `jugados` int(11) DEFAULT NULL,
  `ganados` int(11) DEFAULT NULL,
  `empatados` int(11) DEFAULT NULL,
  `perdidos` int(11) DEFAULT NULL,
  `goles_favor` int(11) DEFAULT NULL,
  `goles_contra` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `posiciones`
--

INSERT INTO `posiciones` (`id`, `seleccion_id`, `puntos`, `jugados`, `ganados`, `empatados`, `perdidos`, `goles_favor`, `goles_contra`) VALUES
(1, 1, 6, 2, 2, 0, 0, 4, 1),
(2, 2, 4, 2, 1, 1, 0, 3, 2),
(3, 3, 4, 2, 1, 1, 0, 3, 2),
(4, 4, 3, 1, 1, 0, 0, 3, 0),
(5, 5, 0, 1, 0, 0, 1, 1, 2),
(6, 6, 0, 1, 0, 0, 1, 0, 3),
(7, 7, 3, 1, 1, 0, 0, 2, 0),
(8, 9, 0, 1, 0, 0, 1, 0, 2);

-- --------------------------------------------------------

--
-- Table structure for table `resultados`
--

CREATE TABLE `resultados` (
  `id` int(11) NOT NULL,
  `local_id` int(11) DEFAULT NULL,
  `visitante_id` int(11) DEFAULT NULL,
  `goles_local` int(11) DEFAULT NULL,
  `goles_visitante` int(11) DEFAULT NULL,
  `fecha` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `resultados`
--

INSERT INTO `resultados` (`id`, `local_id`, `visitante_id`, `goles_local`, `goles_visitante`, `fecha`) VALUES
(1, 1, 5, 2, 1, '2025-06-15'),
(2, 3, 2, 1, 1, '2025-06-16'),
(3, 4, 6, 3, 0, '2025-06-17'),
(4, 9, 7, 0, 2, '2025-06-18');

-- --------------------------------------------------------

--
-- Table structure for table `selecciones`
--

CREATE TABLE `selecciones` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `selecciones`
--

INSERT INTO `selecciones` (`id`, `nombre`) VALUES
(1, 'Argentina'),
(2, 'Brasil'),
(3, 'Colombia'),
(4, 'Uruguay'),
(5, 'Chile'),
(6, 'Perú'),
(7, 'Ecuador'),
(8, 'Paraguay'),
(9, 'Venezuela'),
(10, 'Bolivia');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `posiciones`
--
ALTER TABLE `posiciones`
  ADD PRIMARY KEY (`id`),
  ADD KEY `seleccion_id` (`seleccion_id`);

--
-- Indexes for table `resultados`
--
ALTER TABLE `resultados`
  ADD PRIMARY KEY (`id`),
  ADD KEY `local_id` (`local_id`),
  ADD KEY `visitante_id` (`visitante_id`);

--
-- Indexes for table `selecciones`
--
ALTER TABLE `selecciones`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `posiciones`
--
ALTER TABLE `posiciones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `resultados`
--
ALTER TABLE `resultados`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `selecciones`
--
ALTER TABLE `selecciones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `posiciones`
--
ALTER TABLE `posiciones`
  ADD CONSTRAINT `posiciones_ibfk_1` FOREIGN KEY (`seleccion_id`) REFERENCES `selecciones` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `resultados`
--
ALTER TABLE `resultados`
  ADD CONSTRAINT `resultados_ibfk_1` FOREIGN KEY (`local_id`) REFERENCES `selecciones` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `resultados_ibfk_2` FOREIGN KEY (`visitante_id`) REFERENCES `selecciones` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
