-- phpMyAdmin SQL Dump
-- version 3.3.10deb1
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Мар 22 2012 г., 17:57
-- Версия сервера: 5.1.61
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
  `name_lang1` text COLLATE utf8_unicode_ci NOT NULL,
  `name_lang2` text COLLATE utf8_unicode_ci NOT NULL,
  `link` text COLLATE utf8_unicode_ci NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=14 ;

--
-- Дамп данных таблицы `gallery`
--

INSERT INTO `gallery` (`id`, `name_lang1`, `name_lang2`, `link`, `date`) VALUES
(13, 'Альбом1', 'Albom1', 'Albom1', '2012-03-20');

-- --------------------------------------------------------

--
-- Структура таблицы `html_templ`
--

CREATE TABLE IF NOT EXISTS `html_templ` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `main_page` text COLLATE utf8_unicode_ci NOT NULL,
  `other_page` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='HTML шаблоны страниц' AUTO_INCREMENT=2 ;

--
-- Дамп данных таблицы `html_templ`
--

INSERT INTO `html_templ` (`id`, `main_page`, `other_page`) VALUES
(1, '<p''''>', '');

-- --------------------------------------------------------

--
-- Структура таблицы `language`
--

CREATE TABLE IF NOT EXISTS `language` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lang1` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `lang2` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=25 ;

--
-- Дамп данных таблицы `language`
--

INSERT INTO `language` (`id`, `lang1`, `lang2`) VALUES
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
  `lang1` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `lang2` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `link` text COLLATE utf8_unicode_ci NOT NULL,
  `published` int(11) NOT NULL DEFAULT '0',
  `in` int(2) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=34 ;

--
-- Дамп данных таблицы `menu`
--

INSERT INTO `menu` (`id`, `num`, `lang1`, `lang2`, `link`, `published`, `in`) VALUES
(1, 1, 'Галоўная', 'Главная', 'index.php', 1, 0),
(3, 5, 'Рэгістрацыя', 'Регистрация', 'Registratsiya.php', 0, 0),
(4, 6, 'Аўтарызацыя', 'Авторизация', 'Avtorizatsiya.php', 0, 3),
(5, 2, 'Навіны', 'Новости', 'read_news.php', 1, 0),
(29, 3, 'Галерэя', 'Галерея', 'Galereya.php', 1, 0),
(30, 4, 'Аб карыстальніку', 'О пользователе', 'O_polzovatele.php', 0, 0),
(32, 7, 'Правіць профіль', '', 'Редактировать профиль', 0, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `news`
--

CREATE TABLE IF NOT EXISTS `news` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `caption_lang1` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `caption_lang2` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `text_lang1` text COLLATE utf8_unicode_ci NOT NULL,
  `text_lang2` text COLLATE utf8_unicode_ci NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Дамп данных таблицы `news`
--

INSERT INTO `news` (`id`, `caption_lang1`, `caption_lang2`, `text_lang1`, `text_lang2`, `date`) VALUES
(1, 'Новость 1', 'News 12', '<p>Новость 1 текст</p>', '<p>News 1 text2</p>', '2012-03-19 10:23:30');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Комментарии к новостям' AUTO_INCREMENT=5 ;

--
-- Дамп данных таблицы `news_comments`
--

INSERT INTO `news_comments` (`id`, `text`, `news_id`, `users_id`, `datetime`) VALUES
(1, 'sdfsdfsdf', 1, 39, '2012-03-19 11:30:04'),
(2, 'чмчсмчсм', 1, 39, '2012-03-19 11:52:31'),
(3, 'вапрварпавр', 1, 39, '2012-03-19 11:52:34'),
(4, 'фпаывпмсичи', 1, 39, '2012-03-19 11:52:37');

-- --------------------------------------------------------

--
-- Структура таблицы `page`
--

CREATE TABLE IF NOT EXISTS `page` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lang1` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `lang2` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `link` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `text_lang1` longtext COLLATE utf8_unicode_ci NOT NULL,
  `text_lang2` longtext COLLATE utf8_unicode_ci NOT NULL,
  `in_menu` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=203 ;

--
-- Дамп данных таблицы `page`
--

INSERT INTO `page` (`id`, `lang1`, `lang2`, `link`, `text_lang1`, `text_lang2`, `in_menu`) VALUES
(1, 'Галоўная старонка', 'Главная страница', 'index.php', '<p>text1</p>', '<p>text2</p>', 1),
(3, 'Рэгістрацыя', 'Регистрация', 'Registratsiya.php', '', '', 0),
(4, 'Аўтарызацыя', 'Авторизация', 'Avtorizatsiya.php', '', '', 0),
(6, 'album', 'album', 'album.php', '', '', 0),
(120, 'ПРАВАЯ КОЛОНКА', 'ПРАВАЯ КОЛОНКА', 'RightSideBar', '<div id="sideRight">\r\nПравая панель\r\n</div><!-- .sidebar#sideRight -->', '<div id="sideRight">\r\n<div id="adress">Контакты</div>\r\n<div id="info"><strong>Адрес:</strong><br />\r\n<em>ул. Т. Шевченко, 6, 225411 г. Барановичи<br />\r\n</em> <strong>Телефоны:</strong> <br />\r\n<em>+375 (0163) 46 77 93 &nbsp;<br />\r\n+375 (0163) 46 56 06  <br />\r\n</em> <strong>Факс: <br />\r\n</strong> <em>+375 (0163) 46 94 74 <br />\r\n</em> <strong>E-mail:<br />\r\n</strong> <a href="mailto:callegge@gmail.com">callegge@gmail.com</a>\r\n<p>Группа в <a href="http://www.facebook.com/groups/249293198454334/">Facebook</a></p>\r\n</div>\r\n</div>\r\n<!-- .sidebar#sideRight -->', 0),
(159, 'Аб карыстальніку', 'О пользователе', 'O_polzovatele.php', '<hr />\r\n<p>&copy;Аб карыстальніку&nbsp;</p>', '<p>О пользователе&nbsp;</p>', 0),
(196, 'Галерэя', 'Галерея', 'Galereya.php', '', '', 1),
(198, 'ЛЕВАЯ КОЛОНКА', 'ЛЕВАЯ КОЛОНКА', 'LEVAYA_KOLONKA.php', '', '', 0),
(200, 'Правіць профіль', 'Редактирование профиля', 'Redaktirovanie_profilya.php', '', '', 0);

-- --------------------------------------------------------

--
-- Структура таблицы `role`
--

CREATE TABLE IF NOT EXISTS `role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lang1` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `lang2` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Дамп данных таблицы `role`
--

INSERT INTO `role` (`id`, `lang1`, `lang2`) VALUES
(1, 'Адміністратар', 'Администратор'),
(2, 'Мадэратар', 'Модератор'),
(3, 'Карыстальнік', 'Пользователь');

-- --------------------------------------------------------

--
-- Структура таблицы `settings`
--

CREATE TABLE IF NOT EXISTS `settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `siteName` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `siteHeader` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `siteFooter` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `metaTitle` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `metaKeywords` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `metaDescription` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `metaCharset` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Настройки сайта' AUTO_INCREMENT=3 ;

--
-- Дамп данных таблицы `settings`
--

INSERT INTO `settings` (`id`, `siteName`, `siteHeader`, `siteFooter`, `metaTitle`, `metaKeywords`, `metaDescription`, `metaCharset`) VALUES
(1, 'FutureCMS1', 'FutureCMS1', 'FutureCMS1', 'FutureCMS1', 'FutureCMS1', 'FutureCMS1', 'utf-81'),
(2, 'FutureCMS2', 'FutureCMS2', 'FutureCMS2', 'FutureCMS2', 'FutureCMS2', 'FutureCMS2', 'utf-82');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=44 ;

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
