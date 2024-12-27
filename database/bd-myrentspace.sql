-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 27, 2024 at 10:06 AM
-- Wersja serwera: 10.4.32-MariaDB
-- Wersja PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bd-myrentspace`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `apartments`
--

CREATE TABLE `apartments` (
  `id` int(11) NOT NULL,
  `building_id` int(11) NOT NULL,
  `apartment_number` varchar(50) NOT NULL,
  `floor_number` int(11) NOT NULL,
  `size_sqm` decimal(10,2) NOT NULL,
  `status` enum('available','rented','maintenance') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `apartments`
--

INSERT INTO `apartments` (`id`, `building_id`, `apartment_number`, `floor_number`, `size_sqm`, `status`) VALUES
(1, 1, '101', 1, 45.50, 'available'),
(2, 1, '102', 1, 50.00, 'rented'),
(3, 1, '201', 2, 65.00, 'available'),
(4, 2, '301', 3, 70.00, 'maintenance'),
(5, 2, '302', 3, 55.00, 'available'),
(6, 3, '101', 1, 60.50, 'rented'),
(7, 3, '102', 1, 48.00, 'rented'),
(8, 4, '201', 2, 72.00, 'available'),
(9, 4, '202', 2, 68.50, 'rented'),
(10, 5, '301', 3, 49.00, 'available'),
(11, 5, '302', 3, 52.00, 'rented'),
(12, 6, '101', 1, 46.50, 'available'),
(13, 6, '102', 1, 64.00, 'rented'),
(14, 7, '201', 2, 75.50, 'rented'),
(15, 7, '202', 2, 80.00, 'maintenance'),
(16, 8, '301', 3, 69.00, 'rented'),
(17, 8, '302', 3, 72.50, 'available'),
(18, 9, '101', 1, 55.00, 'available'),
(19, 9, '102', 1, 50.00, 'rented'),
(20, 10, '201', 2, 68.00, 'available');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `buildings`
--

CREATE TABLE `buildings` (
  `id` int(11) NOT NULL,
  `location_id` int(11) NOT NULL,
  `street` varchar(255) NOT NULL,
  `building_number` varchar(50) NOT NULL,
  `total_floors` int(11) NOT NULL,
  `common_cost` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `buildings`
--

INSERT INTO `buildings` (`id`, `location_id`, `street`, `building_number`, `total_floors`, `common_cost`) VALUES
(1, 1, 'Marszałkowska', '1A', 10, 1500.00),
(2, 1, 'Aleje Jerozolimskie', '20', 8, 1200.00),
(3, 2, 'Floriańska', '5', 5, 800.00),
(4, 2, 'Grodzka', '15B', 4, 750.00),
(5, 3, 'Piotrkowska', '33', 6, 1000.00),
(6, 3, 'Sienkiewicza', '12', 5, 900.00),
(7, 4, 'Legnicka', '2', 12, 2000.00),
(8, 4, 'Piłsudskiego', '8A', 7, 1300.00),
(9, 5, 'Ratajczaka', '9', 4, 800.00),
(10, 5, 'Święty Marcin', '11', 5, 850.00),
(11, 6, 'Długa', '3', 10, 1600.00),
(12, 6, 'Grunwaldzka', '22', 6, 1100.00),
(13, 7, 'Jagiellońska', '7', 8, 1200.00),
(14, 7, 'Kaszubska', '19', 5, 750.00),
(15, 8, 'Dworcowa', '13', 9, 1400.00),
(16, 8, 'Gdańska', '21', 6, 1000.00),
(17, 9, 'Lubelska', '6A', 7, 1300.00),
(18, 9, 'Narutowicza', '10', 4, 750.00),
(19, 10, '3 Maja', '25', 10, 1600.00),
(20, 10, 'Kościuszki', '31', 5, 950.00);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `commission_logs`
--

CREATE TABLE `commission_logs` (
  `id` int(11) NOT NULL,
  `rental_agreement_id` int(11) NOT NULL,
  `commission_amount` decimal(10,2) NOT NULL,
  `payment_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `commission_logs`
--

INSERT INTO `commission_logs` (`id`, `rental_agreement_id`, `commission_amount`, `payment_date`) VALUES
(1, 1, 200.00, '2024-01-25'),
(2, 2, 250.00, '2024-02-15'),
(3, 3, 100.00, '2024-03-10'),
(4, 4, 150.00, '2024-01-30'),
(5, 5, 100.00, '2024-06-20'),
(6, 6, 200.00, '2023-12-10'),
(7, 7, 150.00, '2024-03-15'),
(8, 8, 200.00, '2024-04-20'),
(9, 9, 250.00, '2024-05-20'),
(10, 10, 100.00, '2024-06-30'),
(11, 1, 200.00, '2024-02-25'),
(12, 2, 250.00, '2024-03-15'),
(13, 3, 100.00, '2024-04-10'),
(14, 4, 150.00, '2024-02-28'),
(15, 5, 100.00, '2024-07-20'),
(16, 6, 200.00, '2023-11-10'),
(17, 7, 150.00, '2024-04-15'),
(18, 8, 200.00, '2024-05-20'),
(19, 9, 250.00, '2024-06-20'),
(20, 10, 100.00, '2024-07-30');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `locations`
--

CREATE TABLE `locations` (
  `id` int(11) NOT NULL,
  `city` varchar(255) NOT NULL,
  `postal_code` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `locations`
--

INSERT INTO `locations` (`id`, `city`, `postal_code`) VALUES
(1, 'Warszawa', '00-001'),
(2, 'Kraków', '30-001'),
(3, 'Łódź', '90-001'),
(4, 'Wrocław', '50-001'),
(5, 'Poznań', '60-001'),
(6, 'Gdańsk', '80-001'),
(7, 'Szczecin', '70-001'),
(8, 'Bydgoszcz', '85-001'),
(9, 'Lublin', '20-001'),
(10, 'Katowice', '40-001'),
(11, 'Białystok', '15-001'),
(12, 'Gdynia', '81-001'),
(13, 'Częstochowa', '42-200'),
(14, 'Radom', '26-600'),
(15, 'Sosnowiec', '41-200'),
(16, 'Toruń', '87-100'),
(17, 'Rzeszów', '35-001'),
(18, 'Kielce', '25-001'),
(19, 'Gliwice', '44-100'),
(20, 'Zabrze', '41-800');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `logs`
--

CREATE TABLE `logs` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `action` varchar(255) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `logs`
--

INSERT INTO `logs` (`id`, `user_id`, `action`, `timestamp`) VALUES
(1, 1, 'Zalogowano do systemu.', '2024-01-01 07:00:00'),
(2, 2, 'Zgłoszono usterkę.', '2024-01-15 09:15:00'),
(3, 3, 'Zaktualizowano dane użytkownika.', '2024-02-01 11:30:00'),
(4, 4, 'Złożono wniosek o wynajem.', '2024-02-20 13:45:00'),
(5, 5, 'Opłacono fakturę za media.', '2024-03-10 08:00:00'),
(6, 6, 'Dodano nowy raport.', '2024-03-25 10:30:00'),
(7, 7, 'Zamknięto zgłoszenie serwisowe.', '2024-04-01 14:00:00'),
(8, 8, 'Zaktualizowano harmonogram płatności.', '2024-04-15 08:00:00'),
(9, 9, 'Przyjęto zgłoszenie serwisowe.', '2024-05-01 06:30:00'),
(10, 10, 'Zaktualizowano status umowy najmu.', '2024-05-20 13:45:00'),
(11, 1, 'Wygenerowano raport finansowy.', '2024-06-01 07:00:00'),
(12, 2, 'Zmieniono dane kontaktowe.', '2024-06-10 08:30:00'),
(13, 3, 'Dodano nową umowę najmu.', '2024-06-20 10:15:00'),
(14, 4, 'Zaktualizowano dane właściciela.', '2024-07-01 11:45:00'),
(15, 5, 'Zgłoszono awarię internetu.', '2024-07-10 13:00:00'),
(16, 6, 'Dodano nową płatność.', '2024-07-20 15:30:00'),
(17, 7, 'Zaktualizowano informacje o mieszkaniu.', '2024-08-01 06:00:00'),
(18, 8, 'Wysłano powiadomienie o płatności.', '2024-08-10 08:00:00'),
(19, 9, 'Zamknięto zgłoszenie serwisowe.', '2024-08-20 12:30:00'),
(20, 10, 'Dodano nowego użytkownika.', '2024-08-30 14:00:00');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `maintenance_requests`
--

CREATE TABLE `maintenance_requests` (
  `id` int(11) NOT NULL,
  `apartment_id` int(11) NOT NULL,
  `description` text NOT NULL,
  `request_date` date NOT NULL,
  `status` enum('open','in_progress','closed') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `maintenance_requests`
--

INSERT INTO `maintenance_requests` (`id`, `apartment_id`, `description`, `request_date`, `status`) VALUES
(1, 1, 'Wymiana uszczelki w kranie', '2024-01-15', 'open'),
(2, 2, 'Naprawa drzwi wejściowych', '2024-01-20', 'in_progress'),
(3, 3, 'Sprawdzenie instalacji elektrycznej', '2024-01-25', 'closed'),
(4, 4, 'Naprawa zamka w drzwiach', '2024-02-01', 'open'),
(5, 5, 'Czyszczenie wentylacji', '2024-02-10', 'in_progress'),
(6, 6, 'Malowanie ścian w salonie', '2024-02-15', 'closed'),
(7, 7, 'Naprawa spłuczki w toalecie', '2024-02-20', 'open'),
(8, 8, 'Wymiana oświetlenia w kuchni', '2024-02-25', 'closed'),
(9, 9, 'Czyszczenie odpływu w łazience', '2024-03-01', 'in_progress'),
(10, 10, 'Naprawa okna w sypialni', '2024-03-05', 'closed'),
(11, 1, 'Sprawdzenie pieca gazowego', '2024-03-10', 'open'),
(12, 2, 'Wymiana żarówki w garażu', '2024-03-15', 'closed'),
(13, 3, 'Konserwacja podłóg drewnianych', '2024-03-20', 'in_progress'),
(14, 4, 'Naprawa dzwonka do drzwi', '2024-03-25', 'closed'),
(15, 5, 'Malowanie sufitu w kuchni', '2024-03-30', 'open'),
(16, 6, 'Usunięcie zacieków na ścianach', '2024-04-05', 'in_progress'),
(17, 7, 'Naprawa balustrady na balkonie', '2024-04-10', 'closed'),
(18, 8, 'Wymiana płytek w łazience', '2024-04-15', 'in_progress'),
(19, 9, 'Naprawa pralki', '2024-04-20', 'closed'),
(20, 10, 'Czyszczenie kominów', '2024-04-25', 'open');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `media_types`
--

CREATE TABLE `media_types` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `unit` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `media_types`
--

INSERT INTO `media_types` (`id`, `name`, `unit`) VALUES
(1, 'Prąd', 'kWh'),
(2, 'Woda', 'm³'),
(3, 'Gaz', 'm³'),
(4, 'Ciepło', 'GJ'),
(5, 'Internet', 'Mbps');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `media_usage`
--

CREATE TABLE `media_usage` (
  `id` int(11) NOT NULL,
  `apartment_id` int(11) NOT NULL,
  `rental_agreement_id` int(11) NOT NULL,
  `media_type_id` int(11) NOT NULL,
  `reading_date` date NOT NULL,
  `value` decimal(10,2) NOT NULL,
  `archived` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `media_usage`
--

INSERT INTO `media_usage` (`id`, `apartment_id`, `rental_agreement_id`, `media_type_id`, `reading_date`, `value`, `archived`) VALUES
(1, 1, 1, 1, '2024-01-15', 250.50, 0),
(2, 1, 1, 2, '2024-01-15', 15.00, 0),
(3, 1, 1, 3, '2024-01-15', 30.00, 0),
(4, 2, 2, 1, '2024-02-15', 300.75, 0),
(5, 2, 2, 2, '2024-02-15', 12.50, 0),
(6, 3, 3, 1, '2024-03-15', 200.20, 0),
(7, 3, 3, 3, '2024-03-15', 25.00, 0),
(8, 4, 4, 4, '2024-01-31', 5.50, 1),
(9, 5, 5, 1, '2024-06-15', 320.00, 0),
(10, 5, 5, 2, '2024-06-15', 10.00, 0),
(11, 6, 6, 3, '2023-12-31', 45.00, 1),
(12, 7, 7, 1, '2024-03-15', 400.00, 0),
(13, 7, 7, 4, '2024-03-15', 6.50, 0),
(14, 8, 8, 2, '2024-04-15', 18.00, 0),
(15, 9, 9, 1, '2024-05-15', 270.00, 0),
(16, 9, 9, 3, '2024-05-15', 35.00, 0),
(17, 10, 10, 4, '2024-06-30', 10.50, 0),
(18, 10, 10, 5, '2024-06-30', 100.00, 0),
(19, 1, 1, 5, '2024-01-15', 150.00, 0),
(20, 2, 2, 5, '2024-02-15', 120.00, 0);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `notifications`
--

CREATE TABLE `notifications` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `message` text NOT NULL,
  `type` enum('reminder','info','alert') NOT NULL,
  `sent_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` enum('unread','read') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `user_id`, `message`, `type`, `sent_at`, `status`) VALUES
(21, 1, 'Twoja płatność za mieszkanie jest zaległa.', 'reminder', '2024-02-12 09:00:00', 'unread'),
(22, 2, 'Zbliża się termin płatności za wynajem.', 'reminder', '2024-03-01 08:00:00', 'read'),
(23, 3, 'Nowe zgłoszenie serwisowe zostało utworzone.', 'info', '2024-03-15 10:30:00', 'unread'),
(24, 4, 'Twoje zgłoszenie zostało zamknięte.', 'info', '2024-02-20 14:45:00', 'read'),
(25, 5, 'Twoja płatność za media została zaksięgowana.', 'info', '2024-06-10 11:20:00', 'read'),
(26, 6, 'Nowy raport finansowy jest dostępny.', 'alert', '2023-12-05 07:30:00', 'unread'),
(27, 7, 'Ważne: Twoja umowa najmu wygasa za 30 dni.', 'alert', '2024-03-01 16:00:00', 'unread'),
(28, 8, 'Nowa wiadomość od właściciela mieszkania.', 'info', '2024-04-10 08:45:00', 'read'),
(29, 9, 'Twoje zgłoszenie serwisowe jest w trakcie realizacji.', 'info', '2024-05-05 12:00:00', 'unread'),
(30, 10, 'Zbliża się termin płatności za media.', 'reminder', '2024-06-25 14:30:00', 'unread'),
(31, 1, 'Twoja płatność została zaksięgowana.', 'info', '2024-01-20 10:00:00', 'read'),
(32, 2, 'Twoja umowa najmu została zaktualizowana.', 'info', '2024-02-15 11:30:00', 'read'),
(33, 3, 'Twoja zgłoszona usterka została usunięta.', 'info', '2024-03-25 12:00:00', 'read'),
(34, 4, 'Nowa oferta wynajmu jest dostępna.', 'info', '2024-02-10 13:15:00', 'unread'),
(35, 5, 'Twoja płatność za media jest zaległa.', 'reminder', '2024-06-15 07:00:00', 'unread'),
(36, 6, 'Twoje dane zostały zaktualizowane.', 'info', '2023-12-10 15:30:00', 'read'),
(37, 7, 'Twoje zgłoszenie serwisowe jest w toku.', 'info', '2024-03-05 09:15:00', 'read'),
(38, 8, 'Zgłoszenie dotyczące mieszkania zostało zaakceptowane.', 'info', '2024-04-15 13:45:00', 'unread'),
(39, 9, 'Raport dotyczący Twojej umowy jest gotowy.', 'alert', '2024-05-20 11:30:00', 'read'),
(40, 10, 'Ważne: Twoja umowa wygasa za 7 dni.', 'alert', '2024-06-24 08:00:00', 'unread');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `owners`
--

CREATE TABLE `owners` (
  `id` int(11) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `email` varchar(255) NOT NULL,
  `commission_rate` decimal(5,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `owners`
--

INSERT INTO `owners` (`id`, `first_name`, `last_name`, `phone`, `email`, `commission_rate`) VALUES
(1, 'Zbigniew', 'Malinowski', '620300400', 'zbigniew.malinowski@example.com', 5.00),
(2, 'Beata', 'Rutkowska', '621400500', 'beata.rutkowska@example.com', 4.50),
(3, 'Robert', 'Sikorski', '622500600', 'robert.sikorski@example.com', 6.00),
(4, 'Elżbieta', 'Majewska', '623600700', 'elzbieta.majewska@example.com', 5.50),
(5, 'Rafał', 'Lis', '624700800', 'rafal.lis@example.com', 6.00),
(6, 'Barbara', 'Michalska', '625800900', 'barbara.michalska@example.com', 4.50),
(7, 'Wojciech', 'Gajewski', '626900100', 'wojciech.gajewski@example.com', 5.00),
(8, 'Halina', 'Zawadzka', '627100200', 'halina.zawadzka@example.com', 4.00),
(9, 'Krzysztof', 'Ostrowski', '628200300', 'krzysztof.ostrowski@example.com', 5.50),
(10, 'Urszula', 'Wesołowska', '629300400', 'urszula.wesolowska@example.com', 6.00),
(11, 'Andrzej', 'Pietrzak', '630400500', 'andrzej.pietrzak@example.com', 5.00),
(12, 'Alicja', 'Mróz', '631500600', 'alicja.mroz@example.com', 4.50),
(13, 'Maciej', 'Sadowski', '632600700', 'maciej.sadowski@example.com', 6.00),
(14, 'Dorota', 'Jasińska', '633700800', 'dorota.jasinska@example.com', 5.50),
(15, 'Marcin', 'Jóźwiak', '634800900', 'marcin.jozwiak@example.com', 4.00),
(16, 'Ewelina', 'Kaleta', '635900100', 'ewelina.kaleta@example.com', 5.00),
(17, 'Daniel', 'Borowski', '636100200', 'daniel.borowski@example.com', 6.50),
(18, 'Karolina', 'Kulesza', '637200300', 'karolina.kulesza@example.com', 5.50),
(19, 'Patryk', 'Nowiński', '638300400', 'patryk.nowinski@example.com', 4.50),
(20, 'Renata', 'Wrona', '639400500', 'renata.wrona@example.com', 6.00);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `payment_schedule`
--

CREATE TABLE `payment_schedule` (
  `id` int(11) NOT NULL,
  `rental_agreement_id` int(11) NOT NULL,
  `due_date` date NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `type` enum('rent','owner_rent','media','commission') NOT NULL,
  `status` enum('pending','paid','overdue') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payment_schedule`
--

INSERT INTO `payment_schedule` (`id`, `rental_agreement_id`, `due_date`, `amount`, `type`, `status`) VALUES
(1, 1, '2024-01-10', 2500.00, 'rent', 'paid'),
(2, 1, '2024-02-10', 2500.00, 'rent', 'pending'),
(3, 1, '2024-03-10', 2500.00, 'rent', 'pending'),
(4, 2, '2024-02-05', 2300.00, 'rent', 'paid'),
(5, 2, '2024-03-05', 2300.00, 'rent', 'pending'),
(6, 3, '2024-03-01', 2000.00, 'rent', 'paid'),
(7, 3, '2024-04-01', 2000.00, 'rent', 'pending'),
(8, 4, '2024-01-15', 2700.00, 'rent', 'paid'),
(9, 4, '2024-02-15', 2700.00, 'rent', 'pending'),
(10, 5, '2024-06-10', 3000.00, 'rent', 'pending'),
(11, 6, '2023-12-01', 2600.00, 'rent', 'paid'),
(12, 6, '2024-01-01', 2600.00, 'rent', 'pending'),
(13, 7, '2024-03-01', 2800.00, 'rent', 'paid'),
(14, 7, '2024-04-01', 2800.00, 'rent', 'pending'),
(15, 8, '2024-04-01', 2500.00, 'rent', 'paid'),
(16, 8, '2024-05-01', 2500.00, 'rent', 'pending'),
(17, 9, '2024-05-01', 2200.00, 'rent', 'paid'),
(18, 9, '2024-06-01', 2200.00, 'rent', 'pending'),
(19, 10, '2024-06-01', 3100.00, 'rent', 'paid'),
(20, 10, '2024-07-01', 3100.00, 'rent', 'pending');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `rental_agreements`
--

CREATE TABLE `rental_agreements` (
  `id` int(11) NOT NULL,
  `apartment_id` int(11) NOT NULL,
  `tenant_id` int(11) NOT NULL,
  `owner_id` int(11) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `rent_amount` decimal(10,2) NOT NULL,
  `owner_rent` decimal(10,2) NOT NULL,
  `media_advance` decimal(10,2) DEFAULT NULL,
  `company_commission` decimal(10,2) DEFAULT NULL,
  `status` enum('active','terminated','expired') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rental_agreements`
--

INSERT INTO `rental_agreements` (`id`, `apartment_id`, `tenant_id`, `owner_id`, `start_date`, `end_date`, `rent_amount`, `owner_rent`, `media_advance`, `company_commission`, `status`) VALUES
(1, 1, 1, 1, '2024-01-01', '2024-12-31', 2500.00, 2000.00, 300.00, 200.00, 'active'),
(2, 2, 2, 2, '2024-02-01', '2024-11-30', 2300.00, 1800.00, 250.00, 250.00, 'active'),
(3, 3, 3, 3, '2024-03-01', '2024-09-30', 2000.00, 1700.00, 200.00, 100.00, 'active'),
(4, 4, 4, 4, '2024-01-15', '2024-07-14', 2700.00, 2200.00, 350.00, 150.00, 'terminated'),
(5, 5, 5, 5, '2023-06-01', '2024-05-31', 3000.00, 2500.00, 400.00, 100.00, 'active'),
(6, 6, 6, 6, '2023-01-01', '2023-12-31', 2600.00, 2100.00, 300.00, 200.00, 'expired'),
(7, 7, 7, 7, '2024-03-01', '2025-02-28', 2800.00, 2300.00, 350.00, 150.00, 'active'),
(8, 8, 8, 8, '2024-04-01', '2024-10-31', 2500.00, 2000.00, 300.00, 200.00, 'active'),
(9, 9, 9, 9, '2024-05-01', '2024-11-30', 2200.00, 1700.00, 250.00, 250.00, 'active'),
(10, 10, 10, 10, '2024-06-01', '2024-12-31', 3100.00, 2600.00, 400.00, 100.00, 'active');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `rent_payments`
--

CREATE TABLE `rent_payments` (
  `id` int(11) NOT NULL,
  `rental_agreement_id` int(11) NOT NULL,
  `payment_date` date NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `type` enum('rent','owner_rent','media','commission') NOT NULL,
  `status` enum('paid','pending','overdue') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rent_payments`
--

INSERT INTO `rent_payments` (`id`, `rental_agreement_id`, `payment_date`, `amount`, `type`, `status`) VALUES
(1, 1, '2024-01-10', 2500.00, 'rent', 'paid'),
(2, 1, '2024-01-15', 2000.00, 'owner_rent', 'paid'),
(3, 1, '2024-01-20', 300.00, 'media', 'paid'),
(4, 1, '2024-01-25', 200.00, 'commission', 'paid'),
(5, 2, '2024-02-05', 2300.00, 'rent', 'paid'),
(6, 2, '2024-02-10', 1800.00, 'owner_rent', 'paid'),
(7, 2, '2024-02-15', 250.00, 'media', 'paid'),
(8, 3, '2024-03-01', 2000.00, 'rent', 'paid'),
(9, 3, '2024-03-05', 1700.00, 'owner_rent', 'paid'),
(10, 3, '2024-03-10', 200.00, 'media', 'paid'),
(11, 4, '2024-01-20', 2700.00, 'rent', 'paid'),
(12, 4, '2024-01-25', 2200.00, 'owner_rent', 'paid'),
(13, 4, '2024-01-30', 350.00, 'media', 'paid'),
(14, 5, '2024-06-10', 3000.00, 'rent', 'pending'),
(15, 5, '2024-06-15', 2500.00, 'owner_rent', 'pending'),
(16, 5, '2024-06-20', 400.00, 'media', 'pending'),
(17, 6, '2023-12-01', 2600.00, 'rent', 'paid'),
(18, 6, '2023-12-05', 2100.00, 'owner_rent', 'paid'),
(19, 6, '2023-12-10', 300.00, 'media', 'paid');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `reports`
--

CREATE TABLE `reports` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `report_type` enum('financial','usage','summary') NOT NULL,
  `generated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `data` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`data`))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reports`
--

INSERT INTO `reports` (`id`, `user_id`, `report_type`, `generated_at`, `data`) VALUES
(21, 1, 'financial', '2024-01-31 09:00:00', '{\"income\": 5000, \"expenses\": 2000, \"profit\": 3000}'),
(22, 2, 'usage', '2024-02-28 14:00:00', '{\"water\": 120, \"electricity\": 500, \"gas\": 80}'),
(23, 3, 'summary', '2024-03-31 10:00:00', '{\"agreements\": 10, \"active\": 8, \"expired\": 2}'),
(24, 4, 'financial', '2024-02-15 10:30:00', '{\"income\": 8000, \"expenses\": 4000, \"profit\": 4000}'),
(25, 5, 'usage', '2024-06-10 11:20:00', '{\"water\": 150, \"electricity\": 600, \"gas\": 100}'),
(26, 6, 'summary', '2023-12-05 07:30:00', '{\"agreements\": 15, \"active\": 12, \"expired\": 3}'),
(27, 7, 'financial', '2024-03-01 16:00:00', '{\"income\": 7000, \"expenses\": 3500, \"profit\": 3500}'),
(28, 8, 'usage', '2024-04-10 08:45:00', '{\"water\": 100, \"electricity\": 450, \"gas\": 70}'),
(29, 9, 'summary', '2024-05-05 12:00:00', '{\"agreements\": 12, \"active\": 10, \"expired\": 2}'),
(30, 10, 'financial', '2024-06-25 14:30:00', '{\"income\": 6000, \"expenses\": 3000, \"profit\": 3000}'),
(31, 1, 'usage', '2024-01-20 10:00:00', '{\"water\": 130, \"electricity\": 520, \"gas\": 90}'),
(32, 2, 'summary', '2024-02-15 11:30:00', '{\"agreements\": 8, \"active\": 7, \"expired\": 1}'),
(33, 3, 'financial', '2024-03-25 12:00:00', '{\"income\": 6500, \"expenses\": 3200, \"profit\": 3300}'),
(34, 4, 'usage', '2024-02-10 13:15:00', '{\"water\": 140, \"electricity\": 580, \"gas\": 85}'),
(35, 5, 'summary', '2024-06-15 07:00:00', '{\"agreements\": 9, \"active\": 8, \"expired\": 1}'),
(36, 6, 'financial', '2023-12-10 15:30:00', '{\"income\": 7000, \"expenses\": 3500, \"profit\": 3500}'),
(37, 7, 'usage', '2024-03-05 09:15:00', '{\"water\": 125, \"electricity\": 540, \"gas\": 75}'),
(38, 8, 'summary', '2024-04-15 13:45:00', '{\"agreements\": 10, \"active\": 9, \"expired\": 1}'),
(39, 9, 'financial', '2024-05-20 11:30:00', '{\"income\": 7500, \"expenses\": 3700, \"profit\": 3800}'),
(40, 10, 'usage', '2024-06-24 08:00:00', '{\"water\": 160, \"electricity\": 610, \"gas\": 95}');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `reviews`
--

CREATE TABLE `reviews` (
  `id` int(11) NOT NULL,
  `rental_agreement_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `rating` int(11) NOT NULL,
  `comment` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`id`, `rental_agreement_id`, `user_id`, `rating`, `comment`, `created_at`) VALUES
(21, 1, 1, 5, 'Wszystko przebiegło sprawnie, polecam.', '2024-01-31 09:00:00'),
(22, 2, 2, 4, 'Ogólnie ok, ale drobne opóźnienia w komunikacji.', '2024-02-28 14:30:00'),
(23, 3, 3, 3, 'Mieszkanie w dobrym stanie, ale cena trochę wysoka.', '2024-03-31 10:00:00'),
(24, 4, 4, 5, 'Świetny kontakt z właścicielem, mieszkanie idealne.', '2024-02-15 17:00:00'),
(25, 5, 5, 2, 'Problemy z naprawą usterki w mieszkaniu.', '2024-06-10 07:00:00'),
(26, 6, 6, 4, 'Dobry standard, ale kilka rzeczy wymagało poprawy.', '2023-12-20 10:00:00'),
(27, 7, 7, 5, 'Polecam, wszystko zgodne z opisem.', '2024-03-20 13:30:00'),
(28, 8, 8, 3, 'Przyjemne mieszkanie, ale internet czasem szwankuje.', '2024-04-20 14:00:00'),
(29, 9, 9, 4, 'Dobry stosunek jakości do ceny.', '2024-05-25 15:30:00'),
(30, 10, 10, 5, 'Idealne miejsce, wszystko zgodne z oczekiwaniami.', '2024-06-30 17:00:00'),
(31, 1, 11, 4, 'Polecam, ale trzeba było długo czekać na odpowiedź.', '2024-02-15 09:00:00'),
(32, 2, 12, 3, 'Problemy z mediami, ale mieszkanie ok.', '2024-03-15 13:00:00'),
(33, 3, 13, 5, 'Wszystko idealnie, polecam.', '2024-04-10 11:00:00'),
(34, 4, 14, 4, 'Dobry kontakt z właścicielem.', '2024-02-25 10:00:00'),
(35, 5, 15, 2, 'Problemy z płatnościami, nie polecam.', '2024-06-05 06:00:00'),
(36, 6, 16, 5, 'Bardzo zadowolony, mieszkanie zgodne z opisem.', '2023-12-15 08:30:00'),
(37, 7, 17, 3, 'Problemy z pralką, ale szybko naprawione.', '2024-03-10 09:30:00'),
(38, 8, 18, 4, 'Mieszkanie w porządku, ale okolica głośna.', '2024-04-05 15:00:00'),
(39, 9, 19, 4, 'Polecam, dobry standard.', '2024-05-15 14:00:00'),
(40, 10, 20, 5, 'Rewelacja, wszystko perfekcyjnie.', '2024-06-20 17:30:00');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `tenants`
--

CREATE TABLE `tenants` (
  `id` int(11) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tenants`
--

INSERT INTO `tenants` (`id`, `first_name`, `last_name`, `phone`, `email`) VALUES
(1, 'Jan', 'Kowalski', '600100200', 'jan.kowalski@example.com'),
(2, 'Anna', 'Nowak', '601200300', 'anna.nowak@example.com'),
(3, 'Piotr', 'Wiśniewski', '602300400', 'piotr.wisniewski@example.com'),
(4, 'Katarzyna', 'Zielińska', '603400500', 'katarzyna.zielinska@example.com'),
(5, 'Michał', 'Kamiński', '604500600', 'michal.kaminski@example.com'),
(6, 'Agnieszka', 'Wójcik', '605600700', 'agnieszka.wojcik@example.com'),
(7, 'Paweł', 'Lewandowski', '606700800', 'pawel.lewandowski@example.com'),
(8, 'Ewa', 'Szymańska', '607800900', 'ewa.szymanska@example.com'),
(9, 'Tomasz', 'Dąbrowski', '608900100', 'tomasz.dabrowski@example.com'),
(10, 'Magdalena', 'Kozłowska', '609100200', 'magdalena.kozlowska@example.com'),
(11, 'Adam', 'Jankowski', '610200300', 'adam.jankowski@example.com'),
(12, 'Natalia', 'Mazur', '611300400', 'natalia.mazur@example.com'),
(13, 'Grzegorz', 'Kwiatkowski', '612400500', 'grzegorz.kwiatkowski@example.com'),
(14, 'Monika', 'Kaczmarek', '613500600', 'monika.kaczmarek@example.com'),
(15, 'Jakub', 'Czarnecki', '614600700', 'jakub.czarnecki@example.com'),
(16, 'Izabela', 'Król', '615700800', 'izabela.krol@example.com'),
(17, 'Mateusz', 'Adamski', '616800900', 'mateusz.adamski@example.com'),
(18, 'Joanna', 'Pawlak', '617900100', 'joanna.pawlak@example.com'),
(19, 'Szymon', 'Górski', '618100200', 'szymon.gorski@example.com'),
(20, 'Paulina', 'Nowicka', '619200300', 'paulina.nowicka@example.com');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','tenant','owner') NOT NULL,
  `related_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`, `related_id`) VALUES
(1, 'admin1', 'admin1234', 'admin', NULL),
(2, 'jan_kowalski', 'password123', 'tenant', 1),
(3, 'anna_nowak', 'password123', 'tenant', 2),
(4, 'piotr_wisniewski', 'password123', 'tenant', 3),
(5, 'katarzyna_zielinska', 'password123', 'tenant', 4),
(6, 'zbigniew_malinowski', 'password123', 'owner', 1),
(7, 'beata_rutkowska', 'password123', 'owner', 2),
(8, 'robert_sikorski', 'password123', 'owner', 3),
(9, 'elzbieta_majewska', 'password123', 'owner', 4),
(10, 'michal_kaminski', 'password123', 'tenant', 5),
(11, 'agnieszka_wojcik', 'password123', 'tenant', 6),
(12, 'pawel_lewandowski', 'password123', 'tenant', 7),
(13, 'ewa_szymanska', 'password123', 'tenant', 8),
(14, 'wojciech_gajewski', 'password123', 'owner', 5),
(15, 'halina_zawadzka', 'password123', 'owner', 6),
(16, 'krzysztof_ostrowski', 'password123', 'owner', 7),
(17, 'urszula_wesolowska', 'password123', 'owner', 8),
(18, 'adam_jankowski', 'password123', 'tenant', 9),
(19, 'natalia_mazur', 'password123', 'tenant', 10),
(20, 'maciej_sadowski', 'password123', 'owner', 9);

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `apartments`
--
ALTER TABLE `apartments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `building_id` (`building_id`);

--
-- Indeksy dla tabeli `buildings`
--
ALTER TABLE `buildings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `location_id` (`location_id`);

--
-- Indeksy dla tabeli `commission_logs`
--
ALTER TABLE `commission_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rental_agreement_id` (`rental_agreement_id`);

--
-- Indeksy dla tabeli `locations`
--
ALTER TABLE `locations`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indeksy dla tabeli `maintenance_requests`
--
ALTER TABLE `maintenance_requests`
  ADD PRIMARY KEY (`id`),
  ADD KEY `apartment_id` (`apartment_id`);

--
-- Indeksy dla tabeli `media_types`
--
ALTER TABLE `media_types`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `media_usage`
--
ALTER TABLE `media_usage`
  ADD PRIMARY KEY (`id`),
  ADD KEY `apartment_id` (`apartment_id`),
  ADD KEY `rental_agreement_id` (`rental_agreement_id`),
  ADD KEY `media_type_id` (`media_type_id`);

--
-- Indeksy dla tabeli `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indeksy dla tabeli `owners`
--
ALTER TABLE `owners`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `payment_schedule`
--
ALTER TABLE `payment_schedule`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rental_agreement_id` (`rental_agreement_id`);

--
-- Indeksy dla tabeli `rental_agreements`
--
ALTER TABLE `rental_agreements`
  ADD PRIMARY KEY (`id`),
  ADD KEY `apartment_id` (`apartment_id`),
  ADD KEY `tenant_id` (`tenant_id`),
  ADD KEY `owner_id` (`owner_id`);

--
-- Indeksy dla tabeli `rent_payments`
--
ALTER TABLE `rent_payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rental_agreement_id` (`rental_agreement_id`);

--
-- Indeksy dla tabeli `reports`
--
ALTER TABLE `reports`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indeksy dla tabeli `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rental_agreement_id` (`rental_agreement_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indeksy dla tabeli `tenants`
--
ALTER TABLE `tenants`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `related_id` (`related_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `apartments`
--
ALTER TABLE `apartments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `buildings`
--
ALTER TABLE `buildings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `commission_logs`
--
ALTER TABLE `commission_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `locations`
--
ALTER TABLE `locations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `logs`
--
ALTER TABLE `logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `maintenance_requests`
--
ALTER TABLE `maintenance_requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `media_types`
--
ALTER TABLE `media_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `media_usage`
--
ALTER TABLE `media_usage`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `owners`
--
ALTER TABLE `owners`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `payment_schedule`
--
ALTER TABLE `payment_schedule`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `rental_agreements`
--
ALTER TABLE `rental_agreements`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `rent_payments`
--
ALTER TABLE `rent_payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `reports`
--
ALTER TABLE `reports`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `tenants`
--
ALTER TABLE `tenants`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `apartments`
--
ALTER TABLE `apartments`
  ADD CONSTRAINT `apartments_ibfk_1` FOREIGN KEY (`building_id`) REFERENCES `buildings` (`id`);

--
-- Constraints for table `buildings`
--
ALTER TABLE `buildings`
  ADD CONSTRAINT `buildings_ibfk_1` FOREIGN KEY (`location_id`) REFERENCES `locations` (`id`);

--
-- Constraints for table `commission_logs`
--
ALTER TABLE `commission_logs`
  ADD CONSTRAINT `commission_logs_ibfk_1` FOREIGN KEY (`rental_agreement_id`) REFERENCES `rental_agreements` (`id`);

--
-- Constraints for table `logs`
--
ALTER TABLE `logs`
  ADD CONSTRAINT `logs_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `maintenance_requests`
--
ALTER TABLE `maintenance_requests`
  ADD CONSTRAINT `maintenance_requests_ibfk_1` FOREIGN KEY (`apartment_id`) REFERENCES `apartments` (`id`);

--
-- Constraints for table `media_usage`
--
ALTER TABLE `media_usage`
  ADD CONSTRAINT `media_usage_ibfk_1` FOREIGN KEY (`apartment_id`) REFERENCES `apartments` (`id`),
  ADD CONSTRAINT `media_usage_ibfk_2` FOREIGN KEY (`rental_agreement_id`) REFERENCES `rental_agreements` (`id`),
  ADD CONSTRAINT `media_usage_ibfk_3` FOREIGN KEY (`media_type_id`) REFERENCES `media_types` (`id`);

--
-- Constraints for table `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `notifications_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `payment_schedule`
--
ALTER TABLE `payment_schedule`
  ADD CONSTRAINT `payment_schedule_ibfk_1` FOREIGN KEY (`rental_agreement_id`) REFERENCES `rental_agreements` (`id`);

--
-- Constraints for table `rental_agreements`
--
ALTER TABLE `rental_agreements`
  ADD CONSTRAINT `rental_agreements_ibfk_1` FOREIGN KEY (`apartment_id`) REFERENCES `apartments` (`id`),
  ADD CONSTRAINT `rental_agreements_ibfk_2` FOREIGN KEY (`tenant_id`) REFERENCES `tenants` (`id`),
  ADD CONSTRAINT `rental_agreements_ibfk_3` FOREIGN KEY (`owner_id`) REFERENCES `owners` (`id`);

--
-- Constraints for table `rent_payments`
--
ALTER TABLE `rent_payments`
  ADD CONSTRAINT `rent_payments_ibfk_1` FOREIGN KEY (`rental_agreement_id`) REFERENCES `rental_agreements` (`id`);

--
-- Constraints for table `reports`
--
ALTER TABLE `reports`
  ADD CONSTRAINT `reports_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_ibfk_1` FOREIGN KEY (`rental_agreement_id`) REFERENCES `rental_agreements` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `reviews_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`related_id`) REFERENCES `tenants` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
