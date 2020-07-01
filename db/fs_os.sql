SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;


CREATE TABLE `admin` (
  `id` int(1) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` char(40) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

INSERT INTO `admin` (`id`, `username`, `password`) VALUES
(1, 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997');

CREATE TABLE `inbox` (
  `id` int(11) NOT NULL,
  `number_sms` varchar(15) NOT NULL,
  `sms` varchar(320) NOT NULL,
  `date_sms` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

CREATE TABLE `setting` (
  `id` int(1) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `keywords` varchar(255) NOT NULL,
  `api_key` varchar(100) NOT NULL,
  `id_user` int(11) NOT NULL,
  `sms_type` char(4) NOT NULL,
  `id_pub` int(11) NOT NULL,
  `popup_ad` int(1) NOT NULL,
  `bad_words` varchar(500) NOT NULL,
  `footer_credit` varchar(50) NOT NULL,
  `max_sms_length` int(3) NOT NULL,
  `max_daily_sms` int(5) NOT NULL,
  `max_daily_user` int(5) NOT NULL,
  `max_daily_number` int(5) NOT NULL,
  `status_service` int(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

INSERT INTO `setting` (`id`, `title`, `description`, `keywords`, `api_key`, `id_user`, `sms_type`, `id_pub`, `popup_ad`, `bad_words`, `footer_credit`, `max_sms_length`, `max_daily_sms`, `max_daily_user`, `max_daily_number`, `status_service`) VALUES
(1, 'SMS Gratis', 'Kirim SMS Gratis ke Semua Operator Indonesia', 'sms gratis, kirim sms gratis, sms gratis all operator', 'Ql8bifTmetZtWhBa9SfXTf9vRsO6XoG1wDCfTd8kOTJAjVE0ak', 501, 'REG', 227, 1, 'anjing,bangsat,babi,kontol', '', 140, 1000, 50, 10, 1);

CREATE TABLE `sms` (
  `id` int(11) NOT NULL,
  `id_kuysms` int(11) NOT NULL,
  `number_sms` varchar(15) NOT NULL,
  `sms` varchar(320) NOT NULL,
  `ip` varchar(64) NOT NULL,
  `date_send` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;


ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `inbox`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `setting`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `sms`
  ADD PRIMARY KEY (`id`);


ALTER TABLE `admin`
  MODIFY `id` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

ALTER TABLE `inbox`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `setting`
  MODIFY `id` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

ALTER TABLE `sms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
