-- Схема базы controlperformance
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET NAMES utf8mb4;

CREATE TABLE `category` (
  `idcategory` int(11) NOT NULL,
  `category` varchar(40) COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

INSERT INTO `category` (`idcategory`, `category`) VALUES
(1, 'Лекция'),
(2, 'Практика'),
(3, 'Аттестация');

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

CREATE TABLE `student` (
  `ticket` varchar(40) COLLATE utf8_bin DEFAULT NULL,
  `student` varchar(40) COLLATE utf8_bin DEFAULT NULL,
  `idstudent` int(11) NOT NULL,
  `idsquad` int(11) NOT NULL,
  `datebirth` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

INSERT INTO `student` (`ticket`, `student`, `idstudent`, `idsquad`, `datebirth`) VALUES
('112233', 'Сергеев АВ', 1, 1, '2009-05-04'),
('241123', 'Аляпин ВА', 2, 2, '2008-05-03'),
('384732', 'Потапов ВА', 3, 3, '2009-05-03'),
('645645', 'Макарова ПР', 4, 3, '2009-03-05'),
('112233', 'Сергеева АВ', 5, 1, '2009-05-04'),
('656565', 'Михнин ВА', 6, 1, '2008-05-11'),
('554445', 'Фет  ВА', 7, 6, '2009-03-03'),
('896667', 'Плужков ПР', 8, 6, '2009-03-05'),
('775566', 'Крюк  ВА', 9, 4, '2009-01-03'),
('889955', 'Мелихова ПР', 10, 4, '2009-03-05'),
('444455', 'Круг  ВА', 11, 5, '2009-05-03'),
('445666', 'Мелихов ПР', 12, 5, '2009-03-05'),
('3453254', 'Петрук ВА', 13, 1, '1999-09-25');

CREATE TABLE `study` (
  `idstudy` int(11) NOT NULL,
  `idsubject` int(11) NOT NULL,
  `datestudy` date DEFAULT NULL,
  `idteacher` int(11) NOT NULL,
  `idsquad` int(11) NOT NULL,
  `idcategory` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

CREATE TABLE `subject` (
  `idsubject` int(11) NOT NULL,
  `subject` varchar(40) COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

INSERT INTO `subject` (`idsubject`, `subject`) VALUES
(1, 'Физика'),
(2, 'Математика'),
(3, 'Программирование'),
(4, 'История'),
(5, 'ИС');

CREATE TABLE `teacher` (
  `teacher` varchar(40) COLLATE utf8_bin DEFAULT NULL,
  `experience` date DEFAULT NULL,
  `idteacher` int(11) NOT NULL,
  `degree` varchar(40) COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

INSERT INTO `teacher` (`teacher`, `experience`, `idteacher`, `degree`) VALUES
('Саратов ВА', '2010-05-03', 1, '-'),
('Маракасов ВВ', '2001-05-03', 2, 'КТН'),
('Секретов ВА', '2010-05-03', 3, '-'),
('Мельдес ВВ', '2001-05-03', 4, 'КТН');

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

ALTER TABLE `category`
  ADD PRIMARY KEY (`idcategory`);

ALTER TABLE `spec`
  ADD PRIMARY KEY (`idspec`);

ALTER TABLE `squad`
  ADD PRIMARY KEY (`idsquad`),
  ADD KEY `idspec` (`idspec`);

ALTER TABLE `student`
  ADD PRIMARY KEY (`idstudent`),
  ADD KEY `idsquad` (`idsquad`);

ALTER TABLE `study`
  ADD PRIMARY KEY (`idstudy`),
  ADD KEY `idsubject` (`idsubject`),
  ADD KEY `idteacher` (`idteacher`),
  ADD KEY `idsquad` (`idsquad`),
  ADD KEY `idcategory` (`idcategory`);

ALTER TABLE `subject`
  ADD PRIMARY KEY (`idsubject`);

ALTER TABLE `teacher`
  ADD PRIMARY KEY (`idteacher`);

ALTER TABLE `category`
  MODIFY `idcategory` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

ALTER TABLE `spec`
  MODIFY `idspec` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

ALTER TABLE `squad`
  MODIFY `idsquad` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

ALTER TABLE `student`
  MODIFY `idstudent` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

ALTER TABLE `study`
  MODIFY `idstudy` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

ALTER TABLE `subject`
  MODIFY `idsubject` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

ALTER TABLE `teacher`
  MODIFY `idteacher` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

ALTER TABLE `squad`
  ADD CONSTRAINT `squad_ibfk_1` FOREIGN KEY (`idspec`) REFERENCES `spec` (`idspec`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `student`
  ADD CONSTRAINT `student_ibfk_1` FOREIGN KEY (`idsquad`) REFERENCES `squad` (`idsquad`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `study`
  ADD CONSTRAINT `study_ibfk_1` FOREIGN KEY (`idsubject`) REFERENCES `subject` (`idsubject`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `study_ibfk_2` FOREIGN KEY (`idteacher`) REFERENCES `teacher` (`idteacher`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `study_ibfk_3` FOREIGN KEY (`idsquad`) REFERENCES `squad` (`idsquad`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `study_ibfk_4` FOREIGN KEY (`idcategory`) REFERENCES `category` (`idcategory`) ON DELETE CASCADE ON UPDATE CASCADE;
