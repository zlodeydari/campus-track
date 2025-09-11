-- Схема базы controlperformance
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET NAMES utf8mb4;

CREATE TABLE `spec` (
  `idspec` int(11) NOT NULL,
  `spec` varchar(40) COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

INSERT INTO `spec` (`idspec`, `spec`) VALUES
(1, 'Программирование'),
(2, 'Экономика'),
(3, 'ИС'),
(4, 'Радиоэлектроника');

CREATE TABLE `squad` (
  `idsquad` int(11) NOT NULL,
  `squad` varchar(40) COLLATE utf8_bin DEFAULT NULL,
  `department` varchar(40) COLLATE utf8_bin DEFAULT NULL,
  `idspec` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

INSERT INTO `squad` (`idsquad`, `squad`, `department`, `idspec`) VALUES
(1, '14АП2', 'Дневное', 1),
(2, '14АП3', 'Дневное', 2),
(3, '14АП4', 'Дневное', 3),
(4, '14АП5', 'Дневное', 4),
(5, '14АВ3', 'Дневное', 1),
(6, '14АВ5', 'Дневное', 2);

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

ALTER TABLE `spec`
  ADD PRIMARY KEY (`idspec`);

ALTER TABLE `squad`
  ADD PRIMARY KEY (`idsquad`),
  ADD KEY `idspec` (`idspec`);

ALTER TABLE `spec`
  MODIFY `idspec` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

ALTER TABLE `squad`
  MODIFY `idsquad` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

ALTER TABLE `squad`
  ADD CONSTRAINT `squad_ibfk_1` FOREIGN KEY (`idspec`) REFERENCES `spec` (`idspec`) ON DELETE CASCADE ON UPDATE CASCADE;
