-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Авг 10 2019 г., 11:04
-- Версия сервера: 5.6.41
-- Версия PHP: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `project2`
--

-- --------------------------------------------------------

--
-- Структура таблицы `files`
--

CREATE TABLE `files` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `files`
--

INSERT INTO `files` (`id`, `user_id`, `name`, `url`) VALUES
(2, 11, 'itaque', 'https://lorempixel.com/200/300/?71625'),
(3, 8, 'et', 'https://lorempixel.com/200/300/?20232'),
(4, 13, 'aperiam', 'https://lorempixel.com/200/300/?99642'),
(5, 10, 'iusto', 'https://lorempixel.com/200/300/?38525'),
(6, 15, 'nam', 'https://lorempixel.com/200/300/?76242'),
(7, 15, 'dolore', 'https://lorempixel.com/200/300/?41738'),
(8, 10, 'quasi', 'https://lorempixel.com/200/300/?73571'),
(9, 7, 'quo', 'https://lorempixel.com/200/300/?84946'),
(10, 13, 'maxime', 'https://lorempixel.com/200/300/?44195'),
(11, 12, 'occaecati', 'https://lorempixel.com/200/300/?98592'),
(12, 16, 'et', 'https://lorempixel.com/200/300/?14306'),
(13, 14, 'ad', 'https://lorempixel.com/200/300/?78182'),
(14, 8, 'assumenda', 'https://lorempixel.com/200/300/?35425'),
(15, 11, 'sunt', 'https://lorempixel.com/200/300/?66520'),
(16, 12, 'exercitationem', 'https://lorempixel.com/200/300/?11284'),
(17, 9, 'voluptas', 'https://lorempixel.com/200/300/?91925'),
(18, 14, 'molestiae', 'https://lorempixel.com/200/300/?56891'),
(19, 7, 'vel', 'https://lorempixel.com/200/300/?58663'),
(20, 9, 'pariatur', 'https://lorempixel.com/200/300/?71655'),
(21, 8, 'itaque', 'https://lorempixel.com/200/300/?85624'),
(22, 13, 'ea', 'https://lorempixel.com/200/300/?60201'),
(23, 13, 'sed', 'https://lorempixel.com/200/300/?51798'),
(24, 7, 'ducimus', 'https://lorempixel.com/200/300/?90403'),
(25, 10, 'quia', 'https://lorempixel.com/200/300/?18701'),
(26, 7, 'suscipit', 'https://lorempixel.com/200/300/?79145'),
(27, 8, 'velit', 'https://lorempixel.com/200/300/?97771'),
(28, 10, 'ullam', 'https://lorempixel.com/200/300/?90393'),
(29, 11, 'et', 'https://lorempixel.com/200/300/?75505'),
(30, 15, 'illum', 'https://lorempixel.com/200/300/?16057'),
(31, 12, 'et', 'https://lorempixel.com/200/300/?62928'),
(32, 10, 'provident', 'https://lorempixel.com/200/300/?53754'),
(33, 9, 'sint', 'https://lorempixel.com/200/300/?21541'),
(34, 13, 'distinctio', 'https://lorempixel.com/200/300/?51672'),
(35, 7, 'consequatur', 'https://lorempixel.com/200/300/?90515'),
(36, 15, 'et', 'https://lorempixel.com/200/300/?83392'),
(37, 11, 'laudantium', 'https://lorempixel.com/200/300/?53717'),
(38, 11, 'ut', 'https://lorempixel.com/200/300/?34591'),
(39, 13, 'hic', 'https://lorempixel.com/200/300/?25892'),
(40, 9, 'qui', 'https://lorempixel.com/200/300/?59630'),
(41, 7, 'dolores', 'https://lorempixel.com/200/300/?16316'),
(42, 8, 'est', 'https://lorempixel.com/200/300/?73822'),
(43, 11, 'ex', 'https://lorempixel.com/200/300/?51387'),
(44, 15, 'aut', 'https://lorempixel.com/200/300/?89771'),
(45, 10, 'ad', 'https://lorempixel.com/200/300/?95360'),
(46, 13, 'tenetur', 'https://lorempixel.com/200/300/?78978'),
(47, 15, 'aspernatur', 'https://lorempixel.com/200/300/?63209'),
(48, 10, 'voluptas', 'https://lorempixel.com/200/300/?96953'),
(49, 9, 'aut', 'https://lorempixel.com/200/300/?87858'),
(50, 8, 'non', 'https://lorempixel.com/200/300/?42265'),
(51, 8, 'fuga', 'https://lorempixel.com/200/300/?64159'),
(52, 12, 'ipsa', 'https://lorempixel.com/200/300/?86854'),
(53, 16, 'totam', 'https://lorempixel.com/200/300/?73341'),
(54, 7, 'excepturi', 'https://lorempixel.com/200/300/?34412'),
(55, 14, 'commodi', 'https://lorempixel.com/200/300/?42886'),
(56, 11, 'tenetur', 'https://lorempixel.com/200/300/?11939'),
(57, 16, 'asperiores', 'https://lorempixel.com/200/300/?77776'),
(58, 8, 'explicabo', 'https://lorempixel.com/200/300/?88590'),
(59, 12, 'consequatur', 'https://lorempixel.com/200/300/?62337'),
(60, 9, 'et', 'https://lorempixel.com/200/300/?32872'),
(61, 8, 'omnis', 'https://lorempixel.com/200/300/?13641');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `login` varchar(128) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `age` tinyint(3) UNSIGNED DEFAULT NULL,
  `descr` text,
  `avatar` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `login`, `name`, `password`, `age`, `descr`, `avatar`) VALUES
(7, 'isaiah.keeling@hotmail.com', 'madyson91', '\'azXJ1@iUc,/jp|$/.L', 10, 'Et facilis quo et assumenda. Corporis totam minima sint qui. Ut est numquam asperiores illum est. Occaecati autem deserunt quod est unde. Consequatur pariatur excepturi sunt voluptatum sed.', 'https://lorempixel.com/200/300/?65428'),
(8, 'michel.conn@gmail.com', 'krajcik.theresa', '<FD,}i/#[', 71, 'Nesciunt itaque sit eveniet voluptatem libero. Cumque et aut maiores. Iure veritatis odit porro praesentium consequatur quae est. Velit voluptas velit non dolorem alias non aliquid.', 'https://lorempixel.com/200/300/?72716'),
(9, 'salvatore74@gmail.com', 'marquardt.philip', 'PT?k+#`9ChNg:XR', 49, 'Harum voluptas saepe et modi ut labore consequatur. Porro sunt quos aperiam praesentium odit inventore sint modi. Maiores quisquam nobis esse.', 'https://lorempixel.com/200/300/?33609'),
(10, 'bstanton@gmail.com', 'jhansen', '6*K6y,Q{bHNX', 61, 'Amet et voluptatum dolores dolorum nihil. Ducimus sint ab cum qui nesciunt dolores officiis. Labore autem voluptatum aliquid et. Ducimus perspiciatis aut doloremque.', 'https://lorempixel.com/200/300/?78622'),
(11, 'bschmitt@haley.com', 'sweber', '\'rK2E(q?', 43, 'Nemo saepe id id optio. Dolores similique fugit voluptate eum consequuntur. Excepturi ad aut asperiores id aut. Ea quo modi et qui.', 'https://lorempixel.com/200/300/?87004'),
(12, 'emie38@ledner.biz', 'dianna.harris', '+U|yT)UV!NLuf3t<[u', 38, 'Nisi quae minima harum ex voluptates. Enim nesciunt enim et rerum. Est perferendis atque quis soluta vel. Dolore unde quisquam consequatur officia.', 'https://lorempixel.com/200/300/?27065'),
(13, 'littel.camylle@gmail.com', 'torrance.kassulke', 'A*7kaK\\-', 40, 'Quia aut praesentium eius vero. Iusto cum omnis aperiam. Ab nobis quisquam fugit doloremque voluptate corporis. Consectetur sapiente voluptas vel.', 'https://lorempixel.com/200/300/?84025'),
(14, 'mcarroll@gmail.com', 'xaufderhar', 'VKncIM3vZ]YsS|8#_oU', 39, 'Et nam debitis error accusamus quo id fuga. Sapiente ipsa porro libero odit beatae consequuntur nostrum dolor. Facilis aut et suscipit recusandae facere eos molestiae.', 'https://lorempixel.com/200/300/?49526'),
(15, 'vcassin@rice.net', 'daniela.dach', 'v2rEiNq$%|', 57, 'Earum voluptatum velit et impedit velit. Aspernatur est nesciunt dicta quia est. Impedit aliquam asperiores consequatur quasi quam. Ipsum in aperiam et odio pariatur aut cum.', 'https://lorempixel.com/200/300/?71210'),
(16, 'swaniawski.elody@pacocha.net', 'qmitchell', 'Dz7Jt-', 73, 'Sequi corrupti odio ullam. Modi illo veritatis id voluptatem quia dolor. Rem reprehenderit et repudiandae ab.', 'https://lorempixel.com/200/300/?69006');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `files`
--
ALTER TABLE `files`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `files`
--
ALTER TABLE `files`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
