-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Сен 26 2025 г., 16:33
-- Версия сервера: 5.5.53
-- Версия PHP: 5.5.38

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `controlperformance`
--

-- --------------------------------------------------------

--
-- Структура таблицы `attendance`
--

CREATE TABLE `attendance` (
  `idattendance` int(11) NOT NULL,
  `attendance` varchar(40) COLLATE utf8_bin DEFAULT NULL,
  `idstudent` int(11) NOT NULL,
  `idstudy` int(11) NOT NULL,
  `cause` varchar(40) COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Дамп данных таблицы `attendance`
--

INSERT INTO `attendance` (`idattendance`, `attendance`, `idstudent`, `idstudy`, `cause`) VALUES
(58, 'Присутствовал', 1, 16, NULL),
(59, 'Присутствовал', 5, 16, NULL),
(60, 'Присутствовал', 6, 16, NULL),
(61, 'Отсутствовал', 13, 16, 'Больничный'),
(63, 'Присутствовал', 2, 10, NULL),
(73, 'Присутствовал', 1, 13, NULL),
(74, 'Присутствовал', 5, 13, NULL),
(75, 'Присутствовал', 6, 13, NULL),
(76, 'Присутствовал', 13, 13, NULL),
(77, 'Присутствовал', 2, 12, NULL),
(78, 'Присутствовал', 1, 11, NULL),
(79, 'Присутствовал', 5, 11, NULL),
(80, 'Присутствовал', 6, 11, NULL),
(81, 'Присутствовал', 13, 11, NULL),
(82, 'Присутствовал', 2, 14, NULL),
(83, 'Присутствовал', 1, 15, NULL),
(84, 'Отсутствовал', 5, 15, '---'),
(85, 'Отсутствовал', 6, 15, 'Больничный'),
(86, 'Присутствовал', 13, 15, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `category`
--

CREATE TABLE `category` (
  `idcategory` int(11) NOT NULL,
  `category` varchar(40) COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Дамп данных таблицы `category`
--

INSERT INTO `category` (`idcategory`, `category`) VALUES
(1, 'Лекция'),
(2, 'Практика'),
(3, 'Аттестация');

-- --------------------------------------------------------

--
-- Структура таблицы `control`
--

CREATE TABLE `control` (
  `idcontrol` int(11) NOT NULL,
  `control` varchar(40) COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Дамп данных таблицы `control`
--

INSERT INTO `control` (`idcontrol`, `control`) VALUES
(1, 'Экзамен'),
(2, 'Практика'),
(3, 'Занятие');

-- --------------------------------------------------------

--
-- Структура таблицы `performance`
--

CREATE TABLE `performance` (
  `idperformance` int(11) NOT NULL,
  `dateperformance` date DEFAULT NULL,
  `performance` int(11) DEFAULT NULL,
  `idstudent` int(11) NOT NULL,
  `idsubject` int(11) NOT NULL,
  `idteacher` int(11) NOT NULL,
  `idcontrol` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Дамп данных таблицы `performance`
--

INSERT INTO `performance` (`idperformance`, `dateperformance`, `performance`, `idstudent`, `idsubject`, `idteacher`, `idcontrol`) VALUES
(1, '2025-01-03', 5, 1, 1, 1, 1),
(2, '2025-01-13', 5, 2, 2, 2, 1),
(3, '2025-01-13', 4, 3, 3, 3, 1),
(4, '2025-02-03', 5, 4, 4, 4, 2),
(5, '2025-01-07', 5, 5, 5, 1, 2),
(6, '2025-01-03', 5, 6, 1, 2, 1),
(7, '2025-01-13', 4, 7, 2, 3, 1),
(8, '2025-02-03', 4, 8, 3, 4, 2),
(9, '2025-01-03', 4, 1, 4, 2, 1),
(10, '2025-01-03', 5, 2, 5, 3, 1),
(11, '2025-01-13', 3, 3, 1, 4, 1),
(12, '2025-02-03', 5, 4, 2, 1, 2),
(13, '2025-01-05', 5, 5, 3, 2, 2),
(14, '2025-01-03', 5, 6, 4, 3, 1),
(15, '2025-01-13', 4, 7, 5, 1, 1),
(16, '2025-02-03', 2, 8, 1, 4, 2),
(17, '2025-01-09', 5, 1, 2, 2, 1),
(18, '2025-01-03', 2, 2, 3, 2, 1),
(19, '2025-01-13', 4, 3, 4, 1, 1),
(20, '2025-02-03', 2, 4, 5, 3, 2),
(21, '2025-01-03', 5, 5, 1, 2, 2),
(22, '2025-01-03', 5, 6, 2, 4, 1),
(23, '2025-01-13', 2, 7, 3, 1, 1),
(24, '2025-02-23', 3, 8, 5, 2, 2),
(25, '2025-01-13', 5, 6, 2, 4, 3),
(26, '2025-05-13', 4, 7, 3, 1, 3),
(27, '2025-04-03', 3, 8, 5, 2, 3),
(28, '2025-09-26', 5, 2, 5, 1, 1),
(29, '2025-02-23', 4, 8, 5, 2, 1),
(30, '2025-02-03', 5, 8, 1, 4, 1),
(31, '2025-02-03', 4, 8, 3, 4, 1),
(32, '2025-04-03', 4, 8, 5, 2, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `spec`
--

CREATE TABLE `spec` (
  `idspec` int(11) NOT NULL,
  `spec` varchar(40) COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Дамп данных таблицы `spec`
--

INSERT INTO `spec` (`idspec`, `spec`) VALUES
(1, 'Программирование'),
(2, 'Экономика'),
(3, 'ИС'),
(4, 'Радиоэлектроника');

-- --------------------------------------------------------

--
-- Структура таблицы `squad`
--

CREATE TABLE `squad` (
  `idsquad` int(11) NOT NULL,
  `squad` varchar(40) COLLATE utf8_bin DEFAULT NULL,
  `department` varchar(40) COLLATE utf8_bin DEFAULT NULL,
  `idspec` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Дамп данных таблицы `squad`
--

INSERT INTO `squad` (`idsquad`, `squad`, `department`, `idspec`) VALUES
(1, '14АП2', 'Дневное', 1),
(2, '14АП3', 'Дневное', 2),
(3, '14АП4', 'Дневное', 3),
(4, '14АП5', 'Дневное', 4),
(5, '14АВ3', 'Дневное', 1),
(6, '14АВ5', 'Дневное', 2);

-- --------------------------------------------------------

--
-- Структура таблицы `student`
--

CREATE TABLE `student` (
  `ticket` varchar(40) COLLATE utf8_bin DEFAULT NULL,
  `student` varchar(40) COLLATE utf8_bin DEFAULT NULL,
  `idstudent` int(11) NOT NULL,
  `idsquad` int(11) NOT NULL,
  `datebirth` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Дамп данных таблицы `student`
--

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

-- --------------------------------------------------------

--
-- Структура таблицы `study`
--

CREATE TABLE `study` (
  `idstudy` int(11) NOT NULL,
  `idsubject` int(11) NOT NULL,
  `datestudy` date DEFAULT NULL,
  `idteacher` int(11) NOT NULL,
  `idsquad` int(11) NOT NULL,
  `idcategory` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Дамп данных таблицы `study`
--

INSERT INTO `study` (`idstudy`, `idsubject`, `datestudy`, `idteacher`, `idsquad`, `idcategory`) VALUES
(10, 3, '2025-03-05', 1, 2, 2),
(11, 5, '2025-02-15', 2, 1, 2),
(12, 3, '2025-02-25', 3, 2, 2),
(13, 5, '2025-03-05', 1, 1, 2),
(14, 3, '2025-02-15', 2, 2, 2),
(15, 5, '2025-02-09', 3, 1, 2),
(16, 1, '2025-09-29', 1, 1, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `subject`
--

CREATE TABLE `subject` (
  `idsubject` int(11) NOT NULL,
  `subject` varchar(40) COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Дамп данных таблицы `subject`
--

INSERT INTO `subject` (`idsubject`, `subject`) VALUES
(1, 'Физика'),
(2, 'Математика'),
(3, 'Программирование'),
(4, 'История'),
(5, 'ИС');

-- --------------------------------------------------------

--
-- Структура таблицы `teacher`
--

CREATE TABLE `teacher` (
  `teacher` varchar(40) COLLATE utf8_bin DEFAULT NULL,
  `experience` date DEFAULT NULL,
  `idteacher` int(11) NOT NULL,
  `degree` varchar(40) COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Дамп данных таблицы `teacher`
--

INSERT INTO `teacher` (`teacher`, `experience`, `idteacher`, `degree`) VALUES
('Саратов ВА', '2010-05-03', 1, '-'),
('Маракасов ВВ', '2001-05-03', 2, 'КТН'),
('Секретов ВА', '2010-05-03', 3, '-'),
('Мельдес ВВ', '2001-05-03', 4, 'КТН');

-- --------------------------------------------------------

--
-- Структура таблицы `usersystem`
--

CREATE TABLE `usersystem` (
  `idusersystem` int(11) NOT NULL,
  `usersystem` varchar(40) COLLATE utf8_bin DEFAULT NULL,
  `phone` varchar(40) COLLATE utf8_bin DEFAULT NULL,
  `mail` varchar(40) COLLATE utf8_bin DEFAULT NULL,
  `login` varchar(40) COLLATE utf8_bin DEFAULT NULL,
  `parol` varchar(40) COLLATE utf8_bin DEFAULT NULL,
  `permission` varchar(40) COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Дамп данных таблицы `usersystem`
--

INSERT INTO `usersystem` (`idusersystem`, `usersystem`, `phone`, `mail`, `login`, `parol`, `permission`) VALUES
(1, 'Антонов ВА', '233442', 'wer@ya.ru', 'admin', 'master', 'Администратор'),
(5, 'Резниченко ДА', '663344', 'daavik22@yandex.ru', 'zxcv', 'asdf', 'Преподаватель'),
(7, 'Резниченко ДА', '884455', 'manager@ya.ru', 'manager', 'rtyu', 'Студент'),
(9, 'Долгополов НВ', '235522', 'mikola@ya.ru', 'mikola', 'dfgh', 'Декан');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`idattendance`),
  ADD KEY `idstudent` (`idstudent`),
  ADD KEY `idstudy` (`idstudy`);

--
-- Индексы таблицы `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`idcategory`);

--
-- Индексы таблицы `control`
--
ALTER TABLE `control`
  ADD PRIMARY KEY (`idcontrol`);

--
-- Индексы таблицы `performance`
--
ALTER TABLE `performance`
  ADD PRIMARY KEY (`idperformance`),
  ADD KEY `idstudent` (`idstudent`),
  ADD KEY `idsubject` (`idsubject`),
  ADD KEY `idteacher` (`idteacher`),
  ADD KEY `idcontrol` (`idcontrol`);

--
-- Индексы таблицы `spec`
--
ALTER TABLE `spec`
  ADD PRIMARY KEY (`idspec`);

--
-- Индексы таблицы `squad`
--
ALTER TABLE `squad`
  ADD PRIMARY KEY (`idsquad`),
  ADD KEY `idspec` (`idspec`);

--
-- Индексы таблицы `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`idstudent`),
  ADD KEY `idsquad` (`idsquad`);

--
-- Индексы таблицы `study`
--
ALTER TABLE `study`
  ADD PRIMARY KEY (`idstudy`),
  ADD KEY `idsubject` (`idsubject`),
  ADD KEY `idteacher` (`idteacher`),
  ADD KEY `idsquad` (`idsquad`),
  ADD KEY `idcategory` (`idcategory`);

--
-- Индексы таблицы `subject`
--
ALTER TABLE `subject`
  ADD PRIMARY KEY (`idsubject`);

--
-- Индексы таблицы `teacher`
--
ALTER TABLE `teacher`
  ADD PRIMARY KEY (`idteacher`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `attendance`
--
ALTER TABLE `attendance`
  MODIFY `idattendance` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87;
--
-- AUTO_INCREMENT для таблицы `category`
--
ALTER TABLE `category`
  MODIFY `idcategory` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT для таблицы `control`
--
ALTER TABLE `control`
  MODIFY `idcontrol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT для таблицы `performance`
--
ALTER TABLE `performance`
  MODIFY `idperformance` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
--
-- AUTO_INCREMENT для таблицы `spec`
--
ALTER TABLE `spec`
  MODIFY `idspec` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT для таблицы `squad`
--
ALTER TABLE `squad`
  MODIFY `idsquad` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT для таблицы `student`
--
ALTER TABLE `student`
  MODIFY `idstudent` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT для таблицы `study`
--
ALTER TABLE `study`
  MODIFY `idstudy` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;
--
-- AUTO_INCREMENT для таблицы `subject`
--
ALTER TABLE `subject`
  MODIFY `idsubject` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT для таблицы `teacher`
--
ALTER TABLE `teacher`
  MODIFY `idteacher` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `attendance`
--
ALTER TABLE `attendance`
  ADD CONSTRAINT `attendance_ibfk_1` FOREIGN KEY (`idstudent`) REFERENCES `student` (`idstudent`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `attendance_ibfk_2` FOREIGN KEY (`idstudy`) REFERENCES `study` (`idstudy`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `performance`
--
ALTER TABLE `performance`
  ADD CONSTRAINT `performance_ibfk_1` FOREIGN KEY (`idstudent`) REFERENCES `student` (`idstudent`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `performance_ibfk_2` FOREIGN KEY (`idsubject`) REFERENCES `subject` (`idsubject`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `performance_ibfk_3` FOREIGN KEY (`idteacher`) REFERENCES `teacher` (`idteacher`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `performance_ibfk_4` FOREIGN KEY (`idcontrol`) REFERENCES `control` (`idcontrol`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `squad`
--
ALTER TABLE `squad`
  ADD CONSTRAINT `squad_ibfk_1` FOREIGN KEY (`idspec`) REFERENCES `spec` (`idspec`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `student`
--
ALTER TABLE `student`
  ADD CONSTRAINT `student_ibfk_1` FOREIGN KEY (`idsquad`) REFERENCES `squad` (`idsquad`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `study`
--
ALTER TABLE `study`
  ADD CONSTRAINT `study_ibfk_1` FOREIGN KEY (`idsubject`) REFERENCES `subject` (`idsubject`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `study_ibfk_2` FOREIGN KEY (`idteacher`) REFERENCES `teacher` (`idteacher`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `study_ibfk_3` FOREIGN KEY (`idsquad`) REFERENCES `squad` (`idsquad`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `study_ibfk_4` FOREIGN KEY (`idcategory`) REFERENCES `category` (`idcategory`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
