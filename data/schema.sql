-- Adminer 4.1.0 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `comment`;
CREATE TABLE `comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ИД',
  `user_id` int(11) NOT NULL COMMENT 'Автор',
  `post_id` int(11) NOT NULL COMMENT 'Пост',
  `content` text NOT NULL COMMENT 'Комментарий',
  `rating` int(11) NOT NULL DEFAULT '0' COMMENT 'Рейтинг',
  `create_date` datetime NOT NULL COMMENT 'Дата создания',
  `update_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'Дата изменения',
  `is_deleted` int(1) NOT NULL DEFAULT '0' COMMENT 'Удален',
  `tree` int(11) DEFAULT NULL,
  `lft` int(11) NOT NULL,
  `rgt` int(11) NOT NULL,
  `depth` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `post_id` (`post_id`),
  CONSTRAINT `comment_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE,
  CONSTRAINT `comment_ibfk_2` FOREIGN KEY (`post_id`) REFERENCES `post` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Comments';


DROP TABLE IF EXISTS `comment_vote`;
CREATE TABLE `comment_vote` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ИД',
  `user_id` int(11) NOT NULL COMMENT 'Пользователь',
  `comment_id` int(11) NOT NULL COMMENT 'Комментарий',
  `rating` int(11) NOT NULL COMMENT 'Изменение рейтинга',
  `create_date` datetime NOT NULL COMMENT 'Дата создания',
  `update_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'Дата изменения',
  `is_active` int(1) NOT NULL DEFAULT '1' COMMENT 'Активный голос',
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `comment_id` (`comment_id`),
  CONSTRAINT `comment_vote_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE,
  CONSTRAINT `comment_vote_ibfk_2` FOREIGN KEY (`comment_id`) REFERENCES `comment` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Comments votes';


DROP TABLE IF EXISTS `election`;
CREATE TABLE `election` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ИД',
  `site_id` int(11) NOT NULL DEFAULT '1' COMMENT 'Сайт',
  `start_date` datetime NOT NULL COMMENT 'Дата начала',
  `end_date` datetime NOT NULL COMMENT 'Дата завершения',
  `update_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'Дата обновления',
  `is_active` int(1) NOT NULL DEFAULT '1' COMMENT 'Активное голосование',
  PRIMARY KEY (`id`),
  KEY `site_id` (`site_id`),
  CONSTRAINT `election_ibfk_1` FOREIGN KEY (`site_id`) REFERENCES `site` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Elections';


DROP TABLE IF EXISTS `election_user`;
CREATE TABLE `election_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ИД',
  `election_id` int(11) NOT NULL COMMENT 'Выборы',
  `user_id` int(11) NOT NULL COMMENT 'Пользователь',
  `count` int(11) NOT NULL DEFAULT '0' COMMENT 'Количество голосов',
  PRIMARY KEY (`id`),
  KEY `election_id` (`election_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `election_user_ibfk_1` FOREIGN KEY (`election_id`) REFERENCES `election` (`id`) ON DELETE CASCADE,
  CONSTRAINT `election_user_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Elections users';


DROP TABLE IF EXISTS `election_vote`;
CREATE TABLE `election_vote` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ИД',
  `election_id` int(11) NOT NULL COMMENT 'Выборы',
  `voter_id` int(11) NOT NULL COMMENT 'Автор голоса',
  `user_id` int(11) NOT NULL COMMENT 'Кому голос',
  `create_date` datetime NOT NULL COMMENT 'Дата создания',
  `update_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP COMMENT 'Дата обновления',
  `is_active` int(1) NOT NULL DEFAULT '1' COMMENT 'Активный голос',
  PRIMARY KEY (`id`),
  KEY `election_id` (`election_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `election_vote_ibfk_1` FOREIGN KEY (`election_id`) REFERENCES `election` (`id`) ON DELETE CASCADE,
  CONSTRAINT `election_vote_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Elections votes';


DROP TABLE IF EXISTS `favorite_type`;
CREATE TABLE `favorite_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ИД',
  `name` varchar(255) NOT NULL COMMENT 'Наименование',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Favorite types';


DROP TABLE IF EXISTS `ignore_post`;
CREATE TABLE `ignore_post` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ИД',
  `user_id` int(11) NOT NULL COMMENT 'Пользователь',
  `post_id` int(11) NOT NULL COMMENT 'Пост',
  `start_date` datetime NOT NULL COMMENT 'Дата начала',
  `end_date` datetime NOT NULL COMMENT 'Дата окончания',
  `create_date` datetime NOT NULL COMMENT 'Дата создания',
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `post_id` (`post_id`),
  CONSTRAINT `ignore_post_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE,
  CONSTRAINT `ignore_post_ibfk_2` FOREIGN KEY (`post_id`) REFERENCES `post` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Игнорирование постов';


DROP TABLE IF EXISTS `ignore_user`;
CREATE TABLE `ignore_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ИД',
  `user_id` int(11) NOT NULL COMMENT 'Пользователь',
  `ignored_user_id` int(11) NOT NULL COMMENT 'Игнорируемый пользователь',
  `start_date` datetime NOT NULL COMMENT 'Дата начала',
  `end_date` datetime NOT NULL COMMENT 'Дата окончания',
  `create_date` datetime NOT NULL COMMENT 'Дата создания',
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `ignored_user_id` (`ignored_user_id`),
  CONSTRAINT `ignore_user_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE,
  CONSTRAINT `ignore_user_ibfk_2` FOREIGN KEY (`ignored_user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Игнорирование пользователей';


DROP TABLE IF EXISTS `inbox`;
CREATE TABLE `inbox` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ИД',
  `user_id` int(11) NOT NULL COMMENT 'Автор',
  `title` varchar(255) DEFAULT NULL COMMENT 'Заголовок',
  `count` int(11) DEFAULT '0' COMMENT 'Количество сообщений',
  `create_date` datetime NOT NULL COMMENT 'Дата создания',
  `update_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'Дата изменения',
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `inbox_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Inboxes';


DROP TABLE IF EXISTS `inbox_message`;
CREATE TABLE `inbox_message` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ИД',
  `inbox_id` int(11) NOT NULL COMMENT 'Инбокс',
  `user_id` int(11) NOT NULL COMMENT 'Автор',
  `content` text NOT NULL COMMENT 'Текст',
  `create_date` datetime NOT NULL COMMENT 'Дата создания',
  `update_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'Дата обновления',
  `is_active` int(11) NOT NULL DEFAULT '1' COMMENT 'Активное сообщение',
  PRIMARY KEY (`id`),
  KEY `inbox_id` (`inbox_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `inbox_message_ibfk_1` FOREIGN KEY (`inbox_id`) REFERENCES `inbox` (`id`) ON DELETE CASCADE,
  CONSTRAINT `inbox_message_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Inboxes messages';


DROP TABLE IF EXISTS `inbox_user`;
CREATE TABLE `inbox_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ИД',
  `inbox_id` int(11) NOT NULL COMMENT 'Инбокс',
  `user_id` int(11) NOT NULL COMMENT 'Пользователь',
  `join_date` datetime NOT NULL COMMENT 'Дата входа',
  `expire_date` datetime NOT NULL COMMENT 'Дата выхода',
  `last_read_date` datetime NOT NULL COMMENT 'Дата последнего прочтения',
  `is_active` int(1) NOT NULL DEFAULT '0' COMMENT 'Активный',
  PRIMARY KEY (`id`),
  KEY `inbox_id` (`inbox_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `inbox_user_ibfk_1` FOREIGN KEY (`inbox_id`) REFERENCES `inbox` (`id`) ON DELETE CASCADE,
  CONSTRAINT `inbox_user_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Inboxes users';


DROP TABLE IF EXISTS `invite`;
CREATE TABLE `invite` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ИД',
  `code` varchar(255) NOT NULL COMMENT 'Код приглашения',
  `father_id` int(11) NOT NULL COMMENT 'Отправитель',
  `child_id` int(11) DEFAULT NULL COMMENT 'Получатель',
  `create_date` datetime NOT NULL COMMENT 'Дата создания',
  `expire_date` datetime DEFAULT NULL COMMENT 'Дата истечения',
  `use_date` datetime NOT NULL COMMENT 'Дата использования',
  `is_active` int(11) NOT NULL DEFAULT '1' COMMENT 'Активный инвайт',
  PRIMARY KEY (`id`),
  KEY `father_id` (`father_id`),
  CONSTRAINT `invite_ibfk_1` FOREIGN KEY (`father_id`) REFERENCES `user` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Invites';


DROP TABLE IF EXISTS `migration`;
CREATE TABLE `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `post`;
CREATE TABLE `post` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ИД',
  `user_id` int(11) NOT NULL COMMENT 'Автор',
  `site_id` int(11) NOT NULL DEFAULT '1' COMMENT 'Сайт',
  `title` varchar(255) DEFAULT NULL COMMENT 'Заголовок',
  `content` text NOT NULL COMMENT 'Текст',
  `rating` int(11) NOT NULL DEFAULT '0' COMMENT 'Рейтинг',
  `create_date` datetime NOT NULL COMMENT 'Дата создания',
  `publish_date` datetime NOT NULL COMMENT 'Дата публикации',
  `expire_date` datetime DEFAULT NULL COMMENT 'Дата снятия с публикации',
  `update_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'Дата изменения',
  `is_hidden` int(1) NOT NULL DEFAULT '0' COMMENT 'Скрыт',
  `is_deleted` int(1) NOT NULL DEFAULT '0' COMMENT 'Удален',
  `is_anonymous` int(1) NOT NULL DEFAULT '0' COMMENT 'Анонимный',
  `is_protected` int(1) NOT NULL DEFAULT '0' COMMENT 'Защищенный',
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `site_id` (`site_id`),
  CONSTRAINT `post_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE,
  CONSTRAINT `post_ibfk_2` FOREIGN KEY (`site_id`) REFERENCES `site` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Posts';


DROP TABLE IF EXISTS `post_vote`;
CREATE TABLE `post_vote` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ИД',
  `user_id` int(11) NOT NULL COMMENT 'Пользователь',
  `post_id` int(11) NOT NULL COMMENT 'Пост',
  `rating` int(11) NOT NULL COMMENT 'Изменение рейтинга',
  `create_date` datetime NOT NULL COMMENT 'Дата создания',
  `update_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'Дата изменения',
  `is_active` int(1) NOT NULL DEFAULT '1' COMMENT 'Активный голос',
  PRIMARY KEY (`id`),
  KEY `users_id` (`user_id`),
  KEY `posts_id` (`post_id`),
  CONSTRAINT `post_vote_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE,
  CONSTRAINT `post_vote_ibfk_2` FOREIGN KEY (`post_id`) REFERENCES `post` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Posts votes';


DROP TABLE IF EXISTS `replace`;
CREATE TABLE `replace` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ИД',
  `user_id` int(11) NOT NULL COMMENT 'Автор',
  `site_id` int(11) NOT NULL COMMENT 'Сайт',
  `search` varchar(255) NOT NULL COMMENT 'Слово',
  `replace` varchar(255) NOT NULL COMMENT 'Замена',
  `count` int(11) NOT NULL DEFAULT '0' COMMENT 'Количество замен',
  `start_date` datetime NOT NULL COMMENT 'Дата начала',
  `end_date` datetime NOT NULL COMMENT 'Дата завершения',
  `is_active` int(1) NOT NULL DEFAULT '1' COMMENT 'Активная замена',
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `site_id` (`site_id`),
  CONSTRAINT `replace_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE,
  CONSTRAINT `replace_ibfk_2` FOREIGN KEY (`site_id`) REFERENCES `site` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Replaces';


DROP TABLE IF EXISTS `role`;
CREATE TABLE `role` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ИД',
  `code` varchar(255) NOT NULL COMMENT 'Код',
  `name` varchar(255) NOT NULL COMMENT 'Наименование',
  `is_active` int(1) NOT NULL DEFAULT '1' COMMENT 'Активная роль',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Roles';

INSERT INTO `role` (`id`, `code`, `name`, `is_active`) VALUES
(1,	'guest',	'Гость',	1),
(2,	'user',	'Пользователь',	1),
(3,	'moderator',	'Модератор',	1),
(4,	'president',	'Супер модератор',	1),
(5,	'admin',	'Администратор',	1),
(6,	'press',	'Пресс-атташе',	1);

DROP TABLE IF EXISTS `site`;
CREATE TABLE `site` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ИД',
  `user_id` int(11) NOT NULL COMMENT 'Создатель',
  `code` varchar(255) NOT NULL COMMENT 'Код',
  `name` varchar(255) NOT NULL COMMENT 'Название',
  `create_date` datetime NOT NULL COMMENT 'Дата создания',
  `publish_date` datetime DEFAULT NULL COMMENT 'Дата публикации',
  `expire_date` datetime DEFAULT NULL COMMENT 'Дата снятия с публикации',
  `update_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'Дата обновления',
  `is_hidden` int(1) NOT NULL DEFAULT '0' COMMENT 'Скрыт',
  `is_deleted` int(1) NOT NULL DEFAULT '0' COMMENT 'Удален',
  `is_protected` int(1) NOT NULL DEFAULT '0' COMMENT 'Защищен',
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `site_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Sites';


DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ИД',
  `username` varchar(255) NOT NULL COMMENT 'Имя',
  `email` varchar(255) NOT NULL COMMENT 'Email',
  `password` varchar(255) NOT NULL COMMENT 'Пароль',
  `password_hash` varchar(255) NOT NULL COMMENT 'Хэш пароля',
  `password_reset_token` varchar(255) NOT NULL COMMENT 'Хэш восстановления пароля',
  `auth_key` varchar(255) NOT NULL COMMENT 'Ключ авторизации',
  `gender` int(1) NOT NULL DEFAULT '1' COMMENT 'Пол',
  `rating` int(11) NOT NULL DEFAULT '0' COMMENT 'Рейтинг',
  `prefix` varchar(255) DEFAULT NULL COMMENT 'Префикс',
  `postfix` varchar(255) DEFAULT NULL COMMENT 'Постфикс',
  `create_date` datetime NOT NULL COMMENT 'Дата регистрации',
  `update_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Дата изменения',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Users';


DROP TABLE IF EXISTS `user_favorite`;
CREATE TABLE `user_favorite` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ИД',
  `user_id` int(11) NOT NULL COMMENT 'Пользователь',
  `item_id` int(11) NOT NULL COMMENT 'Идентификатор',
  `favorite_type_id` int(11) NOT NULL COMMENT 'Тип сущности',
  `create_date` datetime NOT NULL COMMENT 'Дата создания',
  `update_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'Дата изменения',
  `is_active` int(1) NOT NULL DEFAULT '1' COMMENT 'Активный элемент',
  `is_public` int(1) NOT NULL DEFAULT '1' COMMENT 'Публичный элемент',
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `favorite_type_id` (`favorite_type_id`),
  CONSTRAINT `user_favorite_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE,
  CONSTRAINT `user_favorite_ibfk_2` FOREIGN KEY (`favorite_type_id`) REFERENCES `favorite_type` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='User favorites';


DROP TABLE IF EXISTS `user_note`;
CREATE TABLE `user_note` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ИД',
  `user_id` int(11) NOT NULL COMMENT 'Пользователь',
  `who_id` int(11) NOT NULL COMMENT 'О ком',
  `content` varchar(255) NOT NULL COMMENT 'Заметка',
  `create_date` datetime NOT NULL COMMENT 'Дата создания',
  `update_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'Дата изменения',
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `who_id` (`who_id`),
  CONSTRAINT `user_note_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='User notes';


DROP TABLE IF EXISTS `user_role`;
CREATE TABLE `user_role` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ИД',
  `user_id` int(11) NOT NULL COMMENT 'Пользователь',
  `site_id` int(11) NOT NULL COMMENT 'Сайт',
  `create_date` datetime NOT NULL COMMENT 'Дата создания',
  `start_date` datetime NOT NULL COMMENT 'Дата начала',
  `end_date` datetime NOT NULL COMMENT 'Дата завершения',
  `update_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'Дата изменения',
  `is_active` int(1) NOT NULL DEFAULT '1' COMMENT 'Активная роль',
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `site_id` (`site_id`),
  CONSTRAINT `user_role_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE,
  CONSTRAINT `user_role_ibfk_2` FOREIGN KEY (`site_id`) REFERENCES `site` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Users roles';


DROP TABLE IF EXISTS `user_vote`;
CREATE TABLE `user_vote` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ИД',
  `user_id` int(11) NOT NULL COMMENT 'Пользователь',
  `vote_id` int(11) NOT NULL COMMENT 'Голосующий',
  `rating` int(11) NOT NULL COMMENT 'Рейтинг',
  `create_date` datetime NOT NULL COMMENT 'Дата создания',
  `update_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'Дата изменения',
  `is_active` int(11) NOT NULL DEFAULT '1' COMMENT 'Активный голос',
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `user_vote_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Users votes';


-- 2015-04-14 05:30:41

DROP TABLE IF EXISTS `agreement`;
CREATE TABLE `agreement` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ИД',
  `title` varchar(255) NOT NULL COMMENT 'Заголовок',
  `text` text NOT NULL COMMENT 'Текст',
  `create_date` datetime NOT NULL COMMENT 'Дата создания',
  `start_date` datetime NOT NULL COMMENT 'Дата начала',
  `end_date` datetime NOT NULL COMMENT 'Дата завершения',
  `is_active` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'Флаг активности',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Пользовательские соглашения';


DROP TABLE IF EXISTS `user_agreement`;
CREATE TABLE `user_agreement` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ИД',
  `user_id` int(11) NOT NULL COMMENT 'Пользователь',
  `agreement_id` int(11) NOT NULL COMMENT 'Соглашение',
  `create_date` datetime NOT NULL COMMENT 'Дата создания',
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `agreement_id` (`agreement_id`),
  CONSTRAINT `user_agreement_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE,
  CONSTRAINT `user_agreement_ibfk_2` FOREIGN KEY (`agreement_id`) REFERENCES `agreement` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Пользователи - соглашения';


-- 2015-04-15 06:02:30