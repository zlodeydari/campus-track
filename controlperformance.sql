-- Схема базы controlperformance
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET NAMES utf8mb4;

CREATE TABLE `usersystem` (
  `idusersystem` int(11) NOT NULL,
  `usersystem` varchar(40) COLLATE utf8_bin DEFAULT NULL,
  `phone` varchar(40) COLLATE utf8_bin DEFAULT NULL,
  `mail` varchar(40) COLLATE utf8_bin DEFAULT NULL,
  `login` varchar(40) COLLATE utf8_bin DEFAULT NULL,
  `parol` varchar(40) COLLATE utf8_bin DEFAULT NULL,
  `permission` varchar(40) COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

INSERT INTO `usersystem` (`idusersystem`, `usersystem`, `phone`, `mail`, `login`, `parol`, `permission`) VALUES
(1, 'Антонов ВА', '233442', 'wer@ya.ru', 'admin', 'master', 'Администратор'),
(5, 'Резниченко ДА', '663344', 'daavik22@yandex.ru', 'zxcv', 'asdf', 'Преподаватель'),
(7, 'Резниченко ДА', '884455', 'manager@ya.ru', 'manager', 'rtyu', 'Студент'),
(9, 'Долгополов НВ', '235522', 'mikola@ya.ru', 'mikola', 'dfgh', 'Декан');
