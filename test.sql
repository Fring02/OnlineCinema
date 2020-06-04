-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Май 06 2020 г., 13:18
-- Версия сервера: 10.4.11-MariaDB
-- Версия PHP: 7.4.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `test`
--

-- --------------------------------------------------------

--
-- Структура таблицы `films`
--

CREATE TABLE `films` (
  `film_id` int(11) NOT NULL,
  `film_name` text NOT NULL,
  `imgpath` varchar(100) NOT NULL,
  `genre` text NOT NULL,
  `country` text NOT NULL,
  `director` text NOT NULL,
  `actors` text NOT NULL,
  `premiere_date` date NOT NULL,
  `description` text NOT NULL,
  `views` int(11) DEFAULT NULL,
  `rate` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Дамп данных таблицы `films`
--

INSERT INTO `films` (`film_id`, `film_name`, `imgpath`, `genre`, `country`, `director`, `actors`, `premiere_date`, `description`, `views`, `rate`) VALUES
(1, 'Joker', 'images/joker.jpg', 'Drama, Criminal, Thriller', 'USA', 'Todd Philips', 'Joaquin Phoenix, Robert de Niro, Zazie Beatz', '2019-10-29', 'Gotham, early 1980s. Comedian Arthur Fleck lives with a sick mother. I think that this world will not get a good smile from him, and the grin of the Villain Joker.', 2, 3.75),
(2, '1917', 'images/1917.jpg', 'Historical, Drama', 'Great Britain', 'Sam Mendes', 'George McKey, Colin Fert, Benedict Cumberbatch', '2019-12-02', '1917, the height of the First World War. Two young soldiers are assigned a deadly mission. They must cross enemy territory and deliver a secret message that will prevent the inevitable death of hundreds of soldiers ... Will they be able to win the race against time?', 0, 0),
(3, 'IT 2', 'images/it2.jpg', 'Horror, Thriller', 'USA', 'Andres Mousketti', 'Bill Scarsgard, James McEvoy, Jessica Chestayne', '2019-08-26', '27 years after the first meeting of the guys with the demonic Pennywise. They have already grown, and each has its own life. But suddenly their quiet existence is disturbed by a strange phone call that makes them come together again.', 0, 0),
(4, 'Zombiland 2: Double Tap', 'images/zombiland2.jpg', 'Comedy, Horror', 'USA', 'Ruben Flyaisher', 'Woody Harrelson, Jessie Eisenberg, Emma Stone', '2019-10-09', 'The merciless and fearless four zombie hunters continues their journey inland. This time they have to fight not only with new species of the living dead, but also to engage in battle with other survivors who are not at all friendly. In addition, in their own ranks of hunters, serious discord is planned.', 0, 0),
(5, 'Gentlemen', 'images/gentlemen.jpg', 'Action, Comedy', 'Great Britain', 'Guy Richie', 'Matthew McCounaghey, Charlie Hannam, Colin Pharrell', '2020-01-01', 'A talented graduate of Oxford, using his unique mind and unprecedented audacity, came up with an illegal enrichment scheme using the estate of an impoverished English aristocracy. However, when he decides to sell his business to an influential clan of billionaires from the United States, no less charming but tough gentlemen stand in his way. An exchange of courtesies is planned, which certainly will not do without shootings and a couple of accidents.', 0, 0),
(6, 'Once upon a time in Hollywood', 'images/once.jpg', 'Comedy, Drama', 'USA, Great Britain, China', 'Quentin Tarantino', 'Leonardo DiCaprio, Brad Pitt, Margot Robbie', '2019-05-21', '1969, the Golden age of Hollywood is already over. Famous actor Rick Dalton and his understudy cliff Booth are trying to find their place in the rapidly changing world of the film industry.', 0, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `surname` text NOT NULL,
  `email` varchar(20) NOT NULL,
  `nickname` varchar(15) NOT NULL,
  `password` varchar(20) NOT NULL,
  `filmsCount` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `name`, `surname`, `email`, `nickname`, `password`, `filmsCount`) VALUES
(-1, '', '', '', '', '', NULL),
(9, 'Sultanbek', 'Hasenov', 'hasenovs@mail.ru', 'Fring01', 'Casper2001', 0),
(10, 'Rahat', 'Toleu', 'rahatoleu@gmail.com', 'Spiek2020', 'ogurec1996', 0);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `films`
--
ALTER TABLE `films`
  ADD PRIMARY KEY (`film_id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `films`
--
ALTER TABLE `films`
  MODIFY `film_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
