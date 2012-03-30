-- phpMyAdmin SQL Dump
-- version 3.3.10deb1
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Мар 07 2012 г., 17:55
-- Версия сервера: 5.1.54
-- Версия PHP: 5.3.5-1ubuntu7.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `future_cms`
--

-- --------------------------------------------------------

--
-- Структура таблицы `gallery`
--

CREATE TABLE IF NOT EXISTS `gallery` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text COLLATE utf8_unicode_ci NOT NULL,
  `name_ru` text COLLATE utf8_unicode_ci NOT NULL,
  `link` text COLLATE utf8_unicode_ci NOT NULL,
  `published` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

--
-- Дамп данных таблицы `gallery`
--


-- --------------------------------------------------------

--
-- Структура таблицы `language`
--

CREATE TABLE IF NOT EXISTS `language` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `by` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `ru` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=25 ;

--
-- Дамп данных таблицы `language`
--

INSERT INTO `language` (`id`, `by`, `ru`) VALUES
(1, 'Аўтарызацыя', 'Авторизация'),
(2, 'Рэгістрацыя', 'Регистрация'),
(3, 'Панэль адміністратара', 'Панель администратора'),
(4, 'Выйсці', 'Выйти'),
(5, 'Падрабязней', 'Подробней'),
(6, 'Увядзіце логін:', 'Введите логин:'),
(7, 'Увядзіце пароль:', 'Введите пароль'),
(8, 'Увядзіце E-mail:', 'Введите E-mail:'),
(9, 'Абярыце аватар:', 'Выберите аватар:'),
(10, 'Абярыце пол:', 'Выберите пол:'),
(11, 'Мужчынскі', 'Мужской'),
(12, 'Жаночы', 'Женский'),
(13, 'Вашэ імя:', 'Ваше имя:'),
(14, 'Ваш E-mail:', 'Ваш E-mail:'),
(15, 'Тэма пытання', 'Тема вопроса'),
(16, 'Пытанне:', 'Вопрос:'),
(17, 'Усе палі абавязковыя для запаўнення!', 'Все поля обязательны для заполнения!'),
(18, 'Адправіць', 'Отправить'),
(19, 'Дадаць каментар:', 'Добавить комментарий:'),
(20, 'Для таго каб пакінуць каментар неабходна', 'Для того чтобы оставить комментарий необходимо'),
(21, 'або', 'или'),
(22, 'Імя карыстальніка:', 'Имя пользователя:'),
(23, 'Суполка:', 'Группа:'),
(24, 'Дата рэгістрацыі:', 'Дата регистрации:');

-- --------------------------------------------------------

--
-- Структура таблицы `menu`
--

CREATE TABLE IF NOT EXISTS `menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `num` int(11) NOT NULL,
  `by` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `ru` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `link` text COLLATE utf8_unicode_ci NOT NULL,
  `published` int(11) NOT NULL DEFAULT '0',
  `in` int(2) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=32 ;

--
-- Дамп данных таблицы `menu`
--

INSERT INTO `menu` (`id`, `num`, `by`, `ru`, `link`, `published`, `in`) VALUES
(1, 1, 'Галоўная', 'Главная', 'index.php', 1, 0),
(3, 5, 'Рэгістрацыя', 'Регистрация', 'Registratsiya.php', 1, 0),
(4, 4, 'Аўтарызацыя', 'Авторизация', 'Avtorizatsiya.php', 1, 0),
(5, 2, 'Навіны', 'Новости', 'read_news.php', 1, 0),
(29, 3, 'Галерэя', 'Галерея', 'Galereya.php', 1, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `news`
--

CREATE TABLE IF NOT EXISTS `news` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `caption` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `caption_ru` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `text` text COLLATE utf8_unicode_ci NOT NULL,
  `text_ru` text COLLATE utf8_unicode_ci NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

--
-- Дамп данных таблицы `news`
--


-- --------------------------------------------------------

--
-- Структура таблицы `news_comments`
--

CREATE TABLE IF NOT EXISTS `news_comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `text` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `news_id` int(11) NOT NULL,
  `users_id` int(11) NOT NULL,
  `datetime` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  KEY `fk_news_comments_news1` (`news_id`),
  KEY `fk_news_comments_users1` (`users_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Комментарии к новостям' AUTO_INCREMENT=1 ;

--
-- Дамп данных таблицы `news_comments`
--


-- --------------------------------------------------------

--
-- Структура таблицы `page`
--

CREATE TABLE IF NOT EXISTS `page` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `by` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `ru` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `link` text COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `title_ru` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `header` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `header_ru` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `text` longtext COLLATE utf8_unicode_ci NOT NULL,
  `text_ru` longtext COLLATE utf8_unicode_ci NOT NULL,
  `footer` text COLLATE utf8_unicode_ci NOT NULL,
  `in_menu` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=203 ;

--
-- Дамп данных таблицы `page`
--

INSERT INTO `page` (`id`, `by`, `ru`, `link`, `title`, `title_ru`, `header`, `header_ru`, `text`, `text_ru`, `footer`, `in_menu`) VALUES
(1, 'Галоўная старонка', 'Главная страница', 'index.php', 'Future CMS - Галоўная', 'Катэхетический колледж имени Зигмунта Лозинского - Главная', 'Future CMS', 'Катэхетический колледж имени Зигмунта Лозинского', '', '<p><a href="read_news.php?id=4"><b>Регистрация участников семинара &quot;Евангелизация и новые средства каммуникации&quot; (25 - 26 февраля 2012 г.)</b></a></p>', 'Катэхетычны каледж імя Зыгмунта Лазінскага <br />© Баранавічы 2012', 1),
(3, 'Рэгістрацыя', 'Регистрация', 'Registratsiya.php', 'Future CMS - Рэгістрацыя', 'Катэхетический колледж имени Зигмунта Лозинского - Регистрация', 'Future CMS', 'Катэхетический колледж имени Зигмунта Лозинского', '', '', 'Катэхетычны каледж імя Зыгмунта Лазінскага <br />© Баранавічы 2012', 1),
(4, 'Аўтарызацыя', 'Авторизация', 'Avtorizatsiya.php', 'Future CMS - Аўтарызацыя', 'Катехетический колледж имени Зигмунда Лозинского - Авторизация', 'Future CMS', 'Катехетический колледж имени Зигмунда Лозинского', '', '', 'Катэхетычны каледж імя Зыгмунта Лазінскага <br />© Баранавічы 2012', 1),
(6, 'album', 'album', 'album.php', 'Катэхетычны каледж імя Зыгмунта Лазінскага - ', 'Катэхетический колледж имени Зигмунта Лозинского', 'Катэхетычны каледж імя Зыгмунта Лазінскага', 'Катэхетический колледж имени Зигмунта Лозинского', '', '', 'Катэхетычны каледж імя Зыгмунта Лазінскага <br />© Баранавічы 2012', 0),
(120, 'ПРАВАЯ КОЛОНКА', 'ПРАВАЯ КОЛОНКА', 'RightSideBar', 'ПРАВАЯ КОЛОНКА', 'ПРАВАЯ КОЛОНКА', 'RightSideBar', 'RightSideBar', '<div id="sideRight">\r\nПравая панель\r\n</div><!-- .sidebar#sideRight -->', '<div id="sideRight">\r\n<div id="adress">Контакты</div>\r\n<div id="info"><strong>Адрес:</strong><br />\r\n<em>ул. Т. Шевченко, 6, 225411 г. Барановичи<br />\r\n</em> <strong>Телефоны:</strong> <br />\r\n<em>+375 (0163) 46 77 93 &nbsp;<br />\r\n+375 (0163) 46 56 06  <br />\r\n</em> <strong>Факс: <br />\r\n</strong> <em>+375 (0163) 46 94 74 <br />\r\n</em> <strong>E-mail:<br />\r\n</strong> <a href="mailto:callegge@gmail.com">callegge@gmail.com</a>\r\n<p>Группа в <a href="http://www.facebook.com/groups/249293198454334/">Facebook</a></p>\r\n</div>\r\n</div>\r\n<!-- .sidebar#sideRight -->', '', 0),
(159, 'Аб карыстальніку', 'О пользователе', 'O_polzovatele.php', 'Future CMS - О пользователе', 'Катэхетический колледж имени Зигмунта Лозинского - О пользователе', 'Future CMS', 'Катэхетический колледж имени Зигмунта Лозинского', '', '', 'Катэхетычны каледж імя Зыгмунта Лазінскага <br />© Баранавічы 2012', 0),
(196, 'Галерэя', 'Галерея', 'Galereya.php', 'Future CMS - Галерэя', 'Катехетический колледж имени Зигмунда Лозинского - Галерея', 'Future CMS', 'Катехетический колледж имени Зигмунда Лозинского', '', '', 'Катэхетычны каледж імя Зыгмунта Лазінскага <br />© Баранавічы 2012', 1),
(198, 'ЛЕВАЯ КОЛОНКА', 'ЛЕВАЯ КОЛОНКА', 'LEVAYA_KOLONKA.php', 'ЛЕВАЯ КОЛОНКА', '', 'LeftSideBar', '', '', '', '', 0),
(200, 'Правіць профіль', 'Редактирование профиля', 'Redaktirovanie_profilya.php', 'Future CMS - Правіць профіль', 'Катехетический колледж имени Зигмунда Лозинского - Редактирование профиля', 'Future CMS', 'Катехетический колледж имени Зигмунда Лозинского', '', '', 'Катэхетычны каледж імя Зыгмунта Лазінскага <br />© Баранавічы 2012', 0);

-- --------------------------------------------------------

--
-- Структура таблицы `register_seminar`
--

CREATE TABLE IF NOT EXISTS `register_seminar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fio` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `adress` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `date` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=50 ;

--
-- Дамп данных таблицы `register_seminar`
--

INSERT INTO `register_seminar` (`id`, `fio`, `email`, `adress`, `phone`, `date`) VALUES
(6, 'asdasd', 'asdasd', 'adad', 'asdasd', 'aasda'),
(7, '', '', '', '', ''),
(8, '', '', '', '', ''),
(9, 'Крупенка Уладзімір', 'Metr_93gr@mail.ru', 'Гродна', '+375295811', '9.00'),
(10, 'Крупенка Уладзімір', 'Metr_93gr@mail.ru', 'Гродна', '+375295811', '9.00'),
(11, 'Павел Салабуда', 'solobuda@gmail.com', 'Гродна', '', '25 лютага'),
(12, 'Юрий Лобанов', 'yulobanov@yandex.ru', 'Барановичи', '', '9:00'),
(13, 'Ірына Богуш', 'ikbogush@gmail.com', 'г. Бяроза', '2211257', '9.30'),
(14, 'Таццяна Вiшнеуская', 'Laila@tut.by', 'Гродна', '80292651465', '8.00'),
(15, 'Yury Stupakou', 'ahrest1@gmail.com', 'Baranavichy', '+375336721599', '08.00-08.30'),
(16, '', '', '', '', ''),
(17, '', '', '', '', ''),
(18, '', '', '', '', ''),
(19, '', '', '', '', ''),
(20, '', '', '', '', ''),
(21, '', '', '', '', ''),
(22, '', '', '', '', ''),
(23, '', '', '', '', ''),
(24, '', '', '', '', ''),
(25, '', '', '', '', ''),
(26, '', '', '', '', ''),
(27, '', '', '', '', ''),
(28, '', '', '', '', ''),
(29, '', '', '', '', ''),
(30, '', '', '', '', ''),
(31, '', '', '', '', ''),
(32, '', '', '', '', ''),
(33, '', '', '', '', ''),
(34, '', '', '', '', ''),
(35, '', '', '', '', ''),
(36, '', '', '', '', ''),
(37, '', '', '', '', ''),
(38, '', '', '', '', ''),
(39, '', '', '', '', ''),
(40, '', '', '', '', ''),
(41, '', '', '', '', ''),
(42, 'Стукалов Андрей', 'krupki.net@bk.ru', 'Крупки', '+37529 2548554', '07:28'),
(43, 'Андрей Стукалов', 'krupki.net@bk.ru', 'Крупки', '80292548554', '8;00'),
(44, 'Марина Магирко', 'marina.magirko@mail.', 'Брест', '', '9.00'),
(45, 'Сяргей Гіркін', 'mahiloviec@gmail.com', '', '+375256407571', 'з раніцы'),
(46, 'Тереса Климович', 'kallina@tut.by', 'Минск', '8029 131 03 12', '7.30'),
(47, 'Андрей Стукалов', 'krupki.net@bk.ru', 'Крупки', '+375292548554', 'c 8 до9'),
(48, 'Шаўрук Катажына', 'schtirliz@biz.by', 'г. Менск', '+375296556030', '25/02 а 9 раніцы'),
(49, 'Алена Ясюк', 'alyonajasuk@yahoo.co', 'Минск', '', '9:00 25.02');

-- --------------------------------------------------------

--
-- Структура таблицы `role`
--

CREATE TABLE IF NOT EXISTS `role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `by` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `ru` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Дамп данных таблицы `role`
--

INSERT INTO `role` (`id`, `by`, `ru`) VALUES
(1, 'Адміністратар', 'Администратор'),
(2, 'Мадэратар', 'Модератор'),
(3, 'Карыстальнік', 'Пользователь');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `pass` text COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `ava` text COLLATE utf8_unicode_ci NOT NULL,
  `sex` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  `datreg` datetime NOT NULL,
  `group` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_users_role1` (`group`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=51 ;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `login`, `pass`, `email`, `ava`, `sex`, `datreg`, `group`) VALUES
(39, 'kranon', 'd214a7aafe42a41fe59216827bd11f6e03cc93f2', 'kranon@tut.by', '../avatars/default.png', 'men', '2012-02-29 16:42:39', 1);

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `news_comments`
--
ALTER TABLE `news_comments`
  ADD CONSTRAINT `fk_news_comments_users1` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `news_comments_ibfk_1` FOREIGN KEY (`news_id`) REFERENCES `news` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Ограничения внешнего ключа таблицы `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `fk_users_role1` FOREIGN KEY (`group`) REFERENCES `role` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
